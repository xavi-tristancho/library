module.exports = function(ngModule) {

    function url()
    {
        return function(word)
        {       
            var http = /http:\/\//g;
            var https = /https:\/\//g;        

            if(!http.test(word) && !https.test(word))
            {
                return 'http://' + word;
            }

            return word;            
        }
    }

    ngModule.filter('url', url);
}