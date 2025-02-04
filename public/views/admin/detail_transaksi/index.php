<h1 class="fw-bold my-3"><?= $title ?? 'Data' ?></h1>

<button class="btn btn-primary my-3">Tambah Layanan</button>

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
        foreach ($detail_transaksi as $key => $t) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= DateHelper::formatIndonesianDate($t['tgl_transaksi']) ?></td>
                <td><?= DateHelper::formatTime($t['waktu_transaksi']) ?></td>
                <td><?php
                    if ($t['status'] == 1) {
                        echo 'Dalam Antrean';
                    } else if ($t['status'] == 2) {
                        echo 'Di proses';
                    } else if ($t['status'] == 3) {
                        echo 'Di cuci';
                    } else  if ($t['status'] == 4) {
                        echo 'Di jemur';
                    } else if ($t['status'] == 5) {
                        echo 'Selesai';
                    } else {
                        echo 'Pending';
                    }
                    ?></td>
                <td class="d-flex justify-content-center gap-3 align-items-center">
                    <a class="btn btn-info" href="<?= Routes::base('admin/detail_transaksi/') . $t['id']  ?>">Detail</a>
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
                                        <select class="form-select" id="biodata" name="id">
                                            <option value="" disabled selected>Pilih biodata</option>
                                            <?php foreach ($biodata as $b) : ?>
                                                <option value="<?= $b['id'] ?>" <?= $b['id'] == $t['id'] ? 'selected' : '' ?>><?= $b['nama'] ?></option>
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
