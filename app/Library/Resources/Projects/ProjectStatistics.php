<?php namespace Library\Resources\Projects;

use Library\Resources\Managers\ManagerTransformer;

class ProjectStatistics {

    private $project;

    private $repositories = [];

    private $repositoriesCount = [];

    protected $managerTransformer;

    public function __construct($project)
    {
        $this->setProject($project);
        $this->managerTransformer = new ManagerTransformer();
    }

    public function setProject($project)
    {
        $this->project = $project;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setRepositories($repositories)
    {
        $this->repositories = $repositories;
    }

    public function getRepositoriesCount()
    {
        $found = null;

        foreach($this->repositories as $repository)
        {
            foreach($this->repositoriesCount as $index => $repositoryCount)
            {
                if(array_key_exists('manager', $repositoryCount))
                {
                    if($this->repositoriesCount[$index]['manager'] == $this->managerTransformer->transform($repository->manager))
                    {
                        $this->repositoriesCount[$index]['count'] = $this->repositoriesCount[$index]['count'] + 1;
                        $found = true;
                    }
                }
                else
                {
                    $found = false;
                }
            }

            if(! $found)
            {
                array_push($this->repositoriesCount, ['manager' => $this->managerTransformer->transform($repository->manager), 'count' => 1]);
            }
        }

        return $this->repositoriesCount;
    }
} 