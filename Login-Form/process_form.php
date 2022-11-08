<?php

class process_form_data{

    //setup db connection details and recieve function call from AJAX
	function __construct(){

        $this->dbname = 'Dev';
        $this->dbuser = 'root';
        $this->dbpass = '';
        $this->dbhost = 'localhost';

		if(isset($_POST)){
			$this->controller($_POST['f']);
		}
	}

    //accepts a function case and runs the corresponding function
    private function controller($function){
		$aReturnValue = array();
		switch($function){
            case 'process_login' :
				$aReturnValue = $this->process_login($_POST['strUsername'], $_POST['strPassword']);
			break;
            case 'logout_user' :
                $aReturnValue = $this->logout_user();
            break;
        }
		print json_encode($aReturnValue);
	}

    private function process_login($strUsername, $strPassword){
        //setup return array
        $aReturn = array(
			'success' => 0,
            'message' => 'Login details are incorrect!'
		);

        //connect to DB
        $conn = new PDO ("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //execute SQL query and fetch results
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$strUsername]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //if user is found
        if($results){
            //save user password to variable, passwords are stored as hash
            $storedPassword = $results[0]['user_password'];

            //check if entered password mashes the hash
            if(password_verify($strPassword, $storedPassword)){
                $aReturn['success'] = 1;
                $aReturn['message'] = "Login Successful!";

                // Password matches, so start a new session
                session_start();

                // Store data in session variables
                $_SESSION["loggedIn"] = true;
                $_SESSION["username"] = $strUsername;
            } 
        }

        $conn = null; 

        return $aReturn;

    }

    private function logout_user(){
        session_start();
        
        // Unset all of the session variables
        $_SESSION = array();
        
        session_destroy();

        return true;
    }

}
$oObject = new process_form_data();
?>