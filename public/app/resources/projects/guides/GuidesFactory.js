module.exports = function(ngModule) {

    function Guides($resource)
    {
        return $resource('api/projects/:projectId/guides/:guideId', 
        	{ 
        		projectId : '@projectId',
        		guideId : '@guideId'
        	},
            {
                update :
                {
                    method : 'PUT'
                }
            });
    }

    ngModule.factory('Guides', Guides);
}