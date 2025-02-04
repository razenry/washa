<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahLabel">Tambah Layanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="" method="post" action="<?= Routes::base('detail_transaksi/tambah') ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="harga_satuan" class="form-label">Jenis Cucian</label>
                        <div class="input-group">
                            <input type="text" class="form-control dropdown-toggle" id="searchBiodata" placeholder="Ketik untuk mencari..." data-bs-toggle="dropdown" aria-expanded="false" onkeyup="filterBiodata()" onblur="validateBiodata()">
                            <ul class="dropdown-menu w-100" id="biodataList" style="max-height: 200px; overflow-y: auto;">
                                <?php foreach ($jenis_cucian as $b) : ?>
                                    <li><a href="#" class="dropdown-item" onclick="selectBiodata(<?= $b['id_jenis_cucian'] ?>, '<?= $b['nama'] ?>')"><?= $b['nama'] . ' - ' . CurrencyFormatter::formatCurrency($b['harga']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <input type="hidden" name="id_jenis_cucian" id="selectedBiodata">
                        </div>
                    </div>
                    <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">

                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat</label>
                        <input class="form-control" id="berat" type="number" name="berat" placeholder="Masukan berat">
                    </div>

                    <div class="mb-3">
                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                        <input class="form-control" id="harga_satuan" type="number" name="harga_satuan" placeholder="Masukan harga satuan">
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