<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signupmodel extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
		
    function get_coordinator(){
		return  $this->db->query("SELECT idcoordinator FROM coordinator ")->result();
	}
	
    function get_state_by_coordinator($coordinator){
		return  $this->db->query("SELECT * FROM state INNER JOIN city ON city.idstate=state.idstate WHERE idcoordinator=(SELECT idcoordinator FROM coordinator WHERE username='".$coordinator."')")->row();
	}
    
    function get_team($idcampus){
         $this->db->select('*');
         $this->db->from('team');
         $this->db->where('idcampus',$idcampus);
        return $this->db->get()->result();
    }
	
	function get_team_info($idteam){
		return $this->db->query("SELECT * FROM team INNER JOIN campus ON campus.idcampus=team.idcampus
						INNER JOIN city ON city.idcity=campus.idcity
						INNER JOIN state ON state.idstate=city.idstate JOIN sportcategory ON  team.idsportCategory=sportcategory.idsportCategory
						WHERE idteam='".$idteam."' ")->row();
	}
        
	function get_sport_info($idsport){
		return $this->db->query("SELECT * FROM sport WHERE idsport='".$idsport."'")->row();
	}
	
    function count($table){
         $this->db->select('COUNT(*) as nume');
         $this->db->from($table);
        return $this->db->get()->row();
        
    }
    
    function insert_data($table,$data){
        $this->db->insert($table,$data);
    }
}