<?php
class DataBase{
    private $host ="localhost";
    private $username ="root";
    private $password ="";
    private $db_name ="lamp";
    public $connection;

    public function connectDB()//подключение к бд возращаем обьект PDO с подключением 
    {
        $this->conn = null;

 

        try {

            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

        } catch(PDOException $exception) {

            echo "Connection error: " . $exception->getMessage();

        }

 

        return $this->connection;
    }
     
}
?>