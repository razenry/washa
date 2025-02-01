<h1 class="fw-bold my-3">Data Petugas</h1>

<div class="row">

    <div class="col-lg-8">
        <div class="card shadow-sm p-3">

            <table class="table" id="dataTable">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Nama</th>
                        <th>Notelp</th>
                        <th>Level</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($petugas as $key => $p) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $p['username'] ?></td>
                            <td><?= $p['notelp'] ?></td>
                            <td><?= $p['level'] ?></td>
                            <td class="d-flex justify-content-center gap-3 align-items-center">
                                <button class="btn btn-info">Detail</button>
                                <button class="btn btn-warning">Edit</button>
                                <button class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
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
                    <label for="biodata" class="form-label">Biodata</label>
                    <div class="input-group">
                        <select class="form-select" id="biodata" aria-label="Select" name="id_biodata">
                            <option value="" disabled selected>Pilih biodata</option>
                            <?php foreach ($biodata as $key => $b) : ?>
                                <option value="<?= $b['id'] ?>"><?= $b['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah</button>
                    </div>
                    <?php if(isset($_SESSION['errors']['id_biodata'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['id_biodata'] ?></p>
                    <?php endif;  ?>
                </div>


                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Username</label>
                    <input class="form-control" id="validationTextarea" name="username" placeholder="Masukan username">
                    <?php if(isset($_SESSION['errors']['username'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['username'] ?></p>
                    <?php endif;  ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="********">
                    <?php if(isset($_SESSION['errors']['password'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['password'] ?></p>
                    <?php endif;  ?>
                </div>

                <div class="mb-3">
                    <label for="verifikasi_password" class="form-label">Konfirmasi Password</label>
                    <input class="form-control" type="password" name="verifikasi_password" id="verifikasi_password" placeholder="********">
                    <?php if(isset($_SESSION['errors']['verifikasi_password'])) :  ?>
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

<!-- Modal -->
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>