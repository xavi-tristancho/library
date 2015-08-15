module.exports = function(ngModule)
{
    function servers()
    {
        return {
            restrict: "E",
            scope : {
                projectId : "=project",
                manager : "@"
            },            
            template : require("./templates/servers.html"),
            controller : function($scope, $http, $stateParams, Api)
            {
                var vm = this;        
                vm.projectId = ($scope.projectId != undefined) ? $scope.projectId : parseInt($stateParams.id);

                vm.getAll = function()
                {
                    Api.getAll('Servers', { projectId : vm.projectId })
                        .then(function(servers)
                        {
                            vm.servers = servers;
                        });
                }

                vm.getAll();                                
            },
            controllerAs : 'servers'
        }
    }
    ngModule.directive('servers', servers);
}