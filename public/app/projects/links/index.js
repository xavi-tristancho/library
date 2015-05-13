module.exports = function(ngModule)
{	
    require('./links')(ngModule);
    require('./link')(ngModule);
    require('./LinksFactory')(ngModule);
}