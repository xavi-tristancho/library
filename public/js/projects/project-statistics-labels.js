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
                            vm.statistics = statistics;

                            var name = $translate.instant('resources.repositories.name');
                            name = (vm.statistics.github_repositories_count > 1) ? $filter('plural')(name) : name;

                            vm.repositories = { name : name };
                        });            
                }                             

                vm.getAll();                                
            },
            controllerAs : 'project'
        }
    }

    ngModule.directive('projectStatisticsLabels', projectStatisticsLabels);
}