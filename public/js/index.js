var angular = require('angular');

require('angular-resource');
require('angular-ui-router');
require('angular-filter');
require('sweetalert');
require('angular-sweetalert');

var ngModule = angular.module('app', [
    'ngResource',
    'ui.router',
    'angular.filter',
    'oitozero.ngSweetAlert'
]);

require('./config')(ngModule);
require('./filters')(ngModule);
require('./projects')(ngModule);
require('./projects/repositories')(ngModule);
require('./github')(ngModule);