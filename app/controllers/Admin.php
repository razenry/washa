<?php

class Admin
{
    public function index()
    {
        UserModel::isLog();

        $card = DashboardModel::getCardData();

        $data = [
            'title' => 'Admin Login',
            'anggota' => $card['anggota'],
            'petugas' => $card['petugas'],
            'motivation' => ExtendsHelper::getMotivation(),
        ];
        App::view('admin/dashboard/index', $data, 'admin/app');
    }
    
    public function transaksi()
    {
        UserModel::isLog();
        
        $data = [
            'title' => 'Transaksi'
        ];
        App::view('admin/transaksi/index', $data, 'admin/app');

    }

    public function petugas()
    {
        UserModel::isLog();
        
        $data = [
            'title' => 'Data Petugas',
            'petugas' => PetugasModel::getPetugas(),
            'biodata' => BiodataModel::getBiodata(),
            'errors' => $_SESSION['errors'] ?? null

        ];


        App::view('admin/petugas/index', $data, 'admin/app');

    }

    public function jenis_cucian()
    {
        UserModel::isLog();
        
        $jenis_cucian = DB::table('jenis_cucian')->select()->get();

        $data = [
            'title' => 'Data Jenis Cucian',
            'jenis_cucian' => $jenis_cucian,
            'errors' => $_SESSION['errors'] ?? null
        ];

        App::view('admin/jenis_cucian/index', $data, 'admin/app');

    }


    public function login()
    {
        if (isset($_SESSION['login'])) {
            header('Location:'. Routes::base('admin'));
        }

        $data = [
            'title' => 'Admin Login',
            'pesan_error' => $_SESSION['login_gagal']['pesan_error'] ?? null
        ];
        App::view('admin/login/index', $data, 'admin/login/app');
    }

    public function auth()
    {
        if (isset($_SESSION['login'])) {
            header('Location:'. Routes::base('admin'));
        }

        $validatedData = UserModel::validationLogin($_POST);

        if ($validatedData['errors']) {
            $_SESSION['login_gagal']['pesan_error'] = $validatedData['errors'];
            header('Location:' . Routes::base('admin/login'));
        }
        $username = $validatedData['username'];
        $password = $validatedData['password'];

        $user = UserModel::getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] == 1) {
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['berhasil_login'] = "Selamat datang $username";

                // Redirect based on role
                if ($user['level'] === "Admin") {
                    header("Location: " . Routes::base('admin'));
                } elseif ($user['level'] === "Petugas") {
                    header("Location: " . Routes::base('admin'));
                } elseif ($user['level'] === "Anggota") {
                    header("Location: " . Routes::base('beranda'));
                }
                exit();
            } else {
                $_SESSION['gagal'] = "Akun Anda tidak aktif. Hubungi administrator.";
            }
        } else {
            $_SESSION['gagal'] = "Gagal login. Email atau password salah.";
        }
        header("Location: " . Routes::base('admin/login'));
    }


    public static function logout()
    {
        UserModel::isLog();
        unset($_SESSION);
        session_destroy();
        header("Location: " . Routes::base('admin/login'));
        exit();

    }

    public function test()
    {
        UserModel::isLog();
        $categories = DB::table('blogs')
            ->select(['blogs.id', 'blogs.slug', 'blogs.title', 'categories.name as category_name', 'categories.id as category_id', 'users.name as author'])
            ->join('categories', 'blogs.id_category = categories.id')
            ->join('users', 'blogs.id_user = users.id')
            ->get();
        var_dump($categories);
    }
}
