module.exports = function(ngModule)
{
    ngModule.config(function($stateProvider, $urlRouterProvider) {

        $urlRouterProvider.otherwise("/");

        $stateProvider
            .state('home', {
                url: "/",
                templateUrl: "/views/partials/dashboard.html"
            });
    });
}