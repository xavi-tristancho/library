module.exports = function(ngModule)
{
    function guides()
    {
        return {
            restrict: "E",
            scope : {
                projectId : "=project",
                manager : "@"
            },            
            template : require("./templates/guides.html"),
            controller : function($scope, $http, $stateParams, Api)
            {
                var vm = this;        
                vm.projectId = ($scope.projectId != undefined) ? $scope.projectId : parseInt($stateParams.id);

                vm.getAll = function()
                {
                    Api.getAll('Guides', { projectId : vm.projectId })
                        .then(function(guides)
                        {
                            vm.guides = guides;
                        });
                }

                vm.getAll();                                
            },
            controllerAs : 'guides'
        }
    }
    ngModule.directive('guides', guides);
}