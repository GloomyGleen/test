import mix from 'laravel-mix';

// Обработка стилей
mix.styles([
    'resources/assets/admin/plugins/fontawesome-free/css/all.min.css',
    'resources/assets/admin/css/adminlte.min.css',
    'resources/assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css',
    'resources/assets/admin/plugins/select2/css/select2.css',
], 'public/assets/admin/css/admin.css');
mix.styles([
    'resources/assets/front/css/bootstrap.css',
    'resources/assets/front/css/font-awesome.min.css',
    'resources/assets/front/style.css',
    'resources/assets/front/css/animate.css',
    'resources/assets/front/css/responsive.css',
    'resources/assets/front/css/colors.css',
    'resources/assets/front/css/version/marketing.css',
],  'public/assets/front/css/front.css');


// Обработка скриптов
mix.scripts([
    'resources/assets/admin/plugins/jquery/jquery.min.js',
    'resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/plugins/select2/js/select2.full.js',
    'resources/assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/js/demo.js',
], 'public/assets/admin/js/admin.js');
mix.scripts([
    'resources/assets/front/js/jquery.min.js',
    'resources/assets/front/js/tether.min.js',
    'resources/assets/front/js/bootstrap.min.js',
    'resources/assets/front/js/animate.js',
    'resources/assets/front/js/custom.js',
], 'public/assets/front/js/front.js');

// Коирование шрифтов для fontawesome
mix.copyDirectory(
    'resources/assets/admin/plugins/fontawesome-free/webfonts',
    'public/assets/admin/webfonts' 
);
mix.copyDirectory(
    'resources/assets/front/fonts',
    'public/assets/front/fonts' 
);

// Копирование img
mix.copy(
    'resources/assets/admin/css/adminlte.min.css.map',
    'public/assets/admin/css/adminlte.min.css.map' 
);
mix.copyDirectory(
    'resources/assets/admin/img',
    'public/assets/admin/img' 
);
mix.copyDirectory(
    'resources/assets/front/images',
    'public/assets/front/images' 
);
mix.copyDirectory(
    'resources/assets/front/upload',
    'public/assets/front/upload' 
);
