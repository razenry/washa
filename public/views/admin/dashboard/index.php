<h1 class="fw-bold my-3">Hallo <?= $_SESSION['user']['nama'] ?? 'Guest' ?> 👋</h1>

<p class=" my-3 mb-5"><?= $motivation ?></p>

<div class="row mt-3">
    <div class="col-lg-3">
        <div class="card shadow bg-info rounded-pill">
            <div class="card-body w-100 p-4">
                <h3 class="text-center">Customer</h3>
                <p class="text-center fw-bold fs-3"><?= $customer ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <a href="<?= Routes::base('admin/petugas') ?>" class="card shadow bg-warning rounded-pill text-dark" style="text-decoration: none;">
            <div class="card-body w-100 p-4">
                <h3 class="text-center">Petugas</h3>
                <p class="text-center fw-bold fs-3"><?= $petugas ?></p>
            </div>
        </a>
    </div>
    <div class="col-lg-3">
        <div class="card shadow bg-primary rounded-pill">
            <div class="card-body w-100 p-4 text-white">
                <h3 class="text-center">Pesanan</h3>
                <p class="text-center fw-bold fs-3"><?= $pesanan ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow bg-success rounded-pill">
            <div class="card-body w-100 p-4 text-white">
                <h3 class="text-center">Selesai</h3>
                <p class="text-center fw-bold fs-3"><?= $selesai ?></p>
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
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($transaksi as $key => $tr) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $tr['nama_customer'] ?></td>
                    <td><?= CurrencyFormatter::formatCurrency($tr['total_harga']) ?></td>
                    <td>
                        <?php
                        if ($tr['status_transaksi'] == 1) {
                            $span = "info";
                            $status = 'Dalam Antrean';
                        } else if ($tr['status_transaksi'] == 2) {
                            $span = "primary";
                            $status = 'Di proses';
                        } else if ($tr['status_transaksi'] == 3) {
                            $span = "primary";
                            $status = 'Di cuci';
                        } else  if ($tr['status_transaksi'] == 4) {
                            $span = "warning";
                            $status = 'Di jemur';
                        } else if ($tr['status_transaksi'] == 5) {
                            $span = "success";
                            $status = 'Selesai';
                        } else if ($tr['status_transaksi'] == 0) {
                            $span = "secondary";
                            $status = 'Menunggu';
                        }
                        ?>
                        <span class="p-1 mt-2 px-2 rounded-3 text-white bg-<?= $span ?>">
                            <?= $status ?>
                        </span>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    setInterval(function() {
        location.reload();
    }, 3000);
</script>