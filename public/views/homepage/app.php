
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?= Routes::base('src/output.css') ?>" rel="stylesheet">
  <script src="<?= Routes::base('node_modules/flowbite/dist/flowbite.min.js') ?>"></script>
  <title><?= $app_name ?? 'Washa | Razenry' ?></title>
</head>

<body>
  
  <?= App::extends('homepage/layout/navbar') ?>
  
  <?= $content ?>
  
</body>

</html>