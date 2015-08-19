module.exports = function(ngModule)
{
    function createGuide()
    {
        return {
            restrict: "E",
            template : require("./templates/create-guide.html"),
            controller : function($scope, $http, $state, $stateParams, Api)
            {
                var vm = this;

                var projectId = parseInt($stateParams.id);
                var params = { projectId : projectId };

                vm.save = function()
                {
                    if(vm.new != null)
                    {
                        Api.save('Guides', vm.new, params)
                            .then(function()
                            {
                                $state.go('viewProject', { id : projectId});
                            });
                    }
                }
            },
            controllerAs : 'guides'
        }
    }
    ngModule.directive('createGuide', createGuide);
}