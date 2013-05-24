<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Participantmodel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    function get_coach_info($idcoach){

        return  $this->db->query("SELECT * FROM participant
                                            LEFT JOIN participantmeta ON participant.idparticipant=participantmeta.idparticipant
                                            LEFT JOIN team  ON participant.idteam=team.idteam
                                            LEFT JOIN sportcategory ON team.idsportCategory=sportcategory.idsportCategory
                                            LEFT JOIN sport ON sportcategory.idsport=sport.idsport
                                            LEFT JOIN campus  ON team.idcampus=campus.idcampus
                                            LEFT JOIN city ON  campus.idcity=city.idcity
                                            LEFT JOIN state ON city.idstate=state.idstate
                                                    WHERE participant.idparticipant=$idcoach")->row();
    }
function get_participant_info($idparticipant){

        return  $this->db->query("SELECT * FROM participant JOIN  participantathlete ON participant.idparticipant=participantathlete.idparticipant
                                            LEFT JOIN address ON participant.idparticipant=address.idparticipant
                                            LEFT JOIN participantmeta ON participant.idparticipant=participantmeta.idparticipant
                                            LEFT JOIN team ON participant.idteam=team.idteam
                                            LEFT JOIN sportcategory ON team.idsportCategory=sportcategory.idsportCategory
                                            LEFT JOIN sport ON sportcategory.idsport=sport.idsport
                                            LEFT JOIN campus ON team.idcampus=campus.idcampus
                                            LEFT JOIN city ON city.idcity=campus.idcity
                                            LEFT JOIN state ON city.idstate=state.idstate
							WHERE participant.idparticipant=$idparticipant")->row();
    }

    
 function update_participant($table,$data,$id){
           $this->db->update($table,$data,$id);
 }

 function delete($idparticipant,$idteam){
      $this->db->trans_start();
            $this->db->query("DELETE FROM participant WHERE idparticipant = '$idparticipant'  AND idteam = '$idteam'");
      $this->db->trans_complete();

    }
  function  get_number_of_years_for_team($year,$idteam,$idparticipant=0){
      $sql="";
     
      if($idparticipant)
          $sql="participant.idparticipant != '".$idparticipant."' AND ";
          
    
      return  $this->db->query("SELECT COUNT(*) AS numbers FROM participant  LEFT JOIN participantmeta ON participant.idparticipant=participantmeta.idparticipant
                                                    WHERE ".$sql." participant.idteam='".$idteam."' AND YEAR(participantmeta.birthdate)='".$year."'")->row();
      
  }
}
