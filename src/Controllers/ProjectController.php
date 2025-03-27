<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\ProjectService;
use Twig\Environment;

class ProjectController
{

    public function __construct(
        private ProjectService $projectService,
        private Environment $twig
    ) {}

    /**
     * Handles the retrieval of all projects and returns them as a JSON response.
     *
     * @return void
     */
    public function getAll(): void {
        $projects = $this->projectService->getAll();
        $result = [];
        foreach ($projects as $project) {
            $result[] = $project->toArray();
        }
        header("content-type: application/json");
        echo json_encode($result);
    }

    /**
     * Handles the retrieval of project details by ID and renders the details page.
     * If the ID is not provided or an error occurs, appropriate error handling is performed.
     *
     * @return void
     */

    public function getDetails(): void {
        try {
            $id = $_GET['id'] ?? null;
            if ($id === null) {
                http_response_code(400);
                echo json_encode(['error' => 'ID is required']);
                return;
            }
            $projects = $this->projectService->getById((int) $id);
            $data = $projects->toArray();
            echo $this->twig->render('details.html.twig', ['project' => $data]);
        } catch (\Exception $e) {
            echo $this->twig->render('error.html.twig');
        }
    }

}