module.exports = function(ngModule) {

    function Repositories($resource)
    {
        return $resource('api/projects/:project_id/repositories/:repository_id');
    }

    ngModule.factory('Repositories', Repositories);
}