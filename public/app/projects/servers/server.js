module.exports = function(ngModule)
{
    function server()
    {
        return {
            restrict: "E",
            scope : {
                server : "=",
                projectId : "=project",
                get : "&"
            },
            template : require("./templates/server.html"),
        }
    }
    ngModule.directive('server', server);
}