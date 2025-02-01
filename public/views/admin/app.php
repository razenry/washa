<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= Routes::assets('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
</body>

</html>