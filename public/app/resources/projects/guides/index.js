module.exports = function(ngModule)
{
    require('./guide')(ngModule);
    require('./guides')(ngModule);
    require('./list-guide')(ngModule);
    require('./create-guide')(ngModule);
    require('./GuidesFactory')(ngModule);
}