<div class="d-flex justify-content-between align-items-center">
    <h1 class="fw-bold my-3"><?= $title ?? 'Data' ?></h1>
    <div class="">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#laporan">Cetak Laporan</button>
    </div>
</div>

<table class="table table-white" id="dataTable">
    <thead>
        <tr>
            <th>NO.</th>
            <th>Kode Transaksi</th>
            <th>Tanggal Transaksi</th>
            <th>Jenis Cucian</th>
            <th>Harga Satuan</th>
            <th>Berat</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Customer</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($laporan_keuangan as $key => $lk) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= TextHelper::limitText($lk['kode_trans'], 20) ?></td>
                <td><?= DateHelper::formatIndonesianDate($lk['tgl_transaksi']) ?></td>
                <td><?= $lk['nama_jenis_cucian'] ?></td>
                <td><?= CurrencyFormatter::formatCurrency($lk['harga_satuan']) ?></td>
                <td><?= $lk['berat'] ?> Kg</td>
                <td><?= CurrencyFormatter::formatCurrency($lk['total_harga']) ?></td>
                <td>
                    <?php
                    if ($lk['status_transaksi'] == 1) {
                        $span = "info";
                        $status = 'Dalam Antrean';
                    } else if ($lk['status_transaksi'] == 2) {
                        $span = "primary";
                        $status = 'Di proses';
                    } else if ($lk['status_transaksi'] == 3) {
                        $span = "primary";
                        $status = 'Di cuci';
                    } else  if ($lk['status_transaksi'] == 4) {
                        $span = "warning";
                        $status = 'Di jemur';
                    } else if ($lk['status_transaksi'] == 5) {
                        $span = "success";
                        $status = 'Selesai';
                    } else if ($lk['status_transaksi'] == 0) {
                        $span = "secondary";
                        $status = 'Menunggu';
                    }
                    ?>
                    <span class="p-1 mt-2 px-2 rounded-3 text-white bg-<?= $span ?>">
                        <?= $status ?>
                    </span>
                </td>
                <td><?= $lk['nama_customer'] ?></td>

            </tr>


        <?php endforeach; ?>
    </tbody>
</table>


<!-- Modal Laporan -->
<div class="modal fade" id="laporan" tabindex="-1" aria-labelledby="InvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="InvoiceModalLabel">Laporan Pekerjaan Petugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="invoiceContent">
                <div class="container">
                    <div class="row">
                        <!-- Header Invoice -->
                        <div class="col-md-12 text-center mb-4">
                            <h1 class="text-center fw-bold fs-2 text-primary">Washa</h1>
                            <h2 class="fw-bold">Laporan Pekerjaan</h2>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Jenis Cucian -->
                        <div class="col-md-12">
                            <h5 class="fw-bold">Tabel Laporan</h5>
                            <table class="table  table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>NO.</th>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Jenis Cucian</th>
                                        <th>Harga Satuan</th>
                                        <th>Berat</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Customer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($laporan_keuangan)) :  ?>
                                        <?php foreach ($laporan_keuangan as $key => $lk) : ?>
                                            <tr>

                                                <td><?= $i++ ?></td>
                                                <td><?= TextHelper::limitText($lk['kode_trans'], 20) ?></td>
                                                <td><?= DateHelper::formatIndonesianDate($lk['tgl_transaksi']) ?></td>
                                                <td><?= $lk['nama_jenis_cucian'] ?></td>
                                                <td><?= CurrencyFormatter::formatCurrency($lk['harga_satuan']) ?></td>
                                                <td><?= $lk['berat'] ?> Kg</td>
                                                <td><?= CurrencyFormatter::formatCurrency($lk['total_harga']) ?></td>
                                                <td>
                                                    <?php
                                                    if ($lk['status_transaksi'] == 1) {
                                                        $span = "info";
                                                        $status = 'Dalam Antrean';
                                                    } else if ($lk['status_transaksi'] == 2) {
                                                        $span = "primary";
                                                        $status = 'Di proses';
                                                    } else if ($lk['status_transaksi'] == 3) {
                                                        $span = "primary";
                                                        $status = 'Di cuci';
                                                    } else  if ($lk['status_transaksi'] == 4) {
                                                        $span = "warning";
                                                        $status = 'Di jemur';
                                                    } else if ($lk['status_transaksi'] == 5) {
                                                        $span = "success";
                                                        $status = 'Selesai';
                                                    } else if ($lk['status_transaksi'] == 0) {
                                                        $span = "secondary";
                                                        $status = 'Menunggu';
                                                    }
                                                    ?>
                                                    <span class="p-1 mt-2 px-2 rounded-3 text-white bg-<?= $span ?>">
                                                        <?= $status ?>
                                                    </span>
                                                </td>
                                                <td><?= $lk['nama_customer'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif;  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Total Harga -->
                        <div class="col-md-12 text-end">
                            <h4 class="">Total Pemasukan: <span class=" fw-bold text-success"><?= CurrencyFormatter::formatCurrency($total_harga) ?></span></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="printInvoice()" class="btn btn-dark">Print Laporan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    function printInvoice() {
        const printContents = document.getElementById('invoiceContent').innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>