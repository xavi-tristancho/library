module.exports = function(ngModule)
{
	require('./view-resource')(ngModule);
    require('./add-resource')(ngModule);
    require('./delete-resource')(ngModule);
}