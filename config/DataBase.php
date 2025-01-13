
<?php

class DataBase{

    private $dsn = "mysql:host=localhost;dbname=ocdb";
    private $username = "root";
    private $password = "karim@mysql@25";
    private static $instance;
    private $connection;

    public function __construct(){
        
        try{
            $this->connection = new PDO($this->dsn,$this->username,$this->password);

            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            echo 'connected';
            
        }catch(PDOException $e){
            die("error executing query ".$e->getMessage());
        }

    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            return self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }
}


$db = DataBase::getInstance();
$db->getConnection();
