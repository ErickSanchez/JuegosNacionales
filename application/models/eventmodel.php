<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eventmodel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    function get_event_x_sport($sportName='',$limit=0){
        
        $sql='';
        if($sportName)
            $sql=" WHERE sportName='".$sportName."' ";
        $sql .= ' ORDER BY sportName,sportCategoryName,dateTimeEvent,teamOneName,teamOneAssignation ASC ';
        if($limit)
            $sql.=" LIMIT ".$limit;
        
     $data=$this->db->query("SELECT idevent,sportName,sportCategoryName,idteamOne,idteamTwo,scoreTeamOne,scoreTeamTwo,dateTimeEvent,headquarters.idheadquarters,field,nameHeadquarters,street,number,colony,
									(SELECT stateName FROM team
										LEFT JOIN campus ON campus.idcampus=team.idcampus
										LEFT JOIN city ON city.idcity=campus.idcity
										LEFT JOIN state ON state.idstate=city.idstate
										WHERE team.idteam=(SELECT team.idteam FROM team LEFT JOIN assignation ON assignation.idteam=team.idteam WHERE assignation.idassignation=idteamOne)
									)AS teamOneName,
									(SELECT assignationVarName FROM assignation
										WHERE idassignation=idteamOne
									)AS teamOneAssignation,
									(SELECT stateName FROM team
										LEFT JOIN campus ON campus.idcampus=team.idcampus
										LEFT JOIN city ON city.idcity=campus.idcity
										LEFT JOIN state ON state.idstate=city.idstate
										WHERE team.idteam=(SELECT team.idteam FROM team LEFT JOIN assignation ON assignation.idteam=team.idteam WHERE assignation.idassignation=idteamTwo)
									)AS teamTwoName,
									(SELECT assignationVarName FROM assignation
										WHERE idassignation=idteamTwo
									)AS teamTwoAssignation,
									(SELECT groupName FROM groups INNER JOIN assignation ON assignation.idgroup=groups.idgroup WHERE assignation.idassignation=idteamOne) AS groupName
								FROM event
								LEFT JOIN headquarters ON event.idheadquarters=headquarters.idheadquarters
								LEFT JOIN sportcategory ON event.idsportcategory=sportcategory.idsportCategory
								LEFT JOIN sport ON sportcategory.idsport=sport.idsport ".$sql);
     if($data)
        return $data->result();
        
    }
    function get_sport(){
        return  $this->db->query("SELECT * FROM sport")->result();
    }
    
    function get_sedes(){
        return  $this->db->query("SELECT * FROM headquarters ORDER BY nameHeadquarters ASC")->result();
    }
    
	function get_group($idsportcategory){
        return  $this->db->query("SELECT idassignation,assignationVarName FROM assignation JOIN groups ON assignation.idgroup=groups.idgroup  WHERE idsportCategory='".$idsportcategory."'")->result();
    }

    function get_groups($idsportcategory){
        return  $this->db->query("SELECT idgroup, groupName FROM groups WHERE idsportCategory='".$idsportcategory."'")->result();
    }
    
    function get_groups_not_assigned($idsportcategory){
        return  $this->db->query("SELECT groups.idgroup,nameGroup FROM groups  WHERE groups.idgroup NOT IN (SELECT idgroup FROM assignation JOIN team ON assignation.team.idteam=team.idteam WHERE team.idsportCategory='".$idsportcategory."')")->result();
    }
	
	function get_vars_not_assigned($idgroup){
        return  $this->db->query("SELECT * FROM assignation WHERE idgroup=$idgroup AND idassignation NOT IN (SELECT idassignation FROM team WHERE idassignation IS NOT NULL)")->result();
    }
    
    function get_campus($idsportcategory){
        return  $this->db->query("SELECT team.idteam,stateName AS name FROM team 
									INNER JOIN campus ON campus.idcampus=team.idcampus 
									INNER JOIN city ON city.idcity=campus.idcity
									INNER JOIN state ON state.idstate=city.idstate
									WHERE team.idsportCategory='".$idsportcategory."'")->result();
    }
    
    function get_events_no_record($idsportcategory){
        return  $this->db->query("SELECT idevent,CONCAT(
										'(',dateTimeEvent,') - ',
										(SELECT stateName FROM team
											LEFT JOIN campus ON campus.idcampus=team.idcampus
											LEFT JOIN city ON city.idcity=campus.idcity
											LEFT JOIN state ON state.idstate=city.idstate
											WHERE team.idteam=(SELECT team.idteam FROM team LEFT JOIN assignation ON assignation.idassignation=team.idassignation WHERE assignation.idassignation=idteamOne)
										),' Vs. ',
										(SELECT stateName FROM team
											LEFT JOIN campus ON campus.idcampus=team.idcampus
											LEFT JOIN city ON city.idcity=campus.idcity
											LEFT JOIN state ON state.idstate=city.idstate
											WHERE team.idteam=(SELECT team.idteam FROM team LEFT JOIN assignation ON assignation.idassignation=team.idassignation WHERE assignation.idassignation=idteamTwo)
										)) AS name FROM event  WHERE idsportCategory='".$idsportcategory."' AND scoreTeamOne IS NULL AND scoreTeamTwo IS NULL ORDER BY dateTimeEvent")->result();
    }
    
    function get_events($idsportcategory){
        return  $this->db->query("SELECT idevent,CONCAT(
										dateTimeEvent,' - ',
										(SELECT stateName FROM team
											LEFT JOIN campus ON campus.idcampus=team.idcampus
											LEFT JOIN city ON city.idcity=campus.idcity
											LEFT JOIN state ON state.idstate=city.idstate
											WHERE team.idteam=(SELECT team.idteam FROM team LEFT JOIN assignation ON assignation.idassignation=team.idassignation WHERE assignation.idassignation=idteamOne)
										),' Vs. ',
										(SELECT stateName FROM team
											LEFT JOIN campus ON campus.idcampus=team.idcampus
											LEFT JOIN city ON city.idcity=campus.idcity
											LEFT JOIN state ON state.idstate=city.idstate
											WHERE team.idteam=(SELECT team.idteam FROM team LEFT JOIN assignation ON assignation.idassignation=team.idassignation WHERE assignation.idassignation=idteamTwo)
										)) AS name FROM event  WHERE idsportCategory='".$idsportcategory."' ORDER BY dateTimeEvent")->result();
    }
	/*
    function get_events($idsportcategory){
        return  $this->db->query("SELECT idevent,CONCAT(
										(SELECT assignationVarName FROM assignation WHERE assignation.idassignation=idteamOne)
										,' Vs. ',
										(SELECT assignationVarName FROM assignation WHERE assignation.idassignation=idteamTwo)
										,' ( ',dateTimeEvent,' )') AS name FROM event  WHERE idsportCategory='".$idsportcategory."'")->result();
    }*/
    function get_events_re(){
        return  $this->db->query("SELECT idevent,CONCAT('( ',(SELECT assignationVarName FROM assignation WHERE idassignation=idteamOne),' Vs. ',(SELECT assignationVarName FROM assignation WHERE idassignation=idteamTwo),' ) ',nameHeadquarters,' ',dateTimeEvent) AS name FROM event JOIN headquarters ON event.idheadquarters=headquarters.idheadquarters  WHERE idsportCategory='".$idsportcategory."'")->result();
    }
    
    function get_event($idevent){
        return  $this->db->query("SELECT * FROM event WHERE idevent ='".$idevent."'")->result();
    }
	function get_team_one($idevent){
		return  $this->db->query("SELECT idteamOne,(SELECT stateName FROM team
											LEFT JOIN campus ON campus.idcampus=team.idcampus
											LEFT JOIN city ON city.idcity=campus.idcity
											LEFT JOIN state ON state.idstate=city.idstate
											WHERE team.idteam=(SELECT team.idteam FROM team LEFT JOIN assignation ON assignation.idassignation=team.idassignation WHERE assignation.idassignation=idteamOne)) as name
									FROM event WHERE idevent ='".$idevent."'")->result();
	}
	
	function get_team_two($idevent){
		return  $this->db->query("SELECT idteamTwo,(SELECT stateName FROM team
											LEFT JOIN campus ON campus.idcampus=team.idcampus
											LEFT JOIN city ON city.idcity=campus.idcity
											LEFT JOIN state ON state.idstate=city.idstate
											WHERE team.idteam=(SELECT team.idteam FROM team LEFT JOIN assignation ON assignation.idassignation=team.idassignation WHERE assignation.idassignation=idteamTwo)) as name 
									FROM event WHERE idevent ='".$idevent."'")->result();
	}
	function get_sportCategories(){
        return  $this->db->query("SELECT sportCategoryName,sportName FROM sportcategory INNER JOIN sport ON sport.idsport=sportcategory.idsport")->result();
    }
	function setScore($idevent,$scoreTeamOne,$scoreTeamTwo){
		$this->db->query("UPDATE event SET scoreTeamOne=$scoreTeamOne, scoreTeamTwo=$scoreTeamTwo WHERE idevent=$idevent");
	}
     function insert_data($table,$data){
        $this->db->insert($table,$data);
    }
     function update_event($table,$data,$id){
           $this->db->update($table,$data,$id);
    }
	function update_assignation_team($id,$assignation){
		$this->db->query("UPDATE assignation SET idteam='$id' WHERE idassignation='$assignation'");
	}
     
    function delete($idevent){
    
            $this->db->query("DELETE FROM event WHERE idevent = '".$idevent."'");
    }
}