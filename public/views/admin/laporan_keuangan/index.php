<h1 class="fw-bold my-3"><?= $title ?? 'Data' ?></h1>


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
        foreach ($laporan_keuangan as $key => $lp) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= TextHelper::limitText($lp['kode_trans'], 20) ?></td>
                <td><?= DateHelper::formatIndonesianDate($lp['tgl_transaksi']) ?></td>
                <td><?= $lp['nama_jenis_cucian'] ?></td>
                <td><?= CurrencyFormatter::formatCurrency($lp['harga_satuan']) ?></td>
                <td><?= $lp['berat'] ?> Kg</td>
                <td><?= CurrencyFormatter::formatCurrency($lp['total_harga']) ?></td>
                <td>
                    <?php
                    if ($lp['status_transaksi'] == 1) {
                        $span = "info";
                        $status = 'Dalam Antrean';
                    } else if ($lp['status_transaksi'] == 2) {
                        $span = "primary";
                        $status = 'Di proses';
                    } else if ($lp['status_transaksi'] == 3) {
                        $span = "primary";
                        $status = 'Di cuci';
                    } else  if ($lp['status_transaksi'] == 4) {
                        $span = "warning";
                        $status = 'Di jemur';
                    } else if ($lp['status_transaksi'] == 5) {
                        $span = "success";
                        $status = 'Selesai';
                    } else if ($lp['status_transaksi'] == 0) {
                        $span = "secondary";
                        $status = 'Menunggu';
                    }
                    ?>
                    <span class="p-1 mt-2 px-2 rounded-3 text-white bg-<?= $span ?>">
                        <?= $status ?>
                    </span>
                </td>
                <td><?= $lp['nama_customer'] ?></td>

            </tr>


        <?php endforeach; ?>
    </tbody>
</table>