module.exports = function(ngModule)
{
    function formOption()
    {
        return {
            restrict: "E",            
            scope : {
                resource : '@',                
                model : '=',                
            },
            template : require("./templates/form-option.html"),
            controller : function($scope, Api)
            {
                var vm = this;                

                vm.getAll = function()
                {
                    Api.getAll($scope.resource)
                        .then(function(items)
                        {
                            vm.items = items;
                        });            
                }                

                vm.getAll();            
            },
            controllerAs : 'option'
        }
    }

    ngModule.directive('formOption', formOption);
}