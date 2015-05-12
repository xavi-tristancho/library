module.exports = function(ngModule)
{
    function deleteResource()
    {
        return {
            restrict: "E",
            scope : {
                resource : '@',
                params : '=',
                get : '&'
            },
            template : require("./templates/delete-resource.html"),
            controller : function($scope, Api, Alerts, $translate)
            {
                var vm = this;                

                vm.delete = function()
                {
                    var text = $translate.instant('alerts.confirm.message', { message: $translate.instant('resources.' + $scope.resource.toLowerCase() + '.delete') });
                    Alerts.confirm(text, function()
                    {                        
                        Api.delete($scope.resource, $scope.params)
                            .then(function(projects)
                            {
                                $scope.get();
                            });
                    });
                }
            },
            controllerAs : 'button'
        }
    }

    ngModule.directive('deleteResource', deleteResource);
}