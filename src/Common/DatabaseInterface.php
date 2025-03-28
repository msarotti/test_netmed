<?php
declare(strict_types=1);

namespace App\Common;

interface DatabaseInterface {

    public function connect();

    public function close(): void;
    
}