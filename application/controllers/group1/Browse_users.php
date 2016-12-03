<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse_users extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('group1_models/user_model'); // I can now access the User_model class ($this->User_model)
    
    }


    public function index()
    {
		$this->clearance = $this->user_model->getPermission($this->session->userID); // removed this from constructor and put it here - error onClick of forgot_password
        $permArray = str_split($this->clearance);

        // add if statement 
        // if admin continue
        if ($this->session->logged_in && $permArray[0] == 1) { // if logged in show browse users


            $data['user_array'] = (array)$this->user_model->filterUsers($this->input->post());

            $this->load->view('group1/templates/header');
            $this->load->view('group1/templates/navbar/navbar');
            $this->load->view('group1/browse/user_table', $data);
            $this->load->view('group1/templates/navbar/navbottom');
            $this->load->view('group1/templates/footer');

        } else { // else redirect to Login_controller

            header('Location: login');

        }

    }


    public function userProfile($userID = NULL)
    {
        // 'Details' button on user_dash

        if ($this->session->logged_in) { // if logged in show user profile

            $user_id = $userID != NULL ? $userID : $this->input->post('user_id');

            $data['user_array'] = (array)$this->user_model->getAllUserInfo($user_id);// get all user info based on posted user_id
            $data['current_user_clearance'] = str_split($this->user_model->getPermission($this->session->userID));


            $this->load->view('group1/templates/header');
            $this->load->view('group1/templates/navbar/navbar');
            $this->load->view('group1/browse/user_profile', $data); // load user_profile page
            $this->load->view('group1/templates/navbar/navbottom');
            $this->load->view('group1/templates/footer');

        } else { // else redirect to Login_controller

            header('Location: login');

        }
    }


    // displays the Edit User page for admin users
    public function editAccount()
    {
        // new page with pre-populated user registration form
        $this->load->helper('form');

        $userID = $this->input->post('user_id');

        if ($this->session->logged_in) { // if logged in show user profile

            $data = (array)$this->user_model->getAllUserInfo($userID);// get all user info based on posted user_id
            $data['registration_edit'] = TRUE;


            $this->load->view('group1/templates/header');
            $this->load->view('group1/templates/navbar/navbar');
            $this->load->view('group1/registration/registration_main', $data); // load registration page
            $this->load->view('group1/templates/navbar/navbottom');
            $this->load->view('group1/templates/footer');

        } else { // else redirect to Login_controller

            header('Location: login');

        }

    }

    // update user after admin edit
    public function updateUser()
    {

        $this->user_model->updateUserInfo($this->input->post());
        $this->userProfile($this->input->post('user_id'));
    }

    // displays the change password page for non-admin users
    public function changePassword(){
        
        if($this->session->logged_in || $this->input->post('forgot') == 1){ // if logged in show user profile
            $data['user_id'] = $this->input->post('user_id');
            
            if($this->input->post('doit') == 1){
                echo "POP GOES THE WEAZEL";
                $this->user_model->updatePassword($this->input->post('user_id'), $this->input->post('passwd'));
                
                header('Location: '.base_url());

            } else {    
                

                $this->load->view('group1/templates/header');
                $this->load->view('group1/templates/navbar/navbar');
                $this->load->view('group1/details/change_password', $data);// change password page
                $this->load->view('group1/templates/navbar/navbottom'); 
                $this->load->view('group1/templates/footer');
                
            }
		} else { // else redirect to Login_controller

			header('Location: login');
	
		}
    }

    public function confirmUserPassword($error = FALSE)
    {
        $data['user_id'] = $this->input->post('user_id');

        if ($this->session->logged_in) { // if logged in show user profile

            if ($this->input->post('doit') == 1) {


                //if password entered == admin password
                if (md5($this->input->post('password')) == $this->user_model->getPassword($this->session->userID)) {
                    // delete user

                    $this->user_model->deleteUser($this->input->post('user_id'));

                    header('Location: ' . base_url());

                } else { // else redirect back to same page with red alert
                    $_POST['doit'] = 0;
                    $this->confirmUserPassword(TRUE);
                }


            } else {
                $data['error'] = $error;
                $this->load->view('group1/templates/header');
                $this->load->view('group1/templates/navbar/navbar');
                $this->load->view('group1/details/get_password', $data);// get admin password
                $this->load->view('group1/templates/navbar/navbottom'); 
                $this->load->view('group1/templates/footer');
            }

        } else { // else redirect to Login_controller

            header('Location: login');

        }


    }


    public function logOut(){
         $this->session->sess_destroy();
         redirect('login');
    }


    public function forgotPassword(){
        
        $this->load->view('group1/templates/header');
        $this->load->view('group1/forgotten'); // enter user id - if no user id, talk to admin
        $this->load->view('group1/templates/footer');
    }


    
    public function sendEmail(){
        //got an error 
        // You need to be running a mail server locally.

        /**************************************************
        *   HOW DO I DO THIS ON OUR HHEDUCATORS SERVER
        *
        *   HOW DO I DO THIS LOCALLY FOR TESTING
        ***************************************************/
	
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.googlemail.com',
            'mailpath' => "/usr/sbin/sendmail",
            'smtp_port' => 465,
            'smtp_user' => 'thenewhotness99@gmail.com',
            'smtp_pass' => 'p@55w0rd',
            'mailtype'  => 'text', 
            'charset'   => 'iso-8859-1',
            'smtp_crypto' => 'ssl' // doesn't work with tls
        );
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");  
        // different stuff
        $user_id = $this->input->post('user_id');

        $info = (array)$this->user_model->getUserInfo($user_id);

        // echo $info['email']; // user email associated with user_id
        //***** for production use


        $rand = $this->generateRandomString();

        $this->email->from('thenewhotness99@gmail.com', 'app', 'thenewhotness99@gmail.com');
        $this->email->to($info['email']);
        $this->email->subject('Change Password');
        $this->email->message('Change your hheducators password here: '.base_url().'reset_password/'.$rand/* generate random string */);

// store random string in database associated with user_id in question
        $this->user_model->save_random_string($rand, $user_id);

        if($this->email->send(false)){
            
            redirect(base_url());
        } else echo $this->email->print_debugger();

        // send 'change password' link to email registered to specified user_id

    }

    public function reset_password($rand){
        // print_r($rand);

        // query database for rand string and find associated user_id store in data and pass to page
        $data['user_id'] = $this->user_model->get_rand_id($rand);
        $data['forgot'] = 1;

        $this->load->view('group1/templates/header');
        $this->load->view('group1/details/change_password', $data);// change password page
        $this->load->view('group1/templates/footer');
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}


