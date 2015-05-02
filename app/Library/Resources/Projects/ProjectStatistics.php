<?php namespace Library\Resources\Projects;


class ProjectStatistics {

    private $project;

    private $githubRepositories;

    public function __construct($project)
    {
        $this->setProject($project);
    }

    function setProject($project)
    {
        $this->project = $project;
    }

    function getProject()
    {
        return $this->project;
    }

    function setGithubRepositories($githubRepositories)
    {
        $this->githubRepositories = $githubRepositories;
    }

    function getGithubRepositories()
    {
        return $this->githubRepositories;
    }

    function getGithubRepositoriesCount()
    {
        return count($this->githubRepositories);
    }
} 