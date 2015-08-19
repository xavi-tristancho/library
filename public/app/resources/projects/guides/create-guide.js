module.exports = function(ngModule)
{
    function createGuide()
    {
        return {
            restrict: "E",
            template : require("./templates/create-guide.html"),
            scope :
            {
              edit : "@"
            },
            controller : function($scope, $http, $state, $stateParams, Api)
            {
                var vm = this;

                var projectId = parseInt($stateParams.id);
                var params = { projectId : projectId };
                var edit = eval($scope.edit);

                vm.button = "btn-success";
                vm.icon = "fa-plus-circle";

                vm.save = function()
                {
                    if(vm.new != null)
                    {
                        if(! edit)
                        {
                            Api.save('Guides', vm.new, params)
                                .then(function()
                                {
                                    $state.go('viewProject', { id : projectId});
                                });
                        }
                        else
                        {
                            params = { projectId : projectId, guideId : $stateParams.guideId };
                            Api.update('Guides', vm.new, params)
                                .then(function()
                                {
                                    $state.go('viewProject', { id : projectId});
                                });
                        }
                    }
                }

                vm.find = function()
                {
                    Api.find('Guides', { projectId : $stateParams.id, guideId : $stateParams.guideId })
                        .then(function(guide)
                        {
                            vm.new = guide;
                        });
                }

                if (edit)
                {
                    vm.button = "btn-primary";
                    vm.icon = "fa-refresh";
                    vm.find();
                }
            },
            controllerAs : 'guides'
        }
    }
    ngModule.directive('createGuide', createGuide);
}