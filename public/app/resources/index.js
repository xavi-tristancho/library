module.exports = function(ngModule)
{
    require('./github')(ngModule);
    require('./managers')(ngModule);
    require('./projects')(ngModule);
    require('./users')(ngModule);
}