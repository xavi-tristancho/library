module.exports = function(ngModule)
{       
    require('./AuthService')(ngModule);
    require('./SessionsController')(ngModule);
}