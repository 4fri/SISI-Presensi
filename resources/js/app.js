import './bootstrap';

import '../../node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';

import '../../node_modules/admin-lte/dist/js/adminlte.min.js';

import '../../node_modules/admin-lte/dist/js/demo.js';

import '../../node_modules/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js';

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .autoload({
       jquery: ['$', 'window.jQuery', 'jQuery'],
       'popper.js/dist/umd/popper.js': ['Popper']
   })
   .extract();
