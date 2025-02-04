<h1 class="fw-bold my-3"><?= $title ?? 'Data' ?></h1>

<button class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Layanan</button>

<table class="table table-white" id="dataTable">
    <thead>
        <tr>
            <th>NO.</th>
            <th>Nama Layanan</th>
            <th>Berat</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($detail_transaksi as $key => $dt) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $dt['nama_jenis_cucian'] ?></td>
                <td><?= $dt['berat'] ?> Kg</td>
                <td><?= CurrencyFormatter::formatCurrency($dt['harga_satuan']) ?></td>
                <td><?= CurrencyFormatter::formatCurrency($dt['total_harga']) ?></td>

                <td class="d-flex justify-content-center gap-3 align-items-center">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $dt['id_detail_transaksi'] ?>">Hapus</button>
                </td>
            </tr>

            <!-- Hapus Modal -->
            <div class="modal fade" id="hapus<?= $dt['id_detail_transaksi'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $dt['id_detail_transaksi'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editLabel<?= $dt['id_detail_transaksi'] ?>">Konfirmasi Hapus</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?= Routes::base('detail_transaksi/hapus') ?>">

                            <div class="modal-body">
                                <input type="hidden" name="id_detail_transaksi" value="<?= $dt['id_detail_transaksi'] ?>">
                                <input type="hidden" name="kode_trans" value="<?= $dt['kode_trans'] ?>">
                                <p class="text-center my-3">Apakah anda yakin ingin menghapus data ini?</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Ya Hapus!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="pembayaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="tambahLabel">Pembayaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="" method="post" action="<?= Routes::base('detail_transaksi/pembayaran') ?>">
                            <div class="modal-body">

                                <input type="hidden" name="id_detail_transaksi" value="<?= $dt['id_detail_transaksi'] ?>">

                                <div class=" rounded-3 my-3">
                                    <h5 class="text-muted">Total Pembayaran</h5>
                                    <h2 class="fw-bold text-success"><?= CurrencyFormatter::formatCurrency($total_harga) ?></h2>
                                </div>

                                <input type="hidden" name="total_harga" value="<?= $total_harga ?>">

                                <div class="mb-3">
                                    <label for="pembayaran" class="form-label">Bayar</label>
                                    <input class="form-control" id="pembayaran" type="number" name="pembayaran" placeholder="Masukan harga satuan">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Bayar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </tbody>
</table>

<div class="row">
    <div class="col-6">
        <div class="card shadow border-0 rounded-4 p-4 mt-5">
            <div class="card-body">
                <!-- Header -->
                <div class="text-center">
                    <h3 class="fw-bold text-dark mb-3"><?= $transaksi['nama'] ?></h3>
                </div>
                <hr>

                <!-- Informasi Pelanggan -->
                <div class="mt-3">
                    <h5 class="text-muted">Informasi Pelanggan</h5>
                    <ul class="list-group list-group-flush mt-2">
                        <li class="list-group-item border-0">
                            <strong class="text-dark">Email:</strong>
                            <span class="text-muted"><?= $transaksi['email'] ?></span>
                        </li>
                        <li class="list-group-item border-0">
                            <strong class="text-dark">Nomor Telepon:</strong>
                            <span class="text-muted"><?= $transaksi['notelp'] ?></span>
                        </li>
                        <li class="list-group-item border-0">
                            <strong class="text-dark">Alamat:</strong>
                            <span class="text-muted"><?= $transaksi['alamat'] ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="bg-light">
            <div class="card shadow border-0 mt-5 rounded-4 p-4">
                <div class="card-body text-center">
                    <h3 class="fw-bold text-dark">Menu Pembayaran</h3>

                    <div class="bg-light p-3 rounded-3 mt-3">
                        <h5 class="text-muted">Total Pembayaran</h5>
                        <h2 class="fw-bold text-success"><?= CurrencyFormatter::formatCurrency($total_harga) ?></h2>
                    </div>

                    <button class="btn btn-success btn-lg w-100 mt-4 shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#pembayaran">
                        <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
                    </button>

                    <p class="text-muted mt-3 small">Pastikan Anda telah mengecek total pembayaran sebelum melanjutkan.</p>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Modal -->
<?= App::extends('admin/detail_transaksi/modalTambah', [
    'transaksi' => $transaksi,
    'jenis_cucian' => $jenis_cucian,
]) ?>

<!-- JS -->
<script>
    let validBiodata = [];

    // Simpan daftar nama biodata yang valid
    document.querySelectorAll("#biodataList .dropdown-item").forEach(item => {
        validBiodata.push(item.textContent.trim().toLowerCase());
    });

    function filterBiodata() {
        let input = document.getElementById("searchBiodata").value.toLowerCase();
        let items = document.querySelectorAll("#biodataList .dropdown-item");
        let hasResult = false;

        items.forEach(item => {
            let text = item.textContent.toLowerCase();
            if (text.includes(input)) {
                item.style.display = "";
                hasResult = true;
            } else {
                item.style.display = "none";
            }
        });

        let dropdown = new bootstrap.Dropdown(document.getElementById("searchBiodata"));
        if (hasResult) {
            dropdown.show();
        } else {
            dropdown.hide();
        }
    }

    function selectBiodata(id, name) {
        document.getElementById("searchBiodata").value = name; // Set input dengan nama
        document.getElementById("selectedBiodata").value = id; // Simpan ID di hidden input
    }

    function validateBiodata() {
        let inputField = document.getElementById("searchBiodata");
        let inputValue = inputField.value.trim().toLowerCase();

        // Jika input tidak ada di daftar valid, kosongkan
        if (!validBiodata.includes(inputValue)) {
            inputField.value = ""; // Kosongkan input
            document.getElementById("selectedBiodata").value = ""; // Kosongkan ID
        }
    }
</script>