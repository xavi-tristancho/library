module.exports = function(ngModule) {

    function plural()
    {
        return function(word, num)
        {              
            this.pluralize = function()
            {
                var end = word.charAt(word.length - 1);
                            
                if(end == 'y')
                {
                    return word.substr(0,word.length - 1) + 'ies';
                }

                return word + 's';
            } 

            if(num != null)
            {
                if(parseInt(num) >= 2)
                {
                    return this.pluralize();
                }    
                else
                {
                    return word;
                }
            }
            else
            {
                return this.pluralize();
            }                                
        }
    }

    ngModule.filter('plural', plural);
}