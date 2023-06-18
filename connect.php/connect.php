<?php
class Connect{
public $server;
public $user;
public $password;
public $dbName;

public function __construct()
{
    $this->server = "x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $this->user = "p7yawcktbsgchpjr";
    $this->password = "eny5q8kglju4l5lv";
    $this->dbName = "elmo6cg8zwb3pfqa";
}

//option1
function connectToMySQL():mysqli
{
    $conn_my = new mysqli($this->server, 
    $this->user, 
    $this->password, 
    $this->dbName);

    if($conn_my->connect_error)
    {
        die("Failed".$conn_my->connect_error);
    }
    else
    {
        
    }
    return $conn_my;
}

//option2
function connectToPDO():PDO
{
    try{
        $conn_pdo = new PDO("mysql:host=$this->server;dbname=$this->dbName", $this->user, $this->password);
        
    }
    catch(PDOException $e){
        die("Failed $e");
    }
    return $conn_pdo;   
    
}
}

$c = new Connect();
$c->connectToMySQL();
?>