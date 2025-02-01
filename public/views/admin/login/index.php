<div class="card w-25 my-5 shadow p-3">
    <div class="card-header bg-white">
        <h1 class="text-center text-primary fb-bold">washa</h1>
    </div>
    <div class="card-body ">
        <form action="<?= Routes::base('admin/auth') ?>" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="username" name="username">
                <?php if (isset($pesan_error['username'])) : ?>
                    <label for="" class="form-label text-danger mt-2"><?= $pesan_error['username'] ?></label>
                    <?php unset($_SESSION['login_gagal']['pesan_error']['username']) ?>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" placeholder="password" name="password">
                <?php if (isset($pesan_error['password'])) : ?>
                    <label for="" class="form-label text-danger mt-2"><?= $pesan_error['password'] ?></label>
                    <?php unset($_SESSION['login_gagal']['pesan_error']['password']) ?>
                <?php endif; ?>
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </div>
        </form>
    </div>
</div>