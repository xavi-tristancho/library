module.exports = function(ngModule)
{
    require('./projects')(ngModule);
    require('./project')(ngModule);
    require('./ProjectsFactory')(ngModule);
}