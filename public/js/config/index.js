module.exports = function(ngModule)
{
    require('./routes')(ngModule);
    require('./interceptor')(ngModule);
    require('./interceptorFactory')(ngModule);
}