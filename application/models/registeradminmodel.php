<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registeradminmodel extends CI_Model{

    public function __construct() {
        parent::__construct();
    }
	
	function count_teams_by_sport(){
		return $this->db->query("SELECT sportName,sportCategoryName,COUNT(*) AS total FROM team
									INNER JOIN sportcategory ON sportcategory.idsportCategory=team.idsportCategory
									INNER JOIN sport ON sport.idsport=sportcategory.idsport
									GROUP BY sportName,sportCategoryName
									ORDER BY sportName,sportCategoryName ASC")->result();
	}
	
    function get_teams(){
        return $this->db->query("SELECT team.idteam,sportcategory.idsportCategory,sportName,sport.idsport,sportCategoryName,campusName,cityName,state.idstate,stateName,sportParticipantsLimit,sportParticipantsMin FROM team
									INNER JOIN sportcategory ON team.idsportCategory=sportcategory.idsportCategory
									INNER JOIN sport ON sport.idsport=sportcategory.idsport
									INNER JOIN campus ON team.idcampus=campus.idcampus
									INNER JOIN city ON campus.idcity=city.idcity
									INNER JOIN state ON state.idstate=city.idstate
								ORDER BY stateName,sportName,sportCategoryName ASC")->result();
    }
	
	function get_teams_by_state($idstate){
        return $this->db->query("SELECT team.idteam,sportcategory.idsportCategory,sportName,sport.idsport,sportCategoryName,campusName,cityName,state.idstate,stateName,sportParticipantsLimit,sportParticipantsMin FROM team
					INNER JOIN sportcategory ON team.idsportCategory=sportcategory.idsportCategory
					INNER JOIN sport ON sport.idsport=sportcategory.idsport
					INNER JOIN campus ON team.idcampus=campus.idcampus
					INNER JOIN city ON campus.idcity=city.idcity
					INNER JOIN state ON state.idstate=city.idstate
					WHERE state.idstate='".$idstate."' 
					ORDER BY sportName,sportCategoryName ASC")->result();
    }
	
	function get_sportcategory_by_state($idstate){
        return $this->db->query("SELECT team.idteam,CONCAT(sport.sportName,' - ',sportcategoryName) AS sportcategory FROM team
					INNER JOIN sportcategory ON sportcategory.idsportcategory=team.idsportcategory
					INNER JOIN sport ON sport.idsport=sportcategory.idsport
					INNER JOIN campus ON team.idcampus=campus.idcampus
					INNER JOIN city ON campus.idcity=city.idcity
					INNER JOIN state ON state.idstate=city.idstate
					WHERE state.idstate='".$idstate."' 
					ORDER BY sportName ASC")->result();
    }
	
	function search_participant($lastName=NULL,$sureName=NULL,$firstName=NULL,$schoolEnrollment=NULL,$curp=NULL){
		
            $filter="";
		if(strlen($lastName))
			$filter =" lastName LIKE '%$lastName%' ";
		if(strlen($sureName)){
			if(strlen($filter))
				$filter.=' AND ';
			$filter.=" sureName LIKE '%$sureName%' ";
		}
		if(strlen($firstName)){
			if(strlen($filter))
				$filter.=' AND ';
			$filter.=" firstName LIKE '%$firstName%' ";
		}
		if(strlen($schoolEnrollment)){
			if(strlen($filter))
				$filter.=' AND ';
			$filter.=" schoolEnrollment LIKE '%$schoolEnrollment%' ";
		}
		if(strlen($curp)){
			if(strlen($filter))
				$filter.=' AND ';
			$filter.=" curp LIKE '%$curp%' ";
		}
		if(strlen($filter))
			$filter = ' WHERE '.$filter;
		/*echo "<p>SELECT lastName,sureName,firstName,schoolEnrollment,curp
									FROM participant as p
									INNER JOIN participantmeta AS pm ON pm.idparticipant=p.idparticipant
									INNER JOIN participantathlete AS pa ON pa.idparticipant=p.idparticipant
									$filter
									ORDER BY lastName ASC</p>";*/
		return $this->db->query("SELECT p.idparticipant,t.idteam,sp.idsport, lastName,sureName,firstName,jerseyNumber,semester,groupParticipant,schoolEnrollment,curp,sportName,sportCategoryName,stateName
									FROM participant as p
									INNER JOIN participantmeta AS pm ON pm.idparticipant=p.idparticipant
									INNER JOIN participantathlete AS pa ON pa.idparticipant=p.idparticipant
									INNER JOIN team AS t ON t.idteam=p.idteam
									INNER JOIN campus AS cm ON cm.idcampus=t.idcampus
									INNER JOIN city AS ct ON ct.idcity=cm.idcity
									INNER JOIN state AS st ON st.idstate=ct.idstate
									INNER JOIN sportcategory AS spc ON spc.idsportcategory=t.idsportcategory
									INNER JOIN sport AS sp ON sp.idsport=spc.idsport
									$filter
									ORDER BY lastName ASC")->result();
	}
}