<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    
    /**
     * This function used to check the login credentials of the user
     * @param string $username : This is username of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($username, $password)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.password, BaseTbl.name, BaseTbl.roleId, Roles.role, BaseTbl.divisi_id');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.username', $username);
        $query = $this->db->get();
        
        $user = $query->result();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function used to check username exists or not
     * @param {string} $username : This is users username id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkUsernameExist($username)
    {
        $this->db->select('userId');
        $this->db->where('username', $username);
        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('tbl_reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by username-id for forget password username
     * @param string $username : username id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByUsername($username)
    {
        $this->db->select('userId, username, name');
        $this->db->from('tbl_users');
        $this->db->where('username', $username);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $username : username id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($username, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('username', $username);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->update('tbl_users', array('password'=>getHashedPassword($password)));
        $this->db->delete('tbl_reset_password', array('username'=>$username));
    }

    function validateEmail($email)
	{
		$query = $this->db->query("SELECT * FROM tbl_users WHERE email='$email'");
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

    function updatePasswordhash($data,$email)
	{
		$this->db->where('email',$email);
		$this->db->update('tbl_users',$data);
	}
	
	function getHashDetails($hash)
	{
		$query =$this->db->query("select * from tbl_users WHERE hash_key='$hash'");
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			return false;
		}

	}

    function validateCurrentPassword($currentPassword,$hash)
	{
		$query = $this->db->query("SELECT * FROM tbl_users WHERE password='$currentPassword' AND hash_key='$hash'");
		if($query->num_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function updateNewPassword($data,$hash)
	{
		$this->db->where('hash_key',$hash);
		$this->db->update('tbl_users',$data);
	}
}

?>
