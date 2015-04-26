module.exports = function(ngModule)
{
    ngModule.config(function($translateProvider) {

        $translateProvider.preferredLanguage('en');

        $translateProvider.useStaticFilesLoader({
          prefix: 'js/locale/',
          suffix: '.json'
        });
    });
}