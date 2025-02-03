<h1 class="fw-bold my-3"><?= $title ?? 'Data' ?></h1>

<div class="row">

    <div class="col-lg-8">
        <div class="card shadow-sm p-3">

            <table class="table table-white" id="dataTable">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Jenis Cucian</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($jenis_cucian as $key => $jc) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= TextHelper::limitText($jc['nama'], 20) ?></td>
                            <td><?= CurrencyFormatter::formatCurrency($jc['harga']) ?></td>
                            <td class="d-flex justify-content-center gap-3 align-items-center">
                                <button class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#detail<?= $jc['id_jenis_cucian'] ?>" aria-controls="detail">Detail</button>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $jc['id_jenis_cucian'] ?>">Edit</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $jc['id_jenis_cucian'] ?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Detail Modal -->

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="detail<?= $jc['id_jenis_cucian'] ?>" aria-labelledby="detailLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="detailLabel">Detail petugas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= $jc['nama'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="text" class="form-control" disabled readonly value="<?= CurrencyFormatter::formatCurrency($jc['harga']) ?>">
                                </div>

                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit<?= $jc['id_jenis_cucian'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $jc['id_jenis_cucian'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editLabel<?= $jc['id_jenis_cucian'] ?>">Edit Jenis Cucian</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="<?= Routes::base('jenis_cucian/edit') ?>">
                                        <input type="hidden" name="id_jenis_cucian" value="<?= $jc['id_jenis_cucian'] ?>">
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input class="form-control" id="nama" name="nama" value="<?= $jc['nama'] ?>" placeholder="Masukkan nama">
                                                <?php if (isset($_SESSION['errors']['nama'])) : ?>
                                                    <p class="text-danger mt-1"><?= $_SESSION['errors']['nama'] ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input class="form-control" id="harga" name="harga" value="<?= $jc['harga'] ?>" placeholder="Masukkan harga">
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
                        <div class="modal fade" id="hapus<?= $jc['id_jenis_cucian'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $jc['id_jenis_cucian'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editLabel<?= $jc['id_jenis_cucian'] ?>">Konfirmasi Hapus</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="<?= Routes::base('jenis_cucian/hapus') ?>">

                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $jc['id_jenis_cucian'] ?>">
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
            <h4 class="my-2 mb-3 text-center">Tambah Jenis Cucian</h4>
            <form class="" method="post" action="<?= Routes::base('jenis_cucian/tambah') ?>">

                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Nama</label>
                    <input class="form-control" id="validationTextarea" name="nama" placeholder="Masukan nama">
                    <?php if (isset($_SESSION['errors']['nama'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['nama'] ?></p>
                    <?php endif;  ?>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        <input class="form-control" type="number" name="harga" id="harga" placeholder="">
                    </div>
                    <?php if (isset($_SESSION['errors']['harga'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['harga'] ?></p>
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