module.exports = function(ngModule)
{
    function Repositories()
    {
        return {
            restrict: "E",
            scope : {
                projectId : "=project"
            },
            template : require("./repositories.html"),
            controller : function($scope, Api, Repositories, Github)
            {
                var vm = this;        

                vm.getAll = function()
                {        
                    Api.getAll('Repositories', { projectId : $scope.projectId })
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