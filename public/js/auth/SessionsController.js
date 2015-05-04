module.exports = function(ngModule) {

  function SessionsController($rootScope, $state, localStorageService, Auth)
  {
    var vm = this;

    function successAuth(res) {       
       localStorageService.set('token', res.token);
       $rootScope.token = res.token;
       $state.go('home');
    }

    vm.signin = function () {
       var formData = {
           username: vm.username,
           password: vm.password
       };

       Auth.signin(formData, successAuth);
    };    

    vm.token = localStorageService.get('token');
    vm.tokenClaims = Auth.getTokenClaims();
  }

  ngModule.controller('SessionsController', SessionsController);
}