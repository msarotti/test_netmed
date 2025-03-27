<?php
declare(strict_types=1);

namespace App\Entities;

class Project {
    private int $id;
    private int $projectId;
    private string $projectName;
    private int $performance;
    private string $imgPath;
    private int $idDoctor;
    private string $callString;


    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getProjectId(): int {
        return $this->projectId;
    }

    public function setProjectId(int $projectId): void {
        $this->projectId = $projectId;
    }

    public function getProjectName(): string {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): void {
        $this->projectName = $projectName;
    }

    public function getPerformance(): int {
        return $this->performance;
    }

    public function setPerformance(int $performance): void {
        $this->performance = $performance;
    }

    public function getImgPath(): string {
        return $this->imgPath;
    }

    public function setImgPath(string $imgPath): void {
        $this->imgPath = $imgPath;
    }

    public function getIdDoctor(): int {
        return $this->idDoctor;
    }

    public function setIdDoctor(int $idDoctor): void {
        $this->idDoctor = $idDoctor;
    }

    public function getCallString(): string {
        return $this->callString;
    }

    public function setCallString(string $callString): void {
        $this->callString = $callString;
    }

    /**
     * Convert the project to an array
     * 
     * @return array
     */
    public function toArray(): array {
        return [
            'project_id' => $this->getProjectId(),
            'project_name' => $this->getProjectName(),
            'performance' => $this->getPerformance(),
            'image_path' => $this->getImgPath(),
            'id_doctor' => $this->getIdDoctor(),
            'call_string' => $this->getCallString(),
        ];
    }
}