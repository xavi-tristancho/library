module.exports = function(ngModule)
{
	require('./project-statistics-labels')(ngModule);
    require('./projects')(ngModule);
    require('./project')(ngModule);
    require('./ProjectsFactory')(ngModule);
    require('./ProjectsStatisticsFactory')(ngModule);
    require('./repositories')(ngModule);
    require('./links')(ngModule);
    require('./servers')(ngModule);
    require('./guides')(ngModule);
}