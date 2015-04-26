module.exports = function(ngModule)
{
    function addResource()
    {
        return {
            restrict: "E",
            scope : {
                resource : '@',
                placeholder : '@',
                params : '=',
                get : '&'
            },
            template : require("./templates/add-resource.html"),
            controller : function($scope, Api)
            {
                var vm = this;                

                vm.save = function()
                {
                    Api.save($scope.resource, vm.new, $scope.params)
                        .then(function(projects)
                        {                            
                            $scope.get();
                            vm.new.name = null;
                        });
                }            
            },
            controllerAs : 'button'
        }
    }

    ngModule.directive('addResource', addResource);
}