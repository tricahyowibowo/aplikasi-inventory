<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */
class Login extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->global['pageTitle'] = 'SI ATTA : login';
            $this->global['pageHeader'] = 'SI ATTA : login';
            
            $this->loadViewsLogin("adminpanel/login/login", $this->global, NULL, NULL);
        }
        else
        {
            redirect('adminpanel/dashboard');
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'username', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $result = $this->login_model->loginMe($username, $password);
            
            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
                  $sessionArray = array(
                    'userId'=>$res->userId,                    
                    'role'=>$res->roleId,
                    'roleText'=>$res->role,
                    'name'=>$res->name,
                    'divisi_id'=>$res->divisi_id,
                    'isLoggedIn' => TRUE
                  );
                                    
                    $this->session->set_userdata($sessionArray);
                    
                    redirect('dashboard');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'username or password mismatch');
                
                redirect('login');
            }
        }
    }

    function forgotPassword()
    {
        $this->load->model('user_model');
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $this->form_validation->set_rules('email','email','required');
            if($this->form_validation->run()==TRUE)
            {
                $email  = $this->input->post('email');
                $validateEmail = $this->login_model->validateEmail($email);

                if($validateEmail!=false)
                {
                    $row = $validateEmail;
                    $user_id = $row->userId;
                    $user_name = $row->name;

                    $string = time().$user_id.$email;
                    var_dump($string);
                    $hash_string = hash('sha256',$string);
                    $currentDate = date('Y-m-d H:i');
                    $hash_expiry = date('Y-m-d H:i',strtotime($currentDate. ' + 1 days'));
                    $data = array(
                        'hash_key'=>$hash_string,
                        'hash_expiry'=>$hash_expiry,
                    );

                    $resetLink = base_url().'login/resetpassword/'.$hash_string;
                    $message = 
                    '<img class="img-logo" src="https://asset.mirota.id/assets/dist/img/mirota.png?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="" srcset=""></img>
                    <h3><b>Halo '.$user_name.',</b></h3>
                    <p>Kamu baru saja mengirimkan permintaan reset password akun.<br><br>
                    Untuk lanjut, klik link di bawah ini:</p><br>
                    <a href="'.$resetLink.'">reset password</a>';
                    $subject = "Reset Password Akun asset mirota ksm";
                    $sentStatus = $this->sendEmail($email,$subject,$message);
                    if($sentStatus==true)
                    {
                        $this->login_model->updatePasswordhash($data,$email);
                        $this->session->set_flashdata('success','Reset password berhasil dikirim ke emailmu');
                    }
                    else
                    {
                        $this->session->set_flashdata('error','Reset password Gagal Dikirim');
                    }

                }	
                else
                {
                    $this->session->set_flashdata('error','Email Tidak terdaftar');
                }

            }
        }

        $this->load->view('adminpanel/login/forgotPassword');		
        
    }


    /*user this email sending code */
    public function sendEmail($email,$subject,$message)
    {   
        /*This email configuration for sending email by Google Email(Gmail Acccount) from localhost */
        $config = Array(
           'mailtype' => 'html',
           'charset'   => 'utf-8',
           'protocol' => 'smtp',
           'smtp_host' => 'mirota.id',
           'smtp_user' => 'promosi@mirota.id',  //gmail id
             'smtp_pass' => 'mirotaksm',   //gmail password
           'smtp_crypto' => 'ssl',
           'smtp_port' => 465,
           'crlf'    => "\r\n",
           'newline' => "\r\n"
            );



          $this->load->library('email', $config);
          $this->email->from('no-replypromosi@mirota.id', 'PT. Mirota KSM');
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
          
          if($this->email->send())
         {
           return true;
         }
         else
         {
             return false;
         }
    }


    function resetpassword()
    {
        if($this->uri->segment(3))
        {
            $hash = $this->uri->segment(3);
            $this->data['hash']=$hash;
            $getHashDetails = $this->login_model->getHashDetails($hash);
            if($getHashDetails!=false)
            {
                $hash_expiry = $getHashDetails->hash_expiry;
                $currentDate = date('Y-m-d H:i');
                if($currentDate < $hash_expiry)
                {
                    if($_SERVER['REQUEST_METHOD']=='POST')
                    {
                        $this->form_validation->set_rules('password','New Password','required');
                        $this->form_validation->set_rules('cpassword','Confirm New Password','required|matches[password]');
                        if($this->form_validation->run()==TRUE)
                        {
                           $newPassword = $this->input->post('password');
                           $newPassword =getHashedPassword($newPassword);
                           $data = array(
                               'password'=>$newPassword,
                               'hash_key'=>null,
                               'hash_expiry'=>null
                           );
                           $this->login_model->updateNewPassword($data,$hash);
                           $this->session->set_flashdata('success','Password berhasil diubah');
                           redirect('login/forgotPassword');
                        }
                        else
                        {
                           $this->session->set_flashdata('error','Current Password is wrong');
                           $this->load->view('adminpanel/login/resetPassword',$this->data);	
                        }
                    }
                    else
                    {
                        $this->load->view('adminpanel/login/resetPassword',$this->data);
                    }
                }
                else
                {
                    $this->session->set_flashdata('error','link is expired');
                    redirect(base_url('login/forgotPassword'));
                }
            }
            else
            {
                echo 'invalid link';exit;
            }
        }
        else
        {
           $this->set_notifikasi_swal('success','Berhasil','Password Berhasil Diubah');
           redirect('admin');
        }
    }


}

?>