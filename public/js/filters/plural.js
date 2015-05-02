module.exports = function(ngModule) {

    function plural()
    {
        return function(word)
        {       
            var end = word.charAt(word.length - 1);
                        
            if(end == 'y')
            {
                return word.substr(0,word.length - 1) + 'ies';
            }

            return word + 's';
        }
    }

    ngModule.filter('plural', plural);
}