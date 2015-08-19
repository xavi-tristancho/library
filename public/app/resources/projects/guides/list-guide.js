module.exports = function(ngModule)
{
    function listGuide()
    {
        return {
            restrict: "E",
            scope : {
                guide : "=",
                projectId : "=project",
                get : "&"
            },
            template : require("./templates/list-guide.html"),
        }
    }
    ngModule.directive('listGuide', listGuide);
}