<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
	
	function delete_user($username){
		$this->db->query("DELETE FROM user WHERE username='$username'");
	}
    
    function get_states(){
        return $this->db->get('state')->result();
    }
	
	function get_email($username){
        return $this->db->query("SELECT userEmail FROM user WHERE username='$username' LIMIT 1")->row();
    }
	
	function get_idteam_by_coach($username){
		return $this->db->query("SELECT participant.idteam FROM team INNER JOIN participant ON participant.idteam=team.idteam WHERE usernameCoach='$username'")->row();
	}
	
	function get_userType($username){
		return $this->db->query("SELECT iduserType FROM user WHERE username = '$username'")->row();
	}
	
	function new_user($userType,$username,$pass){
		return $this->db->query("INSERT INTO user (username,iduserType,userPassword) VALUES ('$username',$userType,md5('$pass'))");
	}
	
	function validate_user($username,$password){
		return $this->db->query("SELECT COUNT(*) AS find,iduserType FROM user WHERE username='$username' AND userPassword=MD5('$password')")->row();
	}
}