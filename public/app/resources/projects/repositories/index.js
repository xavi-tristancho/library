module.exports = function(ngModule)
{
	require('./repository')(ngModule);
    require('./repositories')(ngModule);
    require('./RepositoriesFactory')(ngModule);
}