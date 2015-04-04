module.exports = function(ngModule)
{
    function Repositories()
    {
        return {
            restrict: "E",
            scope : {
                project : "="
            },
            template : require("./repositories.html"),
            controller : function($scope, Repositories, Github, SweetAlert)
            {
                var vm = this;

                vm.projectId = $scope.project;
                vm.repositories = [];
                vm.new = {name: ''};

                vm.get = function(){
                    vm.new.name = null;
                    Repositories.get({project_id : vm.projectId}, function(data)
                    {                        
                        vm.repositories = chunk(data.data, 3);
                    });                    
                }

                vm.get();

                vm.add = function()
                {
                    Repositories.save({project_id : vm.projectId}, vm.new, vm.get);
                }

                vm.delete = function(id){
                    SweetAlert.swal({
                            title: "Are you sure?",
                            text: "The repository will be deleted!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel plx!",
                            closeOnConfirm: true,
                            closeOnCancel: true },
                        function(isConfirm){
                            if (isConfirm) {
                                Repositories.delete({project_id: vm.projectId, repository_id:id}, vm.get);
                            }
                        });
                }

                function chunk(arr, size) {
                  var newArr = [];
                  for (var i=0; i<arr.length; i+=size) {
                    newArr.push(arr.slice(i, i+size));
                  }
                  return newArr;
                }
            },
            controllerAs : 'repositories'
        }
    }

    ngModule.directive('repositories', Repositories);
}