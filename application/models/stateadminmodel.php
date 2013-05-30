<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stateadminmodel extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

      function update_coordinator_info($data,$username){

          if(@$data['coordinator-email'])
            $data_user['userEmail']=$data['coordinator-email'];

          if(@$data['coordinator-phone'])
            $data_user['userPhone']=$data['coordinator-phone'];

          if(@$data_user)
                $this->db->update('user',$data_user,array('username'=>$username));

           if(@$data['coordinator-name'])
           {
                $data_coordinator['coordinatorName']=$data['coordinator-name'];
                $this->db->update('coordinator',$data_coordinator,array('username'=>$username));
           }

    }
	function add_team($campus,$sportCategory){
		$status = $this->db->query("INSERT INTO team (idsportCategory,idcampus) VALUES($sportCategory,'$campus')");
		if($status)
			return $this->db->query("SELECT idteam FROM team WHERE idsportCategory=$sportCategory AND idcampus='$campus'")->row();
		return 0;
	}

	function delete_team($idteam)
        {
         	$this->db->query("DELETE FROM team WHERE idteam=$idteam");
        }

	function exist_team($state=0,$campus,$sportCategory){
		if($state==0)
			return $this->db->query("SELECT idteam FROM team WHERE idcampus='$campus' AND idsportCategory=$sportCategory LIMIT 1")->row();
		return $this->db->query("	SELECT idteam FROM team INNER JOIN campus ON campus.idcampus=team.idcampus
															INNER JOIN city ON city.idcity=campus.idcity
															INNER JOIN state ON state.idstate=city.idstate
									WHERE idsportCategory=$sportCategory AND state.idstate=$state LIMIT 1")->row();
	}

	function get_states($idstate){
        if($idstate==-1)
            return $this->db->get('state')->result();
        else
            return $this->db->query("SELECT idstate,stateName FROM state WHERE idstate=".$idstate)->result();
    }

    function get_cities($idstate){

        if($idstate==-1)
            return $this->db->get('city')->result();
        else
            return $this->db->query("SELECT idcity,cityName FROM city WHERE idstate=".$idstate)->result();
    }

    function get_campus($idcity){
        if($idcity==-1)
            return $this->db->get('campus')->result();
        else
            return  $this->db->query("SELECT * FROM campus WHERE idcity=".$idcity)->result();
    }

	function get_campus_cct($idcampus){
            return  $this->db->query("SELECT cct FROM campus WHERE idcampus='$idcampus'")->row();
    }

	function get_coordinator_info($username){
            return  $this->db->query("SELECT * FROM coordinator INNER JOIN user ON user.username=coordinator.username WHERE coordinator.username='$username'")->row();
    }

	function get_sport($coordinator=false){
		if(!$coordinator)
			return $this->db->get('sport')->result();
		else
			return $this->db->query("SELECT sport.idsport,sportName FROM sport INNER JOIN sportcategory ON sport.idsport=sportcategory.idsport
										WHERE idsportcategory NOT IN 	(SELECT team.idsportCategory FROM team
																		INNER JOIN sportcategory ON team.idsportCategory=sportcategory.idsportCategory
																		INNER JOIN sport ON sport.idsport=sportcategory.idsport
																		INNER JOIN campus ON team.idcampus=campus.idcampus
																		INNER JOIN city ON campus.idcity=city.idcity
																		WHERE idstate=(	SELECT idstate FROM state
																						INNER JOIN coordinator ON coordinator.idcoordinator=state.idcoordinator
																						WHERE username='".$coordinator."'))
										GROUP BY sportName
										ORDER BY sportName ASC")->result();
    }

    function get_sportcategory($idsport,$idstate=0){

        if($idsport==-1)
            return $this->db->get('sportcategory')->result();
        else{
			if(!$idstate)
				return $this->db->query("SELECT idsportCategory,idsport,sportCategoryName FROM sportcategory WHERE idsport=$idsport ORDER BY sportCategoryName ASC")->result();
			else
				return $this->db->query("SELECT * FROM sportcategory WHERE idsportcategory NOT IN (SELECT team.idsportCategory FROM team 	INNER JOIN sportcategory ON team.idsportCategory=sportcategory.idsportCategory
														INNER JOIN sport ON sport.idsport=sportcategory.idsport
														INNER JOIN campus ON team.idcampus=campus.idcampus
														INNER JOIN city ON campus.idcity=city.idcity
										WHERE idstate=$idstate) AND idsport=$idsport ORDER BY sportCategoryName ASC")->result();
        }
    }

	function get_state_by_coordinator($coordinator){
		return  $this->db->query("SELECT * FROM state
                                                        WHERE idcoordinator = (  SELECT idcoordinator FROM coordinator
                                                                                        WHERE username='".$coordinator."')")->row();
	}

    function get_teams($coordinator){
        return $this->db->query("SELECT team.idteam,sportcategory.idsportCategory,sportName,sport.idsport,sportCategoryName,campusName,cityName,sportParticipantsLimit,sportParticipantsMin FROM team
					INNER JOIN sportcategory ON team.idsportCategory=sportcategory.idsportCategory
					INNER JOIN sport ON sport.idsport=sportcategory.idsport
					INNER JOIN campus ON team.idcampus=campus.idcampus
					INNER JOIN city ON campus.idcity=city.idcity
                                                WHERE city.idstate=(SELECT idstate FROM state
                                                                                INNER JOIN coordinator ON coordinator.idcoordinator=state.idcoordinator
                                                                                            WHERE username='".$coordinator."') ORDER BY sportName,sportCategoryName ASC")->result();
    }
    
    function get_idteams_by_coordinator($coordinator){
        return $this->db->query("SELECT team.idteam FROM team
					INNER JOIN campus ON team.idcampus=campus.idcampus
					INNER JOIN city ON campus.idcity=city.idcity
                                        INNER JOIN state ON city.idstate=state.idstate
                                        INNER JOIN coordinator ON state.idcoordinator=coordinator.idcoordinator
                                                    WHERE username='".$coordinator."'")->result();
    }

    function get_idparticipants_by_coach($coach){
    
       return $this->db->query("SELECT idparticipant FROM participant  WHERE idteam IN ( SELECT idteam FROM participant  WHERE usernameCoach='".$coach."') AND usernameCoach IS NULL")->result();
    
        
    }
	function get_idteam_by_coach($usernameCoach){
        return $this->db->query("SELECT idteam FROM team INNER JOIN participant ON pasrticipant.idteam=team.idteam WHERE username='$usernameCoach' LIMIT 1")->result();
    }

	function set_campus_cct($idcampus,$cct){
		$this->db->query("UPDATE campus SET cct='$cct' WHERE idcampus='$idcampus'");
	}

	function validate_user($username,$pass){
		return $this->db->query("SELECT COUNT(*) AS find FROM user WHERE username='$username' AND userPassword=MD5('$pass')")->result();
	}
}