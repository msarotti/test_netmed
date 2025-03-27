<?php 
declare(strict_types=1);

namespace App\Repositories;

use App\Common\Database;
use App\Entities\Project;

class ProjectRepository
{
    public function __construct(
        private Database $database
    ){}

    /**
     * Creates a random string of 10 characters to be use as call string identifier.
     * 
     * @return string
     */
    private function generateRandomString(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 10;
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * Get a project by its ID
     * 
     * @param int $id
     * @throws \Exception
     * @return Project
     */
    public function getById(int $id): Project
    {
        $connection = $this->database->connect();
        $stmt = $connection->prepare("SELECT * FROM projects WHERE project_id = :id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $queryResult = $stmt->execute();
        $row = $queryResult->fetchArray(SQLITE3_ASSOC);
        if ($row === false) {
            $connection->close();
            throw new \Exception("Project not found");
        }
        $project = new Project();
        $project->setProjectId($row['project_id']);
        $project->setProjectName($row['project_name']);
        $project->setPerformance($row['performance']);
        $project->setImgPath($row['image_path']);
        $project->setIdDoctor($row['id_doctor']);
        $project->setCallString($this->generateRandomString());
        $connection->close();
        return $project;
    }

    /**
     * Get all projects
     * 
     * @return Project[]
     */
    public function getAll(): array
    {
        $projects = [];
        $connection = $this->database->connect();
        $stmt = $connection->prepare("SELECT * FROM projects");
        $result = $stmt->execute();
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $project = new Project();
            $project->setProjectId($row['project_id']);
            $project->setProjectName($row['project_name']);
            $project->setPerformance($row['performance']);
            $project->setImgPath($row['image_path']);
            $project->setIdDoctor($row['id_doctor']);
            $project->setCallString($this->generateRandomString());
            $projects[] = $project;
        }
        $connection->close();
        return $projects;
    }
}