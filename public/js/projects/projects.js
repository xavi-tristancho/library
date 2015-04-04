module.exports = function(ngModule)
{
    function Projects()
    {
        return {
            restrict: "E",
            scope : {},
            template : require("./projects.html"),
            controller : function(Projects, SweetAlert)
            {
                var vm = this;

                vm.projects = {};
                vm.new = {name: ''};

                vm.get = function(){
                    vm.new.name = null;
                    Projects.get(function(data){
                        vm.projects = data.data;
                    });
                }

                vm.get();

                vm.add = function()
                {
                    Projects.save(vm.new, vm.get);
                }

                vm.delete = function(id){
                    SweetAlert.swal({
                            title: "Are you sure?",
                            text: "The project and all his repositories will be deleted!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel plx!",
                            closeOnConfirm: true,
                            closeOnCancel: true },
                        function(isConfirm){
                            if (isConfirm) {
                                Projects.delete({id:id}, vm.get);
                            }
                        });
                }
            },
            controllerAs : 'projects'
        }
    }

    ngModule.directive('projects', Projects);
}