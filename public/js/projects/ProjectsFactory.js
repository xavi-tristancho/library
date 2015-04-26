module.exports = function(ngModule) {

    function Projects($resource)
    {
        return $resource('api/projects/:projectId', { projectId : '@projectId' });
    }

    ngModule.factory('Projects', Projects);
}