<nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= Routes::base('admin') ?>">
      Washa
      <?php if (isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == "Admin") : ?>
        <span class="text-danger">(Admin)</span>
      <?php endif; ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= Routes::base('admin') ?>">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= Routes::base('admin/transaksi') ?>">Transaksi</a>
        </li>
        <?php if (isset($_SESSION['user']['level']) && $_SESSION['user']['level'] == "Admin") : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Master Data
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= Routes::base('admin/biodata') ?>">Biodata</a></li>
              <li><a class="dropdown-item" href="<?= Routes::base('admin/petugas') ?>">Petugas</a></li>
              <li><a class="dropdown-item" href="<?= Routes::base('admin/anggota') ?>">Anggota</a></li>
              <li><a class="dropdown-item" href="<?= Routes::base('admin/jenis_cucian') ?>">Jenis Cucian</a></li>
            </ul>
          </li>
        <?php endif; ?>

      </ul>
      <div class="d-flex">
        <a class="btn btn-outline-danger" href="<?= Routes::base('admin/logout') ?>">Logout</a>
      </div>
    </div>
  </div>
</nav>