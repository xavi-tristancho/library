<?php namespace Library\Resources\Projects;

use Library\Resources\Managers\ManagerTransformer;
use Illuminate\Support\Facades\DB;

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

    public function getRepositoriesCount()
    {
        $this->repositoriesCount = DB::table('repositories')
            ->select(DB::raw('manager_id as manager, count(*) as repositories_count'))
            ->groupBy('manager_id')
            ->get();

        return $this->repositoriesCount;
    }
} 