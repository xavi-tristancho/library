module.exports = function(ngModule)
{	
    require('./guides')(ngModule);
    require('./guide')(ngModule);
    require('./GuidesFactory')(ngModule);
}