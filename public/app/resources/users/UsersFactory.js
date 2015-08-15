module.exports = function(ngModule) {

    function Users($resource)
    {
        return $resource('api/users/:username', { username : '@username' });
    }

    ngModule.factory('Users', Users);
}