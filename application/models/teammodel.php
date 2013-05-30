<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teammodel extends CI_Model{

	function get_coach($idteam){
		return $this->db->query("SELECT * FROM participant INNER JOIN participantmeta ON participantmeta.idparticipant=participant.idparticipant WHERE idteam='$idteam' AND usernameCoach IS NOT NULL")->row();
	}
	
	function get_participants($idteam){
		return $this->db->query("SELECT * FROM participant
									INNER JOIN participantmeta ON participantmeta.idparticipant=participant.idparticipant
									INNER JOIN participantathlete ON participantathlete.idparticipant=participant.idparticipant
									WHERE idteam='$idteam' AND usernameCoach IS NULL ORDER BY lastName ASC")->result();
	}
	
	function get_idparticipants($idteam){
		return $this->db->query("SELECT idparticipant FROM participant WHERE idteam='$idteam'")->result();
	}


	function get_sport_by_idteam($idteam){
		return $this->db->query("SELECT * FROM sport
						INNER JOIN sportcategory ON sportcategory.idsport = sport.idsport
						INNER JOIN team ON team.idsportCategory = sportcategory.idsportCategory
								WHERE team.idteam='$idteam'")->row();
	}

	function get_team_info($idteam = 0){

		$row = $this->db->query("SELECT * FROM team  INNER JOIN campus ON campus.idcampus = team.idcampus
									INNER JOIN city ON city.idcity = campus.idcity
									INNER JOIN state ON state.idstate = city.idstate
									INNER JOIN sportcategory ON team.idsportCategory = sportcategory.idsportCategory
									INNER JOIN sport ON sport.idsport = sportcategory.idsport WHERE idteam='$idteam'");
		if($row)
			return $row->row();
		return null;
	}

	function get_num_participants($idteam){
		return $this->db->query("SELECT COUNT(*) AS total FROM participant WHERE idteam='$idteam' AND usernameCoach IS  NULL")->row();
	}

	function get_sport_limits($idteam){
		return $this->db->query("SELECT sportParticipantsLimit,sportParticipantsMin FROM sport WHERE idsport=(SELECT idsport FROM team INNER JOIN sportcategory ON sportcategory.idsportCategory=team.idsportCategory WHERE idteam='$idteam')")->row();
	}

}