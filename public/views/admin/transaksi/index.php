<h1 class="fw-bold my-3"><?= $title ?? 'Data' ?></h1>

<div class="row">

    <div class="col-lg-8">
        <div class="card shadow-sm p-3">

            <table class="table table-white" id="dataTable">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Customer</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($transaksi as $key => $t) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $t['nama'] ?></td>
                            <td>
                                <span>
                                    <?php
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
                                    echo ' - ';
                                    if ($t['status_pembayaran'] == 1) {
                                        echo 'Di bayar';
                                    } else {
                                        echo 'Belum Di bayar';
                                    }
                                    ?>
                                </span>

                            </td>
                            <td class="d-flex justify-content-center gap-3 align-items-center">
                                <a class="btn btn-info" href="<?= Routes::base('admin/detail_transaksi/') . $t['id_transaksi']  ?>">Detail</a>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $t['id_transaksi'] ?>">Edit</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $t['id_transaksi'] ?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit<?= $t['id_transaksi'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $t['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editLabel<?= $t['id'] ?>">Edit Transaksi</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="<?= Routes::base('transaksi/edit') ?>">
                                        <input type="hidden" name="id_transaksi" value="<?= $t['id_transaksi'] ?>">
                                        <input type="hidden" name="id_petugas" value="<?= $t['id_petugas'] ?>">
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="biodata" class="form-label">Customer</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="biodata" name="id_customer">
                                                        <option value="" disabled selected>Pilih biodata</option>
                                                        <?php foreach ($customer as $b) : ?>
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
                                                <label for="tgl_transaksi" class="form-label">Tanggal Transaksi</label>
                                                <input class="form-control" type="date" id="tgl_transaksi" name="tgl_transaksi" value="<?= $t['tgl_transaksi'] ?>">
                                                <?php if (isset($_SESSION['errors']['tgl_transaksi'])) : ?>
                                                    <p class="text-danger mt-1"><?= $_SESSION['errors']['tgl_transaksi'] ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="mb-3">
                                                <label for="waktu_transaksi" class="form-label">Waktu Transaksi</label>
                                                <input class="form-control" type="time" id="waktu_transaksi" name="waktu_transaksi" value="<?= $t['waktu_transaksi'] ?>">
                                                <?php if (isset($_SESSION['errors']['waktu_transaksi'])) : ?>
                                                    <p class="text-danger mt-1"><?= $_SESSION['errors']['waktu_transaksi'] ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-warning">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="hapus<?= $t['id_transaksi'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel<?= $t['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editLabel<?= $t['id'] ?>">Konfirmasi Hapus</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="<?= Routes::base('transaksi/edit') ?>">
                                        <input type="hidden" name="id_transaksi" value="<?= $t['id_transaksi'] ?>">
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                            <p class="text-center my-3">Apakah anda yakin ingin menghapus data ini?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
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
            <h4 class="my-2 mb-3 text-center">Tambah Transaksi</h4>
            <form class="" method="post" action="<?= Routes::base('transaksi/tambah') ?>">

                <div class="mb-3">
                    <label for="searchBiodata" class="form-label">Customer</label>
                    <div class="input-group">
                        <input type="text" class="form-control dropdown-toggle" id="searchBiodata" placeholder="Ketik untuk mencari..." data-bs-toggle="dropdown" aria-expanded="false" onkeyup="filterBiodata()" onblur="validateBiodata()">
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah</button>
                        <ul class="dropdown-menu w-100" id="biodataList" style="max-height: 200px; overflow-y: auto;">
                            <?php foreach ($customer as $b) : ?>
                                <li><a href="#" class="dropdown-item" onclick="selectBiodata(<?= $b['id'] ?>, '<?= $b['nama'] ?>')"><?= $b['nama'] . ' - ' . $b['notelp'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if (isset($_SESSION['errors']['id'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['id'] ?></p>
                    <?php endif; ?>
                    <input type="hidden" name="id_customer" id="selectedBiodata">
                </div>

                <div class="mb-3">
                    <label for="tgl_transaksi" class="form-label">Tanggal Transaksi</label>
                    <input class="form-control" id="tgl_transaksi" type="date" name="tgl_transaksi" placeholder="Masukan username">
                    <?php if (isset($_SESSION['errors']['tgl_transaksi'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['tgl_transaksi'] ?></p>
                    <?php endif;  ?>
                </div>

                <div class="mb-3">
                    <label for="waktu_transaksi" class="form-label">Waktu Transaksi</label>
                    <input class="form-control" type="time" name="waktu_transaksi" id="waktu_transaksi" placeholder="********">
                    <?php if (isset($_SESSION['errors']['waktu_transaksi'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['waktu_transaksi'] ?></p>
                    <?php endif;  ?>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Petugas</label>
                    <input class="form-control" type="text" id="nama" value="<?= $_SESSION['user']['nama'] ?>" readonly disabled>
                    <input class="form-control" type="hidden" name="id_petugas" id="nama" value="<?= $_SESSION['user']['id'] ?>">
                    <?php if (isset($_SESSION['errors']['nama'])) :  ?>
                        <p class="text-danger mt-1"><?= $_SESSION['errors']['nama'] ?></p>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Customer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="" method="post" action="<?= Routes::base('customer/tambah_customer') ?>">
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