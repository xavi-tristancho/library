module.exports = function(ngModule)
{
    function viewResource()
    {
        return {
            restrict: "E",
            scope : {      
                route : '@',
                params : '='
            },
            controller : function($scope, $state)
            {
                var vm = this;

                vm.go = function()
                {
                    $state.go($scope.route, $scope.params);
                }
            },
            template : require("./templates/view-resource.html"),            
            controllerAs : 'button'
        }
    }

    ngModule.directive('viewResource', viewResource);
}