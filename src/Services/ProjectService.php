<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Project;
use App\Repositories\ProjectRepository;

class ProjectService {

    public function __construct(
        private ProjectRepository $projectRepository
    ){}

    
    /**
     * Get all the projects
     * 
     * @return array
     */
    public function getAll(): array {
        return $this->projectRepository->getAll();
    }

    /**
     * Get a project by its ID
     * 
     * @param int $id
     * @return Project
     */
    public function getById(int $id): Project {
        return $this->projectRepository->getById($id);
    }
}