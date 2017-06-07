<?php
class DatabaseHandler{
    private $host;
    private $database;
    private $username;
    private $password;

    public function __construct($host, $database, $username, $password){
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;

            //Connection to the database
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
                // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return true;
                }
            catch(PDOException $e){
                //If the connection fails it will display a message with the reason
                echo $sql . "<br>" . $e->getMessage();
                }
    }
    public function CreateData($sql){
        try {
            $this->conn->exec($sql);
            return $this->conn->lastInsertId();
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    public function ReadData($sql){
        try{
            //Prepare statement
            $stmt = $this->conn->prepare($sql);

            //Execute the query
            $stmt->execute();

            //Set the resulting array to associative
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    public function UpdateData($sql){
        try {
            // Prepare statement
            $stmt = $this->conn->prepare($sql);

            // execute the query
            $stmt->execute();

            // echo a message to say the UPDATE succeeded
            echo $stmt->rowCount() . " records UPDATED successfully";
            }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    public function DeleteData($sql){
        try {
            // use exec() because no results are returned
            $this->conn->exec($sql);
            echo "Record deleted successfully";
            }
        catch(PDOException $e)
            {
            echo $sql . "<br>" . $e->getMessage();
            }
    }
}
?>
