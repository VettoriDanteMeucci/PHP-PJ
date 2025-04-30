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
            if($ans["page"] == false) return false;
            $ans["images"] = $this->getPageImagesSrc($id);
            $ans["texts"] = $this->getTextsPage($id);
            return $ans;
        }

        function fetchPageData($id){
            $query = "SELECT * FROM page WHERE id = $id";
            $ans = $this->conn->query($query);
            $ans = $ans->fetchAll(PDO::FETCH_ASSOC);
            if(count($ans) > 0){
                return $ans[0];
            }
            return false; 
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

        /**
         * Add a view to a page AND it's creator
         * @param mixed $id the ID of the page
         * @param mixed $creatorID if setted avoid searching for it
         * @return void
         */
        function addViewsToPage($id, $creatorID = null){
            $pageUpd = "UPDATE page SET views = views + 1 WHERE id = :pageID";
            $st = $this->conn->prepare($pageUpd);
            $st->bindParam(":pageID", $id);
            if($creatorID == null){
                $creatorID = $this->fetchCreatorIDByPage($id);
            }
            $creator = "UPDATE user SET views = views + 1 WHERE id = :userID";
            $st2 = $this->conn->prepare($creator);
            $st2->bindParam(":userID", $creatorID);
            $st->execute();
            $st2->execute();
        }

        function addViewsToUser($userID){
            $query = "UPDATE user SET views = views + 1 WHERE id = :userID";
            $st = $this->conn->prepare($query);
            $st->bindParam(":userID", $userID);
            $st->execute();
        }
        function fetchPageByTitle($title = "_", $wantImages = false){
            if( $title == ''){
                return [];
            }else{
                $query = "SELECT id, name FROM page 
                WHERE name LIKE '%$title%' ORDER BY views DESC";
                $res = $this->conn->query($query);
                $res = $res->fetchAll(PDO::FETCH_ASSOC);
                if($wantImages){
                    $ans = [];
                    foreach($res as $page){
                        $imgs = $this->getPageImagesSrc($page["id"]);
                        $page["imgs"] = $imgs;
                        $ans[] = $page;
                    }
                    $res = $ans;
                }
                return $res;
            }
        }

        function login($username, $password){
            $query = "SELECT * FROM user WHERE username = '$username' AND pass = '$password'";
            $res = $this->conn->query($query);
            $res = $res->fetchAll(PDO::FETCH_ASSOC);
            if(count($res) == 0){
                return false; 
            }else{
                return $res[0];
            }
        }
        
        function needAdmin(){
            $query = "SELECT count(*) as total FROM admin";
            $res = $this->conn->query($query);
            $res = $res->fetchAll(PDO::FETCH_ASSOC);
            if($res[0]["total"] == 0){
                return true;
            }
            return false;
        }
        function signup($username,$password){
            $password = hash("sha256", $password);
            $query = "INSERT INTO user (username, pass) VALUES (:username, :pass)";
            $st = $this->conn->prepare( $query );
            $st->bindParam(":username", $username);
            $st->bindParam(":pass", $password);
            $res = $st->execute();
            if($res == true){
                $ans = $this->login($username, $password);
                if($this->needAdmin()){
                    $this->addAdmin($ans["id"]);
                }
                return $ans;
            }
            return $res;
        }

        function isAdmin($id){
            $query = "SELECT * FROM admin WHERE id = $id";
            $rows = $this->conn->query($query)->rowCount();
            if($rows == 1){
                return true;
            }
            return false;
        }
        function addAdmin($id){
            $query = "INSERT INTO admin (id) values (:id)";
            $st = $this->conn->prepare( $query );
            $st->bindParam(":id", $id);
            $st->execute();
        }

        function removeAdmin($id){
            $query = "DELETE FROM admin WHERE id = :userID";
            $st = $this->conn->prepare($query);
            $st->bindParam(":userID", $id);
            $st->execute();
        }

        /**
         * Return the user of which username contains the given string
         * when nothing is given return all the users
         * @param mixed $name
         * @return array
         */
        function fetchUserByName($name = "_"){
            $query = "SELECT id, username FROM user WHERE username LIKE '%$name%' ORDER BY views DESC ";
            $res = $this->conn->query($query);
            $res = $res->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        function fetchUsernameByID($id){
            $query = "SELECT username FROM user WHERE id = $id";
            $res = $this->conn->query($query);
            return $res->fetchAll(PDO::FETCH_ASSOC)[0]["username"];
        }

        /**
         * It returns all the ids of every page created by the user with the given id.
         * @param mixed $id
         * @return array of all the pages created by the user
         */
        function fetchCreatorPages($id){
            $query = "SELECT page.id, name FROM page JOIN user ON user.id = creator WHERE creator = '$id'";
            $res = $this->conn->query($query);
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }


        /**
         * The id of a page
         * @param mixed $pageID false when not found else the id of the page creator
         */
        function fetchCreatorIDByPage($pageID){
            $query = "SELECT creator FROM page WHERE id = $pageID";
            $res = $this->conn->query($query);
            if($res->rowCount() == 0){
                return false;
            }else{
                return $res->fetchAll(PDO::FETCH_ASSOC)[0]["creator"];
            }
        }

        function updateUsername($username, $pass, $userID) {
            $pass = hash("sha256", $pass);
        
            $query = "UPDATE user SET username = :username WHERE id = :userID AND pass = :pass";
            $st = $this->conn->prepare($query);
        
            $st->bindParam(':username', $username);
            $st->bindParam(':userID', $userID);
            $st->bindParam(':pass', $pass);
        
            $success = $st->execute();
        
            // Controlla se almeno una riga è stata modificata
            return $success && $st->rowCount() > 0;
        }
        

        function updatePass($newPass, $oldPass, $userID) {
            $oldPass = hash("sha256", $oldPass);
            $newPass = hash("sha256", $newPass);
        
            $query = "UPDATE user SET pass = :newPass WHERE id = :userID AND pass = :oldPass";
            $st = $this->conn->prepare($query);
        
            $st->bindParam(':newPass', $newPass);
            $st->bindParam(':userID', $userID);
            $st->bindParam(':oldPass', $oldPass);
        
            $success = $st->execute();
        
            return $success && $st->rowCount() > 0;
        }
        
        function deletePage($id){
            $query = "DELETE FROM page WHERE id = $id";
            $this->conn->exec($query);
        }
    }

?>