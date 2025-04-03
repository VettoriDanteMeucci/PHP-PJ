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

        function addText($title, $text, $pageID){
            $query = "INSERT INTO text (title, body, page) VALUES (:title, :body, :page)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":body", $text);
            $stmt->bindParam(":page", $pageID);
            $stmt->execute();
        }

        function addImg($tmp_name, $type, $pageID){
            var_dump($tmp_name);
            $body = file_get_contents($tmp_name);
            $query = "INSERT INTO image (exte, body, page) 
            VALUES (:type , :body, :page)";
            $st = $this->conn->prepare($query);
            $st->bindParam(":type", $type);
            $st->bindParam(":body",$body);
            $st->bindParam(":page",$pageID);
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

        /**
         * Summary of createNewPage
         * @return $id which is the id of the new page
         */
        function createNewPage($name , $creator){
            $query = "INSERT INTO page (name, creator) VALUES (:name, :creator)";
            $st = $this->conn->prepare($query);
            $st->bindParam("name", $name);
            $st->bindParam("creator", $creator);
            $st->execute();
            $id = $this->conn->lastInsertId();
            return $id; 
        }

        /**
         * Summary of getPage
         * @param $id which is the id of the page
         * @return $array of page info
         */
        function getPage($id){
            $ans = [];
            $ans["page"] = $this->fetchPageData($id);
            $ans["images"] = $this->getPageImagesSrc($id);
            $ans["texts"] = $this->getTextsPage($id);
            return $ans;
        }

        function fetchPageData($id){
            $query = "SELECT * FROM page WHERE id = $id";
            $ans = $this->conn->query($query);
            return $ans->fetchAll(PDO::FETCH_ASSOC)[0];
        }

        private function getTextsPage( $id ){
            $res = $this->conn->query("SELECT title, body FROM text WHERE page = $id");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }

        private function getPageImagesSrc($id){
            $res = $this->conn->query("SELECT id FROM image WHERE page = $id");
            $ans = [];
            if( $res->rowCount() > 0){
                while( $row = $res->fetch(PDO::FETCH_ASSOC) ){
                    $ans[] = "http://localhost/PHP-PJ/api/showImg.php?id=" . $row['id'];
                }
            }else{
                return false;
            }
            return $ans;
        }

        function fetchPageByTitle($title){
            if( $title == ''){
                return [];
            }else{
                $query = "SELECT id, name FROM page 
                WHERE name LIKE '%$title%'";
                $res = $this->conn->query($query);
                $res = $res->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }
        }

        function login($username, $password){
            $query = "SELECT * FROM user WHERE username = '$username' AND pass = '$password'";
            var_dump($query);
            $res = $this->conn->query($query);
            $res = $res->fetchAll(PDO::FETCH_ASSOC);
            if(count($res) == 0){
                return false; 
            }else{
                return $res[0];
            }
        }
        
        function signup($username,$password){
            $password = hash("sha256", $password);
            $query = "INSERT INTO user (username, pass) VALUES (:username, :pass)";
            $st = $this->conn->prepare( $query );
            $st->bindParam(":username", $username);
            $st->bindParam(":pass", $password);
            $res = $st->execute();
            if($res == true){
                return $this->login($username, $password);
            }
            return $res;
        }

        function fetchUserByName($name){
            $query = "SELECT id, username FROM user WHERE username LIKE '%$name%'";
            $res = $this->conn->query($query);
            $res = $res->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

    }

?>