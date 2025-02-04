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

        $transaksi = DB::table('transaksi')
            ->select()
            ->join('akun', 'transaksi.id_petugas = akun.id')
            ->join('customer', 'transaksi.id_customer = customer.id')
            ->where('id_petugas', '=', $_SESSION['user']['id'])
            ->orderBy('id_transaksi', 'DESC')
            ->get();
        DB::reset();

        $customer = DB::table('customer')
            ->select()
            ->get();
        DB::reset();

        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $transaksi,
            'customer' => $customer,
        ];
        App::view('admin/transaksi/index', $data, 'admin/app');
    }

    public function detail_transaksi($params)
    {
        UserModel::isLog();

        $kode_trans = $params[0];

        $detail_transaksi = DB::table('detail_transaksi dt')
            ->select(" dt.id_detail_transaksi, dt.berat, dt.harga_satuan, dt.total_harga, tr.id_transaksi, tr.kode_trans, tr.status, tr.tgl_transaksi, tr.waktu_transaksi, jc.harga as harga_jenis_cucian, jc.nama as nama_jenis_cucian, cs.id as id_customer, cs.nama as nama_customer, cs.alamat, cs.email")
            ->join('transaksi tr', 'dt.id_transaksi = tr.id_transaksi')
            ->join('jenis_cucian jc', 'dt.id_jenis_cucian = jc.id_jenis_cucian')
            ->join('customer cs', 'tr.id_customer = cs.id')
            ->where('dt.id_transaksi', '=', $kode_trans)
            ->get();
        DB::reset();

        $data = [
            'title' => 'Detail Transaksi ',
            'detail_transaksi' => $detail_transaksi
        ];
        App::view('admin/detail_transaksi/index', $data, 'admin/app');
    }

    public function petugas()
    {
        UserModel::isLog("Admin");

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

    public function biodata()
    {
        UserModel::isLog();

        $biodata = DB::table('biodata_user')->select()->get();

        $data = [
            'title' => 'Data Biodata',
            'biodata' => $biodata,
            'errors' => $_SESSION['errors'] ?? null
        ];

        App::view('admin/biodata/index', $data, 'admin/app');
    }

    public function anggota()
    {
        UserModel::isLog();

        $anggota = DB::table('akun')
            ->select()
            ->join('biodata_user', 'akun.id_biodata = biodata_user.id_biodata')
            ->where('level', '=', 'Anggota')
            ->get();
        DB::reset();

        $biodata = DB::table('biodata_user')
            ->select()
            ->get();
        DB::reset();


        $data = [
            'title' => 'Data Anggota',
            'anggota' => $anggota,
            'biodata' => $biodata,
            'errors' => $_SESSION['errors'] ?? null
        ];

        App::view('admin/anggota/index', $data, 'admin/app');
    }

    public function customer()
    {
        UserModel::isLog();

        $customer = DB::table('customer')
            ->select()
            ->get();
        DB::reset();

        $data = [
            'title' => 'Data Customer',
            'customer' => $customer,
            'errors' => $_SESSION['errors'] ?? null
        ];

        App::view('admin/customer/index', $data, 'admin/app');
    }




    public function login()
    {
        if (isset($_SESSION['login'])) {
            header('Location:' . Routes::base('admin'));
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
            header('Location:' . Routes::base('admin'));
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
