<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('crud_model');
        $this->load->model('master_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Admin Panel : Dashboard';

        $data['ruangan'] = $this->master_model->getDataRuanganLimit();
        $data['barang'] = $this->master_model->getDataBarangLimit();


        
        $this->loadViews("adminpanel/dashboard", $this->global, $data, NULL);
    }


    function getChart(){
        $list_data  = $this->master_model->getPengunjungWeb();
        
        echo json_encode($list_data);
    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            
            $data['userRecords'] = $this->user_model->userListing();
            $data['roles'] = $this->user_model->getUserRoles();
            $data['divisi'] = $this->crud_model->lihatdata('tbl_divisi');
            
            $this->global['pageTitle'] = 'Mirota KSM : User';
            
            $this->loadViews("adminpanel/user/List_user", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'Mirota KSM : Add New User';

            $this->loadViews("adminpanel/user/addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether username already exist or not
     */
    function checkusernameExists()
    {
        $userId = $this->input->post("userId");
        $username = $this->input->post("username");

        if(empty($userId)){
            $result = $this->user_model->checkusernameExists($username);
        } else {
            $result = $this->user_model->checkusernameExists($username, $userId);
        }

        if(empty($result)){ 
            echo("true"); 
        } else { 
            echo("false"); 
            }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('username','username','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('divisi_id','Divisi','trim|required|numeric');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('email','Email','required');
            if($this->form_validation->run() == FALSE)
            {
                redirect('userListing');
                $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $divisi_id = $this->input->post('divisi_id');
                $roleId = $this->input->post('role');
                $email = $this->input->post('email');
                
                $data = array(
                    'username'=>$username, 
                    'password'=>getHashedPassword($password), 
                    'divisi_id'=>$divisi_id, 
                    'roleId'=>$roleId, 
                    'name'=> $name,
                    'createdBy'=>$this->vendorId, 
                    'email'=> $email, 
                    'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($data);
                
                if($result > 0){
                $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
                }else{
                $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
                }
                
                redirect('userListing');
            }
        }
    }

    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['divisi'] = $this->user_model->getDivisi();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'Mirota KSM : Edit User';
            
            $this->loadViews("adminpanel/user/editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('username','username','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','max_length[20]');
            $this->form_validation->set_rules('divisi_id','Divisi','trim|required|numeric');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');     
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $divisi_id = $this->input->post('divisi_id');
                $email = $this->input->post('email');
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array(
                        'username'=>$username,
                        'roleId'=>$roleId,
                        'divisi_id'=>$divisi_id, 
                        'name'=>$name, 
                        'updatedBy'=>$this->vendorId, 
                        'email'=>$email, 
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array(
                        'username'=>$username, 
                        'password'=>getHashedPassword($password), 
                        'roleId'=>$roleId,
                        'divisi_id'=>$divisi_id, 
                        'name'=>ucwords($name), 
                        'email'=>$email,
                        'updatedBy'=>$this->vendorId, 
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
                }
                else
                {
                    $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
                }
                
                redirect('userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */

    public function delete($id)
    {
        $where = array('userId' => $id);
        $result = $this->crud_model->delete($where, 'tbl_users');
        
        if ($result == 0){
            $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
        }else{
            $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
        }

        redirect('userListing');
    }
    
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'Mirota KSM : Change Password';
        
        $this->loadViews("adminpanel/user/changePassword", $this->global, NULL, NULL);
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('loadChangePass');
            }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Mirota KSM : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    function logout() {
		$this->session->sess_destroy ();
		
		redirect ( 'login' );
	}
}

?>