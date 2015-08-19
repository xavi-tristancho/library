module.exports = function(ngModule)
{
	require('./view-resource')(ngModule);
    require('./add-resource')(ngModule);
    require('./edit-resource')(ngModule);
    require('./delete-resource')(ngModule);
    require('./form-option')(ngModule);
    require('./navbar')(ngModule);    
}