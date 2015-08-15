module.exports = function(ngModule)
{
    function guide()
    {
        return {
            restrict: "E",
            scope : {
                guide : "=",
                projectId : "=project",
                get : "&"
            },
            template : require("./templates/guide.html"),
        }
    }
    ngModule.directive('guide', guide);
}