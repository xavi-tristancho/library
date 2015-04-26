module.exports = function(ngModule) {

    function singular()
    {
        return function(word)
        {       
            var end = word.substr(word.length - 3);
                        
            if(end == 'ies')
            {
                return word.substr(0,word.length - 3) + 'y';
            }

            return word.substr(0,word.length -1);
        }
    }

    ngModule.filter('singular', singular);
}