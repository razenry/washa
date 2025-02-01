<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= Routes::assets('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@2.1.0/css/dataTables.bootstrap5.min.css">
    <title><?= $title ?? 'Washa | Razenry' ?></title>
</head>

<body>

    <?= App::extends('admin/layout/navbar') ?>

    <?= App::extends('admin/layout/sidebar') ?>

    <main class="container mt-3">
        <?= $content ?>
    </main>

    <?= App::extends('admin/layout/footer') ?>

    <script src="<?= Routes::assets('js/bootstrap.bundle.js') ?>"></script>

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#dataTable');
    </script>

</body>

</html>