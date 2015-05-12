module.exports = function(ngModule)
{
    require('./managers')(ngModule);
    require('./ManagersFactory')(ngModule);
}