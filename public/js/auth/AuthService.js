module.exports = function(ngModule)
{
    function Auth($rootScope, $http, localStorageService, Notifications)
    {
        function urlBase64Decode(str) 
        {
            var output = str.replace('-', '+').replace('_', '/');
            
            switch (output.length % 4)
            {
                case 0:
                    break;
                case 2:
                    output += '==';
                    break;
                case 3:
                    output += '=';
                    break;
                default:
                    throw 'Illegal base64url string!';
           }
           
           return window.atob(output);
        }

        function getClaimsFromToken() 
        {
            var token = localStorageService.get('token');
            var user = {};

            if (typeof token !== 'undefined' && token != null)
            {
                var encoded = token.split('.')[1];
                user = JSON.parse(urlBase64Decode(encoded));
            }

            return user;
        }

        var tokenClaims = getClaimsFromToken();

        this.signin = function (data, success, error)
        {
            $http.post('api/login', data).success(success).error(function(response)
            {
                Notifications.error(response.error);
            })
        }
         
        this.logout = function (success)
        {
            tokenClaims = {};
            localStorageService.remove('token');
            $rootScope.token = null;
            success();
        }

        this.getTokenClaims = function () 
        {
            return tokenClaims;
        }

        return this;
    }

    ngModule.factory('Auth', Auth);
}