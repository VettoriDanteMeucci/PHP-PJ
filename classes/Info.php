<?php 
    class Info{
        private static function getDefaultError(){
            $er = "<div class='alert alert-danger my-2 mx-4' role='alert'>
                        :textHere
                    </div>";
            return $er;
        }

        private static function getDefaultOk(){
            $ok = "<div class='alert alert-info my-2 mx-4' role='alert'>
                        :textHere
                    </div>";
            return $ok;
        }
        
        /**
         * Generate and add a msg to the session which is Going to be read by the nav
         * it returns the info that has already been added to the session
         * @param string $msg when not setted = something went wrong :(, else everything
         * @param bool $isError by default = true define the bg of the alert
         * @return string The string added to the session, just in case are needed modifications
         */
        static function addInfoMsg(string $msg = "something went wrong :(", bool $isError = true){
            $ans = "";
            if($isError){
                $ans = Info::getDefaultError();
                $ans = str_replace(":textHere",$msg, $ans);
            }else{
                $ans = Info::getDefaultOk();
                $ans = str_replace(":textHere", $msg, $ans);
            }
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $_SESSION["info"] = $ans;
            return $ans;
        }
    }
?>