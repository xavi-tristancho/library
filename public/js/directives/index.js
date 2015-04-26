module.exports = function(ngModule)
{
    require('./add-resource')(ngModule);
    require('./delete-resource')(ngModule);
}