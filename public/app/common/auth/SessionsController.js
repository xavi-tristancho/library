    module.exports = function(ngModule) {

    function SessionsController($rootScope, $state, localStorageService, Auth, $timeout, Notifications)
    {
        var vm = this;

        vm.token = localStorageService.get('token');
        vm.tokenClaims = Auth.getTokenClaims();

        if(vm.token != null)
        {
            $state.go('home');
        }

        function successAuth(res)
        {
            localStorageService.set('token', res.token);
            $rootScope.token = res.token;
            $state.go('home');
        }

        function failedAuth(error)
        {
            vm.logginIn = false;
            Notifications.error(error.error);
        }

        vm.signin = function ()
        {
            vm.logginIn = true;

            var formData = {
               username: vm.username,
               password: vm.password
            };

            Auth.signin(formData, successAuth, failedAuth);
        };    
    }

    ngModule.controller('SessionsController', SessionsController);
    }