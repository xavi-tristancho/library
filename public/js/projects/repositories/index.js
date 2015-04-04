module.exports = function(ngModule)
{
    require('./repositories')(ngModule);
    require('./RepositoriesFactory')(ngModule);
}