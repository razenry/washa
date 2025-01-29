<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= Routes::base('src/output.css') ?>" rel="stylesheet">
    <script src="<?= Routes::base('node_modules/flowbite/dist/flowbite.min.js') ?>"></script>
    <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
</head>

<body>

    <?= App::extends('admin/layout/navbar') ?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

        <?= App::extends('admin/layout/sidebar') ?>

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <?= $content ?>
            </main>
            <?= App::extends('admin/layout/footer') ?>
         
        </div>

    </div>

</body>

</html>