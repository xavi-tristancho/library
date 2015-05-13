module.exports = function(ngModule)
{
    function addResource()
    {
        return {
            restrict: "E",
            transclude: true,
            scope : {
                resource : '@',
                placeholder : '@',
                params : '=',
                get : '&',
                transclude : "@",                
            },
            template : require("./templates/add-resource.html"),
            controller : function($scope, Api)
            {
                var vm = this;                

                vm.save = function()
                {
                    if(vm.new != null)
                    {                        
                        Api.save($scope.resource, vm.new, $scope.params)
                        .then(function(projects)
                        {                            
                            $scope.get();
                            vm.new = null;
                        }, function()
                        {
                            console.log('error');
                        });
                    }                    
                }            
            },
            controllerAs : 'button'
        }
    }

    ngModule.directive('addResource', addResource);
}