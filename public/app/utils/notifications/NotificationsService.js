module.exports = function(ngModule) {

    function Notifications(toaster, $translate)
    {
    	this.success = function(response)
    	{
    		toaster.success({title: $translate.instant('notifications.done'), body: response.message});
    	}

        this.error = function(error)
        {
            toaster.error(error.status_code.toString(), error.message);        	   		
        }

        return this;
    }

    ngModule.factory('Notifications', Notifications);
}