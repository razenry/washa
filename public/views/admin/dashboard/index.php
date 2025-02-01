<h1 class="fw-bold my-5">Hallo <?= $_SESSION['user']['username'] ?? 'Guest' ?> 👋</h1>

<div class="row mt-3">
    <div class="col-lg-3">
        <div class="card shadow bg-info rounded-pill">
            <div class="card-body w-100 p-4">
                <h3 class="text-center">Anggota</h3>
                <p class="text-center fw-bold fs-3"><?= $anggota ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow bg-warning rounded-pill">
            <div class="card-body w-100 p-4">
                <h3 class="text-center">Petugas</h3>
                <p class="text-center fw-bold fs-3"><?= $petugas ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow bg-primary rounded-pill">
            <div class="card-body w-100 p-4 text-white">
                <h3 class="text-center">User</h3>
                <p class="text-center fw-bold fs-3">0</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow bg-success rounded-pill">
            <div class="card-body w-100 p-4 text-white">
                <h3 class="text-center">User</h3>
                <p class="text-center fw-bold fs-3">0</p>
            </div>
        </div>
    </div>
</div>

<h4 class="fw-bold mt-5">Transaksi terbaru</h4>

<div class="mt-3">
    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Customer</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1.</td>
                <td>Razen</td>
                <td>125K</td>
            </tr>
        </tbody>
    </table>
</div>