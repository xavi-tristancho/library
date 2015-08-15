module.exports = function(ngModule) 
{
    function Interceptor($rootScope, $q, localStorageService, $location, Notifications)
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
                if (response.status === 404 || response.status === 400)
                {
                    if(response.data.error == 'user_not_found' || response.data.error == 'token_expired')
                    {
                        localStorageService.remove('token');
                        $rootScope.token = null;
                        $location.path('login');
                    }                        
                }                            
                                
                return $q.reject(response);
            }
        };
    }

    ngModule.factory('Interceptor', Interceptor);    
}