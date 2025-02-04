<h1 class="fw-bold my-3"><?= $title ?? 'Data' ?></h1>
<div class="row justify-content-center my-5">
    <div class="col-lg-8">
        <div class="card shadow border-0 rounded-4 p-4">
            <div class="row align-items-center">
                <!-- Bagian Profil -->
                <div class="col-md-6 text-center">
                    <h3 class="fw-bold"><?= $profile['nama'] ?></h3>
                    <p class="text-muted mb-1"><?= $profile['username'] ?></p>
                    <p class="text-muted"><?= $profile['email'] ?></p>
                    <span class="badge <?= $profile['status'] == '1' ? 'bg-success' : 'bg-danger' ?> px-3 py-2">
                        <?= $profile['status'] == '1' ? 'Aktif' : 'Nonaktif' ?>
                    </span>
                </div>

                <!-- Form Ubah Profile -->
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3 text-center">Edit Profile</h5>
                    <form action="<?= Routes::base('admin/update') ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control shadow-sm" value="<?= $profile['username'] ?>" >
                            <input type="hidden" name="id" class="form-control shadow-sm" value="<?= $profile['id'] ?>" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control shadow-sm" value="" >
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>