module.exports = function(ngModule)
{	
    require('./ServersFactory')(ngModule);
    require('./servers')(ngModule);
    require('./server')(ngModule);
}