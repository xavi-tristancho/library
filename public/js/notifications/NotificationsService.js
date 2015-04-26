module.exports = function(ngModule) {

    function Notifications(toaster, $translate)
    {
    	this.success = function(response)
    	{
    		toaster.success({title: $translate.instant('notifications.done'), body: response.message});
    	}

        this.error = function(response)
        {
            toaster.error(response.status_code.toString(), response.message);        	   		
        }

        return this;
    }

    ngModule.factory('Notifications', Notifications);
}