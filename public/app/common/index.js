module.exports = function(ngModule)
{
    require('./api')(ngModule);
    require('./auth')(ngModule);
    require('./directives')(ngModule);
    require('./filters')(ngModule);
}