<?php

class DB {
    private static $pdo;
    private static $table;
    private static $select = '*';
    private static $where = [];
    private static $join = [];
    private static $orderBy = [];
    private static $limit = null;
    private static $values = [];

    // Setup koneksi database
    public static function connect($host, $dbname, $username, $password) {
        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Tentukan nama tabel
    public static function table($table) {
        self::$table = $table;
        return new static;
    }

    // SELECT bagian dari query
    public static function select($columns = '*') {
        self::$select = is_array($columns) ? implode(", ", $columns) : $columns;
        return new static;
    }

    // WHERE bagian dari query
    public static function where($column, $operator, $value) {
        self::$where[] = "$column $operator ?";
        self::$values[] = $value;
        return new static;
    }

    // JOIN bagian dari query
    public static function join($table, $condition) {
        self::$join[] = "JOIN $table ON $condition";
        return new static;
    }

    // ORDER BY bagian dari query
    public static function orderBy($column, $direction = 'ASC') {
        self::$orderBy[] = "$column $direction";
        return new static;
    }

    // LIMIT bagian dari query
    public static function limit($limit) {
        self::$limit = $limit;
        return new static;
    }

    // Membuat query SQL untuk SELECT
    private static function buildSelectQuery() {
        $query = "SELECT " . self::$select . " FROM " . self::$table;
        
        // Join
        if (count(self::$join) > 0) {
            $query .= " " . implode(" ", self::$join);
        }

        // Where
        if (count(self::$where) > 0) {
            $query .= " WHERE " . implode(" AND ", self::$where);
        }

        // Order by
        if (count(self::$orderBy) > 0) {
            $query .= " ORDER BY " . implode(", ", self::$orderBy);
        }

        // Limit
        if (self::$limit !== null) {
            $query .= " LIMIT " . self::$limit;
        }

        return $query;
    }

    // Menjalankan SELECT query dan mengembalikan hasil
    public static function get() {
        $query = self::buildSelectQuery();
        $stmt = self::$pdo->prepare($query);
        $stmt->execute(self::$values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function single() {
        $query = self::buildSelectQuery();
        $stmt = self::$pdo->prepare($query);
        $stmt->execute(self::$values);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // INSERT query
    public static function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $query = "INSERT INTO " . self::$table . " ($columns) VALUES ($placeholders)";
        
        $stmt = self::$pdo->prepare($query);
        $stmt->execute(array_values($data));
        
        return self::$pdo->lastInsertId();
    }

    // UPDATE query
    public static function update($data) {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = ?";
            self::$values[] = $value;
        }
        $setString = implode(", ", $set);
        $query = "UPDATE " . self::$table . " SET $setString";

        if (count(self::$where) > 0) {
            $query .= " WHERE " . implode(" AND ", self::$where);
        }

        $stmt = self::$pdo->prepare($query);
        $stmt->execute(self::$values);

        return $stmt->rowCount();
    }

    // DELETE query
    public static function delete() {
        $query = "DELETE FROM " . self::$table;

        if (count(self::$where) > 0) {
            $query .= " WHERE " . implode(" AND ", self::$where);
        }

        $stmt = self::$pdo->prepare($query);
        $stmt->execute(self::$values);

        return $stmt->rowCount();
    }

    // COUNT query
    public static function count() {
        $query = "SELECT COUNT(*) FROM " . self::$table;
        
        if (count(self::$join) > 0) {
            $query .= " " . implode(" ", self::$join);
        }

        if (count(self::$where) > 0) {
            $query .= " WHERE " . implode(" AND ", self::$where);
        }

        $stmt = self::$pdo->prepare($query);
        $stmt->execute(self::$values);
        
        return $stmt->fetchColumn();
    }

    // MAX query
    public static function max($column) {
        $query = "SELECT MAX($column) FROM " . self::$table;
        
        if (count(self::$join) > 0) {
            $query .= " " . implode(" ", self::$join);
        }

        if (count(self::$where) > 0) {
            $query .= " WHERE " . implode(" AND ", self::$where);
        }

        $stmt = self::$pdo->prepare($query);
        $stmt->execute(self::$values);
        
        return $stmt->fetchColumn();
    }

    // MIN query
    public static function min($column) {
        $query = "SELECT MIN($column) FROM " . self::$table;
        
        if (count(self::$join) > 0) {
            $query .= " " . implode(" ", self::$join);
        }

        if (count(self::$where) > 0) {
            $query .= " WHERE " . implode(" AND ", self::$where);
        }

        $stmt = self::$pdo->prepare($query);
        $stmt->execute(self::$values);
        
        return $stmt->fetchColumn();
    }

    // Update status (misalnya mengubah status menjadi 'active' atau 'inactive')
    public static function updateStatus($status, $condition) {
        $query = "UPDATE " . self::$table . " SET status = ? WHERE $condition";
        
        $stmt = self::$pdo->prepare($query);
        $stmt->execute([$status]);

        return $stmt->rowCount();
    }

    // Reset state setelah query dieksekusi
    public static function reset() {
        self::$select = '*';
        self::$where = [];
        self::$join = [];
        self::$orderBy = [];
        self::$limit = null;
        self::$values = [];
    }
}

// Contoh Penggunaan:


// // Select
// $results = DB::table('users')
//     ->select(['id', 'name', 'email'])
//     ->where('age', '>', 18)
//     ->orderBy('name', 'ASC')
//     ->limit(10)
//     ->get();

// print_r($results);

// // Insert
// $insertId = DB::table('users')
//     ->insert(['name' => 'John Doe', 'email' => 'johndoe@example.com', 'age' => 25]);

// echo "Inserted ID: " . $insertId;

// // Update
// $updateCount = DB::table('users')
//     ->where('id', '=', 1)
//     ->update(['name' => 'Jane Doe', 'email' => 'janedoe@example.com']);

// echo "Rows updated: " . $updateCount;

// // Delete
// $deleteCount = DB::table('users')
//     ->where('id', '=', 1)
//     ->delete();

// echo "Rows deleted: " . $deleteCount;
?>
