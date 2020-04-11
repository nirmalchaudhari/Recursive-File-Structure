<?php


class MigrationSeeder {
    protected $db;
    protected $directory;
    protected $migrationList = [];
    protected $isMigration = true;
    public function __construct($db, $directory){
        $this->db = $db;
        $this->directory = $directory;
        $this->getAllMigration();
    }

    protected function getAllMigration() {
        $query = "SELECT name FROM migseed";
        $result = $this->db->query($query)->fetchAll();
        if ($result) {
            $temp = [];
            forEach($result as $value) {
                array_push($temp, $value['name']);
            }
            $this->migrationList = $temp;          
        }        
    }

    public function createMigrationSeeder ($list = [], $isMigration = true) {        
        $this->isMigration = $isMigration;
        foreach($list as $value) {
            $filePath = "{$this->directory}/{$value}";            
            if ($this->checkFileExists($filePath)) {
                $this->runMigrationSeeder($filePath);
            }             
        }
    }

    protected function checkFileExists($filePath) {
        if (file_exists($filePath)) 
            return true;
        return false; 
    }

    protected function readContent($filePath) {        
        $file = fopen($filePath, "r");        
        $fileContent = fread($file, filesize($filePath));
        return $fileContent;
    }

    protected function runMigrationSeeder($filePath) {            
        try {            
            if ($this->requireToRun($filePath)) {
                if ($this->isMigration) {
                    $this->runMigration($filePath);          
                } else {
                    $this->runSeeder($filePath);             
                }
            }
        } catch (Throwable $e) {
            $this->error("Captured Throwable: " . $e->getMessage() . PHP_EOL);
        }
    }

    protected function runMigration($migrationName) {        
        $content = $this->readContent($migrationName);
        $this->db->query($content);                
        $this->db->query("Insert into migseed (name) values(?)", $migrationName);
    }

    protected function runSeeder($seederName) {        
        $contents = json_decode($this->readContent($seederName), true);
        $tableName = substr($seederName, strripos($seederName, "/")+1);            
        $tableName = substr($tableName, 0, strpos($tableName, "-"));
       
        forEach($contents as $val) {                        
            $this->db->query("Insert into $tableName (name, type, parentId, path) values(?, ?, ?, ?)", $val['name'], $val['type'], $val['parentId'], $val['path']);
        }
        $this->db->query("Insert into migseed (name) values(?)", $seederName);
    }

    public function requireToRun ($migrationName) {        
        return in_array($migrationName, $this->migrationList) ? false : true;
    }

    public function error($error) {     
        exit($error);        
    }
}