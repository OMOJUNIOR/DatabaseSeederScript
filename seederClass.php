<?php

/* --------------------------------
|  PDO databse seeder By Musa A S for PHP
|  hard coded input options data'
|  --------------------------------

|  By : Musa A S
|  sheriffmusa42.com
|  2022-03-12
|  00:47:00
|  --------------------------------
*/

class SeederClass
{
    protected $table;

    protected $dbHost;

    protected $dbName;

    protected $dbUser;

    protected $dbPass;

    protected $dbPort;

    protected $dbCharset;

    protected $db;

    public $error;

    public function __construct($dbHost, $dbName, $dbCharset, $dbUser, $dbPass, $dbPort = null)
    {
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbPort = $dbPort;
        $this->dbCharset = $dbCharset;
    }

    public function connect()
    {
        try {
            $this->db = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName;charset=$this->dbCharset", $this->dbUser, $this->dbPass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $this->db;
        } catch (PDOException $e) {
            $this->error = 'Unable to connect to the database server.'.$e->getMessage().'.'.$e->getCode();

            return $this->error;
            exit();
        }
    }

    public function createTable(string $table)
    {
        $this->table = $table;

        try {
            $this->db->exec("CREATE TABLE IF NOT EXISTS $this->table (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");
            echo "Table $this->table created successfully\n";
        } catch (PDOException $e) {
            $this->error = 'Error creating table: '.$e->getMessage().'.'.$e->getCode();
            echo $this->error;
            exit();
        }
    }

    public function createColumn($table, $column, $type)
    {
        $this->table = $table;
        $this->column = $column;
        $this->type = $type;
        try {
            $this->db->exec("ALTER TABLE `$this->dbName`.`$this->table` ADD COLUMN ` $column` $type");
            echo "Column $this->column created successfully\n";
        } catch (PDOException $e) {
            $this->error = 'Error creating column: '.$e->getMessage().'.'.$e->getCode();
            echo $this->error;
            exit();
        }
    }

    public function query($sql, $data = [])
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);

            return $stmt;
        } catch (PDOException $e) {
            $this->error = 'Error executing query: '.$e->getMessage().'.'.$e->getCode();
            echo $this->error;
            exit();
        }
    }

    public function exportData(array $data)
    {
        try {
            for ($i = 0; $i < count($data); $i++) {
                $this->insertData($data[$i]);
            }
        } catch(PDOException $e) {
            $this->error = 'Error exporting data: '.$e->getMessage().'.'.$e->getCode();
            echo $this->error;
            exit();
        }
    }

    public function insertData(array $data)
    {
        try {
            $query = 'INSERT INTO `'.$this->table.'` (';
            foreach ($data as $key => $value) {
                $query .= '`'.$key.'`,';
            }
            $query = rtrim($query, ',');
            $query .= ') VALUES (';
            foreach ($data as $key => $value) {
                $query .= ':'.$key.',';
            }
            $query = rtrim($query, ',');
            $query .= ')';

            $this->query($query, $data);
        } catch(PDOException $e) {
            $this->error = 'Error inserting data: '.$e->getMessage().'.'.$e->getCode();
            echo $this->error;
            exit();
        }
    }

    public function resetTable($table)
    {
        try {
            $this->table = $table;
            $this->db->exec("TRUNCATE TABLE $this->table");
        } catch (PDOException $e) {
            $this->error = 'Error resetting table: '.$e->getMessage().'.'.$e->getCode();
            echo $this->error;
            exit();
        }
    }

    public function closeConnection()
    {
        return  $this->db = null;
    }

    public function __destruct()
    {
        $this->closeConnection();
    }
}
