module.exports = function(ngModule)
{
    function guide()
    {
        return {
            restrict: "E",
            scope : {
                projectId : "=project",
                guideId : "=guide"
            },
            template : require("./templates/guide.html"),
            controller : function($scope, $http, $state, $stateParams, Api)
            {
                var vm = this;
                vm.projectId = ($scope.projectId != undefined) ? $scope.projectId : parseInt($stateParams.id);
                vm.guideId = ($scope.guideId != undefined) ? $scope.guideId : parseInt($stateParams.guideId);

                vm.find = function()
                {
                    Api.find('Guides', { projectId : vm.projectId, guideId : vm.guideId })
                        .then(function(guide)
                        {
                            vm.guide = guide;
                        });
                }

                vm.find();

                vm.back = function()
                {
                    $state.go('viewProject', { id : vm.projectId });
                }
            },
            controllerAs : 'guides'
        }
    }
    ngModule.directive('guide', guide);
}