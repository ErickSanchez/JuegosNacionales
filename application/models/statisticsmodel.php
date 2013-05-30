<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statisticsmodel extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

	function get_pts_contra($idteam){
		//return $this->db->query("SELECT SUM() AS total FROM event WHERE ")->row();
	}
}