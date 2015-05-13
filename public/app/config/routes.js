module.exports = function(ngModule)
{
    ngModule.config(function($stateProvider, $urlRouterProvider) {

        $urlRouterProvider.otherwise("/login");

        $stateProvider
            .state('login', {
                url: "/login",
                templateUrl: "/views/partials/login.html",
                controller: "SessionsController",
                controllerAs: "session"
            })
            .state('home', {
                url: "/",
                templateUrl: "/views/partials/dashboard.html"
            })
            .state('viewProject', {
                url: "/projects/:id",
                templateUrl: "/views/projects/show.html"
            })
            .state('options', {
                url: "/options",
                templateUrl: "/views/options/index.html"
            });
    });
}