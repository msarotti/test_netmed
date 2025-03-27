<?php
declare(strict_types=1);

namespace App\Common;

use App\Exceptions\DatabaseException;
use SQLite3;

class Database implements DatabaseInterface {

    const SQLLITE_PATH = "database/db.sqlite";
    private string $path;

    private SQLite3 $connection;

    public function __construct() {
        if(!empty($_SERVER["DOCUMENT_ROOT"])) {
            $_SERVER["DOCUMENT_ROOT"] .= "/";
        }
        $this->path = $_SERVER["DOCUMENT_ROOT"] . self::SQLLITE_PATH;
    }

    /**
     * Connect to the SQLite3 database
     * 
     * @throws \App\Exceptions\DatabaseException
     * @return SQLite3
     */
    public function connect()
    {
        try {
            $this->connection = new SQLite3($this->path);
            return $this->connection;
        } catch (\Exception $e) {
            throw new DatabaseException("Cannot connect to database");
        }
    }

    /**
     * Close the SQLite3 database connection
     * @return void
     */
    public function close(): void
    {
        $this->connection->close();
    }
    
}