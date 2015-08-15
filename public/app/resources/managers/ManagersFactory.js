module.exports = function(ngModule) {

    function Managers($resource)
    {
        return $resource('api/managers/:managerId', { managerId : '@managerId' });
    }

    ngModule.factory('Managers', Managers);
}