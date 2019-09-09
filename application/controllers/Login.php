<?php
class Login extends CI_Controller{
  //Constructors are useful if you need to set some default values, 
  //or run a default process when your class is instantiated.
  // Constructors can’t return a value, but they can do some default work
  function __construct(){
    parent::__construct();
    //$this->load->helper('html');
    $this->load->model('login_model');
  }
 
  //defines the index method that responds to the URL 
  function index(){
    $this->load->helper('html');
    $this->load->view('login_view');
  }
  
 
  function auth(){
                //fetch POST items with XSS filter
                //prevent cross-site scripting attacks
    $email    = $this->input->post('email',TRUE);
    $password = md5($this->input->post('password',TRUE));
    $validate = $this->login_model->validate($email,$password);
    
     if($validate)
     {
        $user_id = $validate[0]->empId;
        $first_name = $validate[0]->first_name;
        $last_name = $validate[0]->last_name;
        $email = $validate[0]->email;
		    $departmentId = $validate[0]->departmentId;
        $name  = $validate[0]->user_name;
        $level = $validate[0]->user_level;
        $profileImage = $validate[0]->profileImage;
        
         $sesdata = array(  
		 	   'user_id'   => $user_id,
		 	   'firstname'   => $first_name,
		 	   'lastname'    => $last_name,
		 	   'email'        => $email,
		 	   'departmentId' => $departmentId,
		 	   'username'     => $name,
         'level'        => $level,
         'profileImage' => $profileImage,
         'logged_in'    => TRUE
             
         );
         //making that data globally available to you without having to run a database query when you need it
         //maintain a user’s “state” and track their activity while they browse your site
         $this->session->set_userdata($sesdata);//add session data
         
        // access login for admin
        if($level === '1'){
            redirect('page');
 
        // access login for emp
        }elseif($level === '2'){
            redirect('page/emp');
        }
     }
    
     else{
         echo $this->session->set_flashdata('msg','Username or Password is Wrong');//session data that will only be available for the next request, and is then automatically cleared.
         redirect('login');
     }


  }
 
  function logout(){
      //$this->session->unset_userdata('uid');
      $this->session->sess_destroy();//clear the current session
      redirect('login');
  }
 
}