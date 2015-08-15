module.exports = function(ngModule)
{
    function projects()
    {
        return {
            restrict: "E",
            scope : {},
            template : require("./templates/projects.html"),
            controller : function(Api)
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

    ngModule.directive('projects', projects);
}