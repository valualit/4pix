const mix = require('laravel-mix');

mix.webpackConfig({
	resolve: {
		extensions: ['.js', '.vue'],
		alias: {
			'@': __dirname + '/resources',
			'%adminPath%': '/admin/'
		}
	}
}); 

mix.js('resources/js/app-admin.js', 'public/js/app-admin.js');

mix.scripts([
	'public/js/app-admin.js',
//	'resources/views/admin/plugins/jquery/jquery.min.js',
//	'resources/views/admin/plugins/jquery-ui/jquery-ui.min.js',
//	'resources/views/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
//	'resources/views/admin/plugins/chart.js/Chart.min.js',
//	'resources/views/admin/plugins/jquery-knob/jquery.knob.min.js',
//	'resources/views/admin/plugins/moment/moment.min.js',
//	'resources/views/admin/plugins/daterangepicker/daterangepicker.js',
//	'resources/views/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
//	'resources/views/admin/plugins/summernote/summernote-bs4.min.js',
//	'resources/views/admin/plugins/summernote/lang/summernote-ru-RU.min.js',
//	'resources/views/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
	'resources/views/admin/dist/js/adminlte.js',
//	'resources/views/admin/dist/js/demo.js',
//	'resources/views/admin/plugins/toastr/toastr.min.js',
//	'resources/views/admin/dist/js/zk.js',
//	'resources/views/admin/dist/js/synctranslit.js',
//	'resources/views/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js',
//	'resources/views/admin/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.ru.js',
//	'resources/views/admin/dist/js/script.js',
], 'public/js/admin.js'); 


mix.styles([
    'resources/views/admin/plugins/fontawesome-free/css/all.min.css',
    'resources/views/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
    'resources/views/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
    'resources/views/admin/dist/css/adminlte.min.css',
    'resources/views/admin/dist/css/style.css',
    'resources/views/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
    'resources/views/admin/plugins/daterangepicker/daterangepicker.css',
    'resources/views/admin/plugins/summernote/summernote-bs4.css',
], 'public/css/admin.css');

//mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css'); 
