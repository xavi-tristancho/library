var angular = require('angular');

require('angular-resource');
require('angular-animate');
require('angular-ui-router');
require('angular-filter');
require('angular-translate');
require('angular-local-storage');
require('angular-bootstrap');

var ngModule = angular.module('app', [
	'ngAnimate',
    'ngResource',
    'ui.router',
    'angular.filter',
    'oitozero.ngSweetAlert',
    'toaster',
    'pascalprecht.translate',
    'LocalStorageModule',
    'ui.bootstrap',
    'angular-loading-bar'
]);

require('./config')(ngModule);
require('./locale')(ngModule);
require('./auth')(ngModule);
require('./api')(ngModule);
require('./alerts')(ngModule);
require('./notifications')(ngModule);
require('./directives')(ngModule);
require('./filters')(ngModule);
require('./users')(ngModule);
require('./projects')(ngModule);
require('./projects/repositories')(ngModule);
require('./github')(ngModule);
require('./managers')(ngModule);