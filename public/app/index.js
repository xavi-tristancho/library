var angular = require('angular');

require('angular-resource');
require('angular-animate');
require('angular-ui-router');
require('angular-filter');
require('angular-translate');
require('angular-local-storage');
require('angular-bootstrap');
require('angular-marked');
require('angular-sanitize');

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
    'angular-loading-bar',
    'hc.marked',
    'ngSanitize'
]);

require('./config')(ngModule);
require('./common')(ngModule);
require('./resources')(ngModule);
require('./utils')(ngModule);