module.exports = function(ngModule)
{
    function managers()
    {
        return {
            restrict: "E",
            scope : {},
            template : require("./templates/managers.html"),
            controller : function(Api)
            {
                var vm = this;

                vm.getAll = function()
                {
                    Api.getAll('Managers')
                        .then(function(managers)
                        {
                            vm.managers = managers;
                        });            
                }                

                vm.getAll();                                
            },
            controllerAs : 'managers'
        }
    }

    ngModule.directive('managers', managers);
}