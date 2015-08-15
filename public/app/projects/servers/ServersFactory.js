module.exports = function(ngModule) {

    function Servers($resource)
    {
        return $resource('api/projects/:projectId/servers/:serverId', { projectId : '@projectId', serverId : '@serverId' });
    }

    ngModule.factory('Servers', Servers);
}