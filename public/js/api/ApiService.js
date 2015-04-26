module.exports = function(ngModule) {

    function Api($injector, Notifications)
    {
        this.getAll = function(factory, params)
        {
        	return $injector.get(factory).get(params)
                .$promise.then(function(response)
                {                    
                    return response.data;
                },
                function(response)
                {
                    Notifications.error(response.data.error);
                })        		
        }

        this.find = function(factory, params)
        {
            return $injector.get(factory).get(params)
                .$promise.then(function(response)
                {                    
                    return response.data;
                },
                function(response)
                {
                    Notifications.error(response.data.error);
                })
        }

        this.save = function(factory, object, params)
        {
            return $injector.get(factory).save(params, object)
                .$promise.then(function(response)
                {
                    Notifications.success(response.success);                    
                    return response.data;
                },
                function(response)
                {
                    Notifications.error(response.data.error);                    
                })
        }

        this.delete = function(factory, params)
        {            
            return $injector.get(factory).delete(params)
                .$promise.then(function(response)
                {
                    Notifications.success(response.success);                    
                    return response.data;
                },
                function(response)
                {
                    Notifications.error(response.data.error);                    
                })    
        }

        return this;
    }

    ngModule.factory('Api', Api);
}