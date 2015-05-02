module.exports = function(ngModule)
{
    function Repository()
    {
        return {
            restrict: "E",
            scope : {
                repo : "=",
                projectId : "=project",
                get : "&"
            },
            template : require("./templates/repository.html"),
        }
    }
    ngModule.directive('repository', Repository);
}