module.exports = function(ngModule)
{
    function project()
    {
        return {
            restrict: "E",
            scope : {
                id : "="
            },
            template : require("./templates/project.html"),
            controller : function($scope, Api, $stateParams)
            {
                var vm = this;

                vm.id = ($scope.id != undefined) ? $scope.id : parseInt($stateParams.id);

                vm.find = function()
                {
                    Api.find('Projects', { projectId : vm.id })
                        .then(function(project)
                        {
                            vm.project = project;
                        });            
                }                

                vm.find();                                
            },
            controllerAs : 'project'
        }
    }

    ngModule.directive('project', project);
}