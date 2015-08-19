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
            .state('addGuide', {
                url: "/projects/:id/guides/create",
                templateUrl: "/views/projects/guides/create.html",
                controllerAs: "guides"
            })
            .state('viewGuide', {
                url: "/projects/:id/guides/:guideId",
                templateUrl: "/views/projects/guides/view.html",
                controllerAs: "guides"
            })
            .state('options', {
                url: "/options",
                templateUrl: "/views/options/index.html"
            });
    });
}