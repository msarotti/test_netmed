<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Common\Database;

$container = new DI\Container();
try {


$db = $container->get(Database::class);

$connection = $db->connect();

// If the table exists, drop it and create a new one
$query = "DROP TABLE IF EXISTS projects";
$result = $connection->query($query);

$query = "CREATE TABLE IF NOT EXISTS projects (
    project_id INTEGER PRIMARY KEY AUTOINCREMENT,
    project_name VARCHAR(255) NOT NULL,
    performance INTEGER NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    id_doctor INTEGER NOT NULL
)";
$result = $connection->query($query);

$insertQuery = "INSERT INTO projects (project_name, performance, image_path, id_doctor) VALUES
('Diabete Mellito', 70, 'img/diabete.jpg', 1),
('Ipertensione arteriosa', 34, 'img/pressione.jpg', 2),
('Bpco', 26, 'img/bpco.jpg', 2),
('Asma', 80, 'img/asma.jpg', 1),
('Analisi Spesa farmaceutica', 12, 'img/spesa.jpg', 3),
('Vaccinazione Antinfluenzale', 36, 'img/vaccinazione.jpg', 3),
('Screening Mammografie', 55, 'img/screening.jpg', 1),
('Audit di ingresso', 81, 'img/audit.jpg', 4),
('Analisi Visite', 23, 'img/visite.jpg', 5);
";
$connection->query($insertQuery);
} catch (\Exception $e) {
    echo $e->getMessage();
} finally {
    $connection->close();
}
