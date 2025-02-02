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

    public static function connect($host, $dbname, $username, $password) {
        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function table($table) {
        self::$table = $table;
        return new static;
    }

    public static function select($columns = '*') {
        self::$select = is_array($columns) ? implode(", ", $columns) : $columns;
        return new static;
    }

    public static function where($column, $operator, $value) {
        self::$where[] = "$column $operator ?";
        self::$values[] = $value;
        return new static;
    }

    public static function join($table, $condition) {
        self::$join[] = "JOIN $table ON $condition";
        return new static;
    }

    public static function orderBy($column, $direction = 'ASC') {
        self::$orderBy[] = "$column $direction";
        return new static;
    }

    public static function limit($limit) {
        self::$limit = $limit;
        return new static;
    }

    private static function buildSelectQuery() {
        $query = "SELECT " . self::$select . " FROM " . self::$table;
        
        if (count(self::$join) > 0) {
            $query .= " " . implode(" ", self::$join);
        }

        if (count(self::$where) > 0) {
            $query .= " WHERE " . implode(" AND ", self::$where);
        }

        if (count(self::$orderBy) > 0) {
            $query .= " ORDER BY " . implode(", ", self::$orderBy);
        }

        if (self::$limit !== null) {
            $query .= " LIMIT " . self::$limit;
        }

        return $query;
    }

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

    public static function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $query = "INSERT INTO " . self::$table . " ($columns) VALUES ($placeholders)";
        
        $stmt = self::$pdo->prepare($query);
        $stmt->execute(array_values($data));
        
        return self::$pdo->lastInsertId();
    }

    public static function update($data) {
        $set = [];
        $updateValues = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = ?";
            $updateValues[] = $value;
        }
        $setString = implode(", ", $set);
        $query = "UPDATE " . self::$table . " SET $setString";

        if (count(self::$where) > 0) {
            $query .= " WHERE " . implode(" AND ", self::$where);
        }

        $stmt = self::$pdo->prepare($query);
        $stmt->execute(array_merge($updateValues, self::$values));

        $affectedRows = $stmt->rowCount();
        self::reset();
        return $affectedRows;
    }

    public static function delete() {
        $query = "DELETE FROM " . self::$table;

        if (count(self::$where) > 0) {
            $query .= " WHERE " . implode(" AND ", self::$where);
        }

        $stmt = self::$pdo->prepare($query);
        $stmt->execute(self::$values);

        return $stmt->rowCount();
    }

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

    public static function reset() {
        self::$select = '*';
        self::$where = [];
        self::$join = [];
        self::$orderBy = [];
        self::$limit = null;
        self::$values = [];
    }
}
