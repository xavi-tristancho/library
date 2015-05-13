module.exports = function(ngModule)
{
    ngModule.config(function($httpProvider) {

        $httpProvider.interceptors.push('Interceptor');
    });
}