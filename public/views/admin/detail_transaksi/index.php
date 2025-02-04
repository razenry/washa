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

            <!-- Detail Modal -->

            <div class="offcanvas offcanvas-end" tabindex="-1" id="detail<?= $dt['id'] ?>" aria-labelledby="detailLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="detailLabel">Detail petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" disabled readonly value="<?= $dt['nama'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" disabled readonly value="<?= $dt['username'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" disabled readonly value="<?= $dt['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <input type="text" class="form-control" disabled readonly value="<?= $dt['level'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="notelp" class="form-label">No telp.</label>
                        <input type="text" class="form-control" disabled readonly value="<?= $dt['notelp'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="notelp" class="form-label">Status</label>
                        <input type="text" class="form-control" disabled readonly value="<?= $dt['status'] == 1 ? 'Aktif' : 'Tidak Aktif' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="notelp" class="form-label">Alamat</label>
                        <textarea type="text" class="form-control" disabled readonly><?= $dt['alamat'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notelp" class="form-label">Dibuat</label>
                        <input type="text" class="form-control" disabled readonly value="<?= DateHelper::formatIndonesianDateTime($dt['dibuat']) ?>">
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="edit<?= $dt['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $dt['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editLabel<?= $dt['id'] ?>">Edit Petugas</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?= Routes::base('petugas/edit') ?>">
                            <input type="hidden" name="id" value="<?= $dt['id'] ?>">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="biodata" class="form-label">Biodata</label>
                                    <div class="input-group">
                                        <select class="form-select" id="biodata" name="id">
                                            <option value="" disabled selected>Pilih biodata</option>
                                            <?php foreach ($biodata as $b) : ?>
                                                <option value="<?= $b['id'] ?>" <?= $b['id'] == $dt['id'] ? 'selected' : '' ?>><?= $b['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah</button>
                                    </div>
                                    <?php if (isset($_SESSION['errors']['id'])) : ?>
                                        <p class="text-danger mt-1"><?= $_SESSION['errors']['id'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" id="username" name="username" value="<?= $dt['username'] ?>" placeholder="Masukkan username">
                                    <?php if (isset($_SESSION['errors']['username'])) : ?>
                                        <p class="text-danger mt-1"><?= $_SESSION['errors']['username'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="********">
                                    <?php if (isset($_SESSION['errors']['password'])) : ?>
                                        <p class="text-danger mt-1"><?= $_SESSION['errors']['password'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="verifikasi_password" class="form-label">Konfirmasi Password</label>
                                    <input class="form-control" type="password" name="verifikasi_password" id="verifikasi_password" placeholder="********">
                                    <?php if (isset($_SESSION['errors']['verifikasi_password'])) : ?>
                                        <p class="text-danger mt-1"><?= $_SESSION['errors']['verifikasi_password'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hapus Modal -->
            <div class="modal fade" id="hapus<?= $dt['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $dt['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editLabel<?= $dt['id'] ?>">Konfirmasi Hapus</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="<?= Routes::base('petugas/hapus') ?>">

                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $dt['id'] ?>">
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
                        <h2 class="fw-bold text-success">Rp <?= number_format($total_harga, 0, ',', '.') ?></h2>
                    </div>

                    <button class="btn btn-success btn-lg w-100 mt-4 shadow-sm fw-semibold">
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