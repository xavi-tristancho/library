module.exports = function(ngModule)
{
    function projectStatisticsLabels()
    {
        return {
            restrict: "E",
            scope : {
                id : '='
            },
            template : require("./templates/project-statistics-labels.html"),
            controller : function($scope, $filter, $translate, Api)
            {
                var vm = this;

                vm.getAll = function()
                {
                    Api.getAll('ProjectsStatistics', { projectId : $scope.id })
                        .then(function(statistics)
                        {                            
                            vm.dependencies = statistics.repositories_count;
                        });            
                }                             

                vm.getAll();                                
            },
            controllerAs : 'project'
        }
    }

    ngModule.directive('projectStatisticsLabels', projectStatisticsLabels);
}