module.exports = function(ngModule)
{
    function link()
    {
        return {
            restrict: "E",
            scope : {
                link : "=",
                projectId : "=project",
                get : "&"
            },
            template : require("./templates/link.html"),
        }
    }
    ngModule.directive('libraryLink', link);
}