module.exports = function(ngModule)
{
    function Repositories()
    {
        return {
            restrict: "E",
            scope : {
                projectId : "=project",
                manager : "@"
            },
            transclude: true,
            template : require("./templates/repositories.html"),
            controller : function($scope, $http, $stateParams, Api, Repositories, Github)
            {
                var vm = this;        
                vm.projectId = ($scope.projectId != undefined) ? $scope.projectId : parseInt($stateParams.id);

                vm.getAll = function()
                {        
                    Api.getAll('Repositories', { manager : $scope.manager, projectId : vm.projectId })
                        .then(function(repositories)
                        {
                            vm.repositories = chunk(repositories, 3);
                        });                                
                }

                vm.getAll();                        

                function chunk(arr, size) {
                  var newArr = [];

                  for (var i=0; i<arr.length; i+=size) 
                  {
                    newArr.push(arr.slice(i, i+size));
                  }

                  return newArr;
                }                
            },
            controllerAs : 'repositories'
        }
    }
    ngModule.directive('repositories', Repositories);
}