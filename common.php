<?php 
    /**
     * Loads all user credentials on file
     * @return array map of user => password
     */
    function load_users(){
        $file = file_get_contents("users.txt");
        $credentials = explode("\n", $file);
        $users = [];

        foreach($credentials as $creds){
            if($creds != ""){
                $creds = explode(":", $creds);
                $users[$creds[0]] = $creds[1];
            }
        }

        return $users;
    }

    /**
     * Authenticates a user from user credentials on file
     * @return boolean if authentication was successful
     */
    function validate_user($username, $password){
        $users = load_users();

        return array_key_exists($username, $users) && $users[$username] == $password;
    }
?>