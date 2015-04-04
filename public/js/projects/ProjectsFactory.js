module.exports = function(ngModule) {

    function Projects($resource)
    {
        return $resource('api/projects/:id');
    }

    ngModule.factory('Projects', Projects);
}