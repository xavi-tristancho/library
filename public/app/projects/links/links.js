module.exports = function(ngModule)
{
    function links()
    {
        return {
            restrict: "E",
            scope : {
                projectId : "=project",
                manager : "@"
            },            
            template : require("./templates/links.html"),
            controller : function($scope, $http, $stateParams, Api)
            {
                var vm = this;        
                vm.projectId = ($scope.projectId != undefined) ? $scope.projectId : parseInt($stateParams.id);

                vm.getAll = function()
                {
                    Api.getAll('Links', { projectId : vm.projectId })
                        .then(function(links)
                        {
                            vm.links = links;
                        });
                }

                vm.getAll();                                
            },
            controllerAs : 'links'
        }
    }
    ngModule.directive('links', links);
}