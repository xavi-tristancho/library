module.exports = function(ngModule) {

    function lowercase()
    {
        return function(word)
        {                   
            return word.toLowerCase();
        }
    }

    ngModule.filter('lowercase', lowercase);
}