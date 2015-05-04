module.exports = function(ngModule)
{
    function navbar()
    {
        return {
            restrict: "E",            
            template : require("./templates/navbar.html"),
            controller : function($state, Auth, Api)
            {
                var vm = this;                

                vm.logout = function () 
                {
                    Auth.logout(function () 
                    {                        
                        $state.go('login');
                    });
			    };          

                vm.me = function()
                {
                    Api.find('Users', { username : 'me' })
                        .then(function(user)
                        {
                            vm.username = user.username;
                        });
                }  

                vm.me();
            },
            controllerAs : 'navbar'
        }
    }

    ngModule.directive('navbar', navbar);
}