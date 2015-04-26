module.exports = function(ngModule)
{
    function Projects()
    {
        return {
            restrict: "E",
            scope : {},
            template : require("./projects.html"),
            controller : function(Api, Alerts)
            {
                var vm = this;

                vm.getAll = function()
                {
                    Api.getAll('Projects')
                        .then(function(projects)
                        {
                            vm.projects = projects;
                        });            
                }                

                vm.getAll();                                
            },
            controllerAs : 'projects'
        }
    }

    ngModule.directive('projects', Projects);
}