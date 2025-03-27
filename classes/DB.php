<?php 
    class DB {
        private $conn;
        function __construct() {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $dbname = "wiki";
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        }

        function addImg($tmp_name, $type){
            var_dump($tmp_name);
            $body = file_get_contents($tmp_name);
            $query = "INSERT INTO image (exte, body) 
            VALUES (:type , :body)";
            $st = $this->conn->prepare($query);
            $st->bindParam(":type", $type);
            $st->bindParam(":body",$body);
            $res = $st->execute();
            return $res;
        }

        function fetchImg($id){
            $query = "SELECT * FROM image WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>