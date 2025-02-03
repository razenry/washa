<h1 class="fw-bold my-3"><?= $title ?? 'Data' ?></h1>

<div class="row">

    <div class="col-lg-8">
        <div class="card shadow-sm p-3">

            <table class="table table-white" id="dataTable">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($biodata as $key => $b) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $b['nama'] ?></td>
                            <td><?= $b['email'] ?></td>
                            <td class="d-flex justify-content-center gap-3 align-items-center">
                                <button class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#detail<?= $b['id_biodata'] ?>" aria-controls="detail">Detail</button>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $b['id_biodata'] ?>">Edit</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $b['id_biodata'] ?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Detail Modal -->

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="detail<?= $b['id_biodata'] ?>" aria-labelledby="detailLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="detailLabel">Detail petugas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $b['nama'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $b['email'] ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea type="text" class="form-control" disabled readonly><?= $b['alamat'] ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="notelp" class="form-label">Notelp</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $b['notelp'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="dibuat" class="form-label">Dibuat</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= DateHelper::formatIndonesianDate($b['dibuat']) ?>">
                                </div>


                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit<?= $b['id_biodata'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $b['id_biodata'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editLabel<?= $b['id_biodata'] ?>">Edit Jenis Cucian</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="<?= Routes::base('biodata/edit') ?>">
                                        <input type="hidden" name="id_biodata" value="<?= $b['id_biodata'] ?>">
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input class="form-control" id="nama" name="nama" value="<?= $b['nama'] ?>" placeholder="Masukkan nama">
                                                <?php if (isset($_SESSION['errors']['nama'])) : ?>
                                                    <p class="text-danger mt-1"><?= $_SESSION['errors']['nama'] ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input class="form-control" id="harga" name="harga" value="<?= $b['harga'] ?>" placeholder="Masukkan harga">
                                                </div>
                                                <?php if (isset($_SESSION['errors']['harga'])) : ?>
                                                    <p class="text-danger mt-1"><?= $_SESSION['errors']['harga'] ?></p>
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
                        <div class="modal fade" id="hapus<?= $b['id_biodata'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $b['id_biodata'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editLabel<?= $b['id_biodata'] ?>">Konfirmasi Hapus</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="<?= Routes::base('biodata/hapus') ?>">

                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $b['id_biodata'] ?>">
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
            <h4 class="my-2 mb-3 text-center">Tambah Biodata</h4>
            <form class="" method="post" action="<?= Routes::base('biodata/tambah') ?>">

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