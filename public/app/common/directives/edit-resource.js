module.exports = function(ngModule)
{
    function editResource()
    {
        return {
            restrict: "E",
            scope : {
                state : "@",
                params : "="
            },
            template : require("./templates/edit-resource.html"),
            controller : function($scope, $state)
            {
                var vm = this;

                vm.redirect = function()
                {
                    $state.go($scope.state, $scope.params);
                }
            },
            controllerAs : 'button'
        }
    }

    ngModule.directive('editResource', editResource);
}