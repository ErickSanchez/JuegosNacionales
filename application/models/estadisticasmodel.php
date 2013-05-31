<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticasmodel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    function get_table($sportName='',$limit=0){        
     $data=$this->db->query("SELECT stateName,
								(SELECT COUNT(idevent) FROM event WHERE (idteamOne=a.idassignation AND scoreteamOne IS NOT NULL) OR (idteamTwo=a.idassignation AND scoreteamTwo IS NOT NULL)) AS games,
								(SELECT SUM(scoreTeamOne) FROM event WHERE idteamOne=a.idassignation) AS scoreLocal,
								(SELECT SUM(scoreTeamTwo) FROM event WHERE idteamTwo=a.idassignation) AS scoreVisit,
								(SELECT SUM(scoreTeamTwo) FROM event WHERE idteamOne=a.idassignation) AS againstScoreLocal,
								(SELECT SUM(scoreTeamOne) FROM event WHERE idteamTwo=a.idassignation) AS againstScoreVisit,
								(SELECT COUNT(*) FROM event WHERE (idteamOne=a.idassignation AND scoreteamOne>scoreteamTwo) OR (idteamTwo=a.idassignation AND scoreteamTwo>scoreteamOne)) AS wins,
								(SELECT COUNT(*) FROM event WHERE (idteamOne=a.idassignation AND scoreteamOne<scoreteamTwo) OR (idteamTwo=a.idassignation AND scoreteamTwo<scoreteamOne)) AS fails,
								groupName,sportCategoryName,sportName
								FROM assignation AS a
								LEFT JOIN team ON team.idassignation=a.idassignation
								LEFT JOIN campus ON campus.idcampus=team.idcampus
								LEFT JOIN city ON city.idcity=campus.idcity
								LEFT JOIN state ON state.idstate=city.idstate
								LEFT JOIN groups ON groups.idgroup=a.idgroup
								LEFT JOIN sportcategory ON sportcategory.idsportCategory=groups.idsportCategory
								LEFT JOIN sport ON sport.idsport=sportcategory.idsport
								WHERE sport.sportName='".$sportName."' AND groupName!='SF' AND groupName!='FN'
								ORDER BY sportName,sportCategoryName,groupName,fails ASC");
     if($data)
        return $data->result();
        
    }
}