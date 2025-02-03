<h1 class="fw-bold my-3"><?= $title ?? 'Data' ?></h1>

<div class="row">

    <div class="col-lg-8">
        <div class="card shadow-sm p-3">

            <table class="table table-white" id="dataTable">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Tgl. Transaksi</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($transaksi as $key => $t) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= DateHelper::formatIndonesianDate($t['tgl_transaksi']) ?></td>
                            <td><?= DateHelper::formatTime($t['waktu_transaksi']) ?></td>
                            <td><?php
                                if ($t['status'] == 1) {
                                    echo 'Di proses';
                                } else if ($t['status'] == 2) {
                                    echo 'Di cuci';
                                } else if ($t['status'] == 3) {
                                    echo 'Selesai';
                                }else {
                                    echo 'Dalam antrean';
                                }
                                ?></td>
                            <td class="d-flex justify-content-center gap-3 align-items-center">
                                <button class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#detail<?= $t['id'] ?>" aria-controls="detail">Detail</button>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $t['id'] ?>">Edit</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $t['id'] ?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Detail Modal -->

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="detail<?= $t['id'] ?>" aria-labelledby="detailLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="detailLabel">Detail petugas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $t['nama'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $t['username'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $t['email'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $t['level'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="notelp" class="form-label">No telp.</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $t['notelp'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="notelp" class="form-label">Status</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $t['status'] == 1 ? 'Aktif' : 'Tidak Aktif' ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="notelp" class="form-label">Alamat</label>
                                    <textarea type="text" class="form-control" disabled readonly><?= $t['alamat'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="notelp" class="form-label">Dibuat</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= DateHelper::formatIndonesianDateTime($t['dibuat']) ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit<?= $t['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $t['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editLabel<?= $t['id'] ?>">Edit Petugas</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="<?= Routes::base('petugas/edit') ?>">
                                        <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="biodata" class="form-label">Biodata</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="biodata" name="id_biodata">
                                                        <option value="" disabled selected>Pilih biodata</option>
                                                        <?php foreach ($biodata as $b) : ?>
                                                            <option value="<?= $b['id_biodata'] ?>" <?= $b['id_biodata'] == $t['id_biodata'] ? 'selected' : '' ?>><?= $b['nama'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah</button>
                                                </div>
                                                <?php if (isset($_SESSION['errors']['id_biodata'])) : ?>
                                                    <p class="text-danger mt-1"><?= $_SESSION['errors']['id_biodata'] ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input class="form-control" id="username" name="username" value="<?= $t['username'] ?>" placeholder="Masukkan username">
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
                        <div class="modal fade" id="hapus<?= $t['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $t['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editLabel<?= $t['id'] ?>">Konfirmasi Hapus</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="<?= Routes::base('petugas/hapus') ?>">

                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $t['id'] ?>">
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
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card p-4 shadow-sm">
            <h4 class="my-2 mb-3 text-center">Tambah Petugas</h4>
            <form class="" method="post" action="<?= Routes::base('petugas/tambah') ?>">

                <div class="mb-3">
                    <label for="searchBiodata" class="form-label">Biodata</label>
                    <div class="input-group">
                        <input type="text" class="form-control dropdown-toggle" id="searchBiodata" placeholder="Ketik untuk mencari..." data-bs-toggle="dropdown" aria-expanded="false" onkeyup="filterBiodata()" onblur="validateBiodata()">
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah</button>
                        <ul class="dropdown-menu w-100" id="biodataList" style="max-height: 200px; overflow-y: auto;">
                            <?php foreach ($biodata as $b) : ?>
                                <li><a href="#" class="dropdown-item" onclick="selectBiodata(<?= $b['id_biodata'] ?>, '<?= $b['nama'] ?>')"><?= $b['nama'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if (isset($_SESSION['errors']['id_biodata'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['id_biodata'] ?></p>
                    <?php endif; ?>
                    <input type="hidden" name="id_biodata" id="selectedBiodata">
                </div>

                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Username</label>
                    <input class="form-control" id="validationTextarea" name="username" placeholder="Masukan username">
                    <?php if (isset($_SESSION['errors']['username'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['username'] ?></p>
                    <?php endif;  ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="********">
                    <?php if (isset($_SESSION['errors']['password'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['password'] ?></p>
                    <?php endif;  ?>
                </div>

                <div class="mb-3">
                    <label for="verifikasi_password" class="form-label">Konfirmasi Password</label>
                    <input class="form-control" type="password" name="verifikasi_password" id="verifikasi_password" placeholder="********">
                    <?php if (isset($_SESSION['errors']['verifikasi_password'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['verifikasi_password'] ?></p>
                    <?php endif;  ?>
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary" type="submit" name="tambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Modal Tambah -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Biodata</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="" method="post" action="<?= Routes::base('biodata/tambah') ?>">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input class="form-control" id="nama" type="text" name="nama" placeholder="Masukan nama">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="example@example.com">
                    </div>

                    <div class="mb-3">
                        <label for="notelp" class="form-label">No Telp.</label>
                        <input class="form-control" id="notelp" type="number" name="notelp" placeholder="0885161552065">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

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