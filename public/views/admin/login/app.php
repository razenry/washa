<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= Routes::assets('css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>


    <main class="container mt-3 d-flex justify-content-center align-items-center">
        <?= $content ?>
    </main>
    
    <script src="<?= Routes::assets('js/bootstrap.bundle.js') ?>"></script>
</body>

</html>