module.exports = function(ngModule) {

    function Github($resource)
    {
        return $resource('https://api.github.com/repos/:user/:repo', {}, {
        	get : {
        		method: 'GET',
        		cache : true
        	}
        });
    }

    ngModule.factory('Github', Github);
}