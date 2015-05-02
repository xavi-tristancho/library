module.exports = function(ngModule) {

    function ProjectsStatistics($resource)
    {
        return $resource('api/statistics/projects/:projectId', { projectId : '@projectId' });
    }

    ngModule.factory('ProjectsStatistics', ProjectsStatistics);
}