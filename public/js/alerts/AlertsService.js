module.exports = function(ngModule) {

    function Alerts(SweetAlert)
    {
    	this.confirm = function(text, callback)
        {
            var sw = SweetAlert.swal(
            {
                title: "Are you sure?",
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
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