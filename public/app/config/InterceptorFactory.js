module.exports = function(ngModule) 
{
    function Interceptor($rootScope, $q, localStorageService, $location)
    {
        return {
            'request': function (config)
            {
                config.headers = config.headers || {};
            
                if (localStorageService.get('token'))
                {
                    $rootScope.token = localStorageService.get('token');
                    config.headers.Authorization = 'Bearer ' + localStorageService.get('token');
                }
                
                return config;
            },
            'responseError': function (response)
            {
                if (response.status === 404)
                {
                    if(response.data.error == 'user_not_found')
                        $rootScope.token = null;
                        $location.path('/login');
                }
                                
                return $q.reject(response);
            }
        };
    }

    ngModule.factory('Interceptor', Interceptor);    
}