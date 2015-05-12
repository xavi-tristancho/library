module.exports = function(ngModule) {

  function SessionsController($rootScope, $state, localStorageService, Auth)
  {
    var vm = this;

    vm.token = localStorageService.get('token');
    vm.tokenClaims = Auth.getTokenClaims();

    if(vm.token != null)
    {
      $state.go('home');
    }

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
  }

  ngModule.controller('SessionsController', SessionsController);
}