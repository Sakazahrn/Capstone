<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Userauth  { 
	  
    private $login_page = "";   
    private $logout_page = "";   
     
    private $email;
    private $password;
	private $accesslevel;

    /**
    * Turn off notices so we can have session_start run twice
    */
    function __construct() 
    {
      error_reporting(E_ALL & ~E_NOTICE);
      $this->login_page = base_url() . "index.php/Login";
      $this->logout_page = base_url() . "index.php/Home";
    }

    /**
    * @return string
    * @desc Login handling
    */
    public function login($email,$password) 
    {

      session_start();
        
      // User is already logged in if SESSION variables are good. 
      if ($this->validSessionExists() == true)
      {
        $this->redirect($_SESSION['basepage');
      }

      // First time users don't get an error message.... 
      if ($_SERVER['REQUEST_METHOD'] == 'GET') return;
        
      // Check login form for well formedness.....if bad, send error message
      if ($this->formHasValidCharacters($email, $password) == false)
      {
         return "email/password fields cannot be blank!";
      }     
	  
      // verify if form's data coresponds to database's data
      if ($this->userIsInDatabase($email, $password) == false)
      {
        return 'Invalid email/password!';
      }
      else
      { 
        // We're in!
        // Redirect authenticated users to the correct landing page
        // ex: admin goes to admin, members go to members
		$this->writeSession();
        $this->redirect($_SESSION['basepage']);
      }
    }
	
	
    /**
    * @return void
    * @desc Validate if user is logged in
    */
    public function loggedin() 
    {

      session_start();     
   
      // Users who are not logged in are redirected out
      if ($this->validSessionExists() == false)
      {
        $this->redirect($this->login_page);
      }
		 
      // Access Control List checking goes here..
      // Does user have sufficient permissions to access page?
      // Ex. Can a bronze level access the Admin page?   

  
      return true;
    }
	
    /**
    * @return void
    * @desc The user will be logged out.
    */
    public function logout() 
    {
      session_start(); 
      $_SESSION = array();
      session_destroy();
      header("Location: ".$this->logout_page);
    }
    
    /**
    * @return bool
    * @desc Verify if user has got a session and if the user's IP corresonds to the IP in the session.
    */
    public function validSessionExists() 
    {
      session_start();
      if (!isset($_SESSION['email']))
      {
        return false;
      }
      else
      {
        return true;
      }
    }
    
    /**
    * @return void
    * @desc Verify if login form fields were filled out correctly
    */
    public function formHasValidCharacters($email, $password) 
    {
      // check form values for strange characters and length (3-12 characters).
      // if both values have values at this point, then basic requirements met
      if ( (empty($email) == false) && (empty($password) == false) )
      {
        $this->email = $email;
        $this->password = $password;
        return true;
      }
      else
      {
        return false;
      }
    }
	
    /**
    * @return bool
    * @desc Verify email and password with MySQL database.
    */
    public function userIsInDatabase($email, $password) 
    {

      // Remember: you can get CodeIgniter instance from within a library with:
      // $CI =& get_instance();
      // And then you can access database query method with:
      // $CI->db->query()
        
      // Access database to verify email and password from database table
	  $CI =& get_instance();
	  $sql = "select * from userslab6 where email = '" . $email . "' and password = '" . $password . "'";
      $query = $CI->db->query($sql);
	  $this->TPL['test'] = $query->result_array();
	  
	  if ($query > 0 and $this->TPL['test'][0]['frozen'] == 'N')
	  {
		  $row = $query->row(); 
		  $this->accesslevel = $row->accesslevel;
		  return true;
	  }
	  else 
	  {
		  return false;
	  }
    }
    
    
    /**
    * @return void
    * @param string $page
    * @desc Redirect the browser to the value in $page.
    */
    public function redirect($page) 
    {
        header("Location: ".$page);
        exit();
    }
    
    /**
    * @return void
    * @desc Write email and other data into the session.
    */
    public function writeSession() 
    {
        $_SESSION['email'] = $this->email;
		$_SESSION['password'] = $this->password;
        $_SESSION['accesslevel'] = $this->accesslevel;
		
		if ($this->accesslevel == 'admin')
			$_SESSION['basepage'] = base_url() . "index.php/Calendar";  
		else if ($this->accesslevel == 'student')
			$_SESSION['basepage'] = base_url() . "index.php/Calendar";  
    }
	
    /**
    * @return string
    * @desc email getter, not necessary 
    */
    public function getemail() 
    {
        return $_SESSION['email'];
    }
		 
}
