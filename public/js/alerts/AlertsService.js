module.exports = function(ngModule) {

    function Alerts($translate, SweetAlert)
    {
    	this.confirm = function(text, callback)
        {
            var sw = SweetAlert.swal(
            {
                title: $translate.instant('alerts.confirm.title'),
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: $translate.instant('alerts.confirm.confirm'),
                cancelButtonText: $translate.instant('alerts.confirm.cancel'),
                closeOnConfirm: true,
                closeOnCancel: true },
            function(isConfirm)
            {
                if (isConfirm) 
                {
                    callback();
                }
            });            
        }

        return this;
    }

    ngModule.factory('Alerts', Alerts);
}