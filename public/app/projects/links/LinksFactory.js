module.exports = function(ngModule) {

    function Links($resource)
    {
        return $resource('api/projects/:projectId/links/:linkId', 
        	{ 
        		projectId : '@projectId',
        		linkId : '@linkId'
        	});
    }

    ngModule.factory('Links', Links);
}