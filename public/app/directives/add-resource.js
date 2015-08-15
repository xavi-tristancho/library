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
                textInput : "@",
            },
            template : require("./templates/add-resource.html"),
            controller : function($scope, Api)
            {
                var vm = this;

                $scope.transclude = eval($scope.transclude);
                $scope.transclude = ($scope.transclude == undefined) ? false : $scope.transclude;
                $scope.textInput = eval($scope.textInput);
                $scope.textInput = ($scope.textInput == undefined) ? false : $scope.textInput;

                vm.save = function()
                {
                    if(vm.new != null)
                    {                        
                        Api.save($scope.resource, vm.new, $scope.params)
                        .then(function(projects)
                        {                            
                            $scope.get();
                            vm.new = null;
                        });
                    }                    
                }            
            },
            controllerAs : 'button'
        }
    }

    ngModule.directive('addResource', addResource);
}