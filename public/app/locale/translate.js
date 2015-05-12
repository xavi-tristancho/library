module.exports = function(ngModule)
{
    ngModule.config(function($translateProvider) {

        $translateProvider.preferredLanguage('en');

        $translateProvider.useStaticFilesLoader({
          prefix: 'app/locale/',
          suffix: '.json'
        });
    });
}