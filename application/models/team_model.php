<?php

class team_model extends CI_Model
{
	function insert_data_team($team)
	{
		$this->db->insert("team",$team);
	}

	function insert_data_coach($coach)
	{
		$this->db->insert("coach",$coach);
	}
	function insert_data_participant($part)
	{
		$this->db->insert("participant",$part);
	}
    public function countTeams($schoolID){
        $query =  $this->db->query("SELECT count(team_name) as countTeam FROM team WHERE school_id = '$schoolID'");
        return $query->row()->countTeam;
}
	 public function getTeamID($name){
            $this->db->select('team_id');
            $this->db->from('team');
            $this->db->where('team_name', $name);
            return $this->db->get()->row()->team_id;
    }

    public function displayParticipants($ID){
            $aw = "SELECT participant.* FROM participant INNER JOIN team on team.team_id = participant.team_id  WHERE team.school_id = $ID";
            $query = $this->db->query($aw);
           
            if($query->num_rows() > 0){
                    foreach($query->result() as $row){
                            $data[] = $row;
                    }
                    return $data;
            }
    }

    public function getNameofParticipant($partID, $compID){
            $aw=$this->db->query("SELECT participants_in_competition.Name FROM participants_in_competition INNER JOIN teams_in_competition on teams_in_competition.teams_in_competition_id = participants_in_competition.teams_in_competition_id WHERE teams_in_competition.competition_id = '$compID' AND participants_in_competition.part_in_comp_ID = '$partID'");
            return $aw->row()->Name;
    }

    public function getEmailOfParticipant($partID, $compID){
            $aw=$this->db->query("
           SELECT participant.email 
            FROM participant
            INNER JOIN participants_in_competition on participants_in_competition.participant_id = participant.participant_id 
            INNER JOIN teams_in_competition on teams_in_competition.teams_in_competition_id = participants_in_competition.teams_in_competition_id
            WHERE teams_in_competition.competition_id = '$compID' AND participants_in_competition.part_in_comp_ID = '$partID'");
            return $aw->row()->email;
    }

    public function getParticipantsInComp($compID){
            $aw = "SELECT participants_in_competition.Name
                    FROM participants_in_competition
                    INNER JOIN teams_in_competition on participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id
                    inner join slot on slot.team_id = teams_in_competition.teams_in_competition_id
                    inner join category on slot.category_id = category.category_id
                    inner join competition on category.competition_id = competition.competition_id
                    where competition.competition_id = $compID";
            $query = $this->db->query($aw);
            return $query;
    }

    public function approveAttendance($partID){
        $this->db->query("UPDATE participants_in_competition SET attend = 'yes' WHERE part_in_comp_ID = $partID");
    }

    public function declineAttendance($partID){
        $this->db->query("UPDATE participants_in_competition SET attend = 'no' WHERE part_in_comp_ID = $partID");
    }

    public function deleteParticipant($ID){
            $aw = "DELETE FROM participant WHERE participant_id = $ID";
            $query = $this->db->query($aw);
    }

    public function deleteTeam($ID){
            $aw = "DELETE FROM team WHERE team_id = $ID";
            $query = $this->db->query($aw);
            $wew = "UPDATE team SET team_id = NULL WHERE team_id = '$ID'";
            $this->db->query($wew);
    }

    public function deleteCoach($ID){
            $aw = "DELETE FROM coach WHERE coach_id = $ID";
            $query = $this->db->query($aw);
    }

    public function getParticipant($ID){
                $this->db->select('*');
                $this->db->from('participant');
                $this->db->where('participant_id', $ID);
                $query= $this->db->get();
                foreach($query->result() as $row){
                            $data[] = $row;
                    }
                    return $data;
    }

    public function getTeam($id){
        $aw = "SELECT team.team_name, participant.participant_id, CONCAT(' ', participant.first_name, ' ', participant.last_name) AS Name, team.team_id FROM team INNER JOIN teams_members on teams_members.team_id = team.team_id inner join participant on participant.participant_id = teams_members.participant_id WHERE team.team_id = '$id'";
        $query = $this->db->query($aw);
        foreach($query->result() as $row){
            $data[] = $row;
        }
        return $data;   
    }

    public function getParticipantIDInTeam($id){
        $aw = "SELECT participant.participant_id FROM team INNER JOIN teams_members on teams_members.team_id = team.team_id inner join participant on participant.participant_id = teams_members.participant_id WHERE team.team_id = '$id'";
        $query = $this->db->query($aw);
        return $query; 
    }

    public function getParticipantsNoTeam($id){
                $aw = "SELECT participant.participant_id, CONCAT(participant.first_name, ' ', participant.last_name) AS Name FROM participant LEFT OUTER JOIN teams_members on participant.participant_id = teams_members.participant_id WHERE participant.school_id = '$id' AND teams_members.team_id IS NULL";
                $query = $this->db->query($aw);
                return $query->result();
    }

    public function getParticipantsNotInTeam($id, $partID, $count){

                $notIn = '';
                for($i=0; $i<$count; $i++){
                       if($i!=$count-1)
                         $notIn .= implode("", $partID[$i]) . ',';
                     else
                         $notIn .= implode("",$partID[$i]);
                }

                $aw = "SELECT participant.participant_id, CONCAT(participant.first_name, ' ', participant.last_name) AS Name FROM participant WHERE participant.participant_id NOT IN($notIn) AND participant.school_id = $id";
                $query = $this->db->query($aw);
                return $query->result();
    }

    public function getParticipantsInTeam($id, $partID){
                $aw = "SELECT participant.participant_id, CONCAT(participant.first_name, ' ', participant.last_name) AS Name FROM participant FROM team INNER JOIN teams_members on teams_members.team_id = team.team_id inner join participant on participant.participant_id = teams_members.participant_id WHERE team.team_id = '$id'";
                $query = $this->db->query($aw);
                return $query->result();
    }

    public function getParticipantsInSchool($id){
                $aw = "SELECT participant.participant_id, CONCAT(participant.first_name, ' ', participant.last_name) AS Name FROM participant WHERE participant.school_id = '$id'";
                $query = $this->db->query($aw);
                return $query->result();
    }

    public function getAllTeamsBySchool($SchoolID){
                $aw = "SELECT participant.participant_id, CONCAT(participant.first_name, ' ', participant.last_name) AS Name FROM participant INNER JOIN teams_members on participant.participant_id = teams_members.participant_id WHERE participant.school_id = '$SchoolID'";
                $query = $this->db->query($aw);
                return $query->result();
    }

    public function getCoachForTeam($id){
                $aw = "SELECT coach_id, CONCAT(first_name, ' ', last_name) AS Name FROM coach WHERE school_id = '$id' ";
                $query = $this->db->query($aw);
                return $query->result();
    }

    public function getCoaches($id, $teamID){
                $schoolid = $this->session->userdata('id');
                $aw = "SELECT coach.coach_id, CONCAT(coach.first_name, ' ', coach.last_name) AS Name FROM coach LEFT OUTER JOIN teams_members on coach.coach_id = teams_members.coach_id
                    where teams_members.team_id IS NULL AND coach.school_id = $schoolid";
                $query = $this->db->query($aw);
                return $query->result();
    }

    public function getAllCoach($id){
                $aw = "SELECT coach.coach_id, CONCAT(coach.first_name, ' ', coach.last_name) AS Name FROM coach WHERE coach.school_id = $id";
                $query = $this->db->query($aw);
                return $query->result();
    }



    public function getCoachInTeam($teamID){
                $aw = "SELECT DISTINCT coach.coach_id, CONCAT(coach.first_name, ' ', coach.last_name) AS Name FROM coach INNER JOIN teams_members on coach.coach_id = teams_members.coach_id && teams_members.team_id = $teamID ";
                $query = $this->db->query($aw);
                if($query->num_rows()>0){
                    foreach($query->result() as $row){
                        $data[] = $row;
                    }
                    return $data;
                }
                else
                    return "false";   
    }

    public function getCoachNotInTeam($teamID, $coachID){


                $aw = "SELECT DISTINCT coach.coach_id, CONCAT(coach.first_name, ' ', coach.last_name) AS Name FROM coach INNER JOIN teams_members on coach.coach_id = teams_members.coach_id WHERE coach.coach_id NOT IN($coachID) AND teams_members.team_id = $teamID ";
                $query = $this->db->query($aw);
                return $query->result();
    }

       public function getCoachIDInTeam($teamID){
                $aw = "SELECT DISTINCT coach.coach_id FROM coach INNER JOIN teams_members on coach.coach_id = teams_members.coach_id && teams_members.team_id = $teamID ";
                $query = $this->db->query($aw);
                return $query->row()->coach_id;
    } 

    public function getCoach($ID){
                $this->db->select('*');
                $this->db->from('coach');
                $this->db->where('coach_id', $ID);
                $query= $this->db->get();
                foreach($query->result() as $row){
                            $data[] = $row;
                    }
                    return $data;
    }

    public function getParticipantIDemail($email){
            $aw = "SELECT * FROM participant WHERE email = '$email'";
            $query = $this->db->query($aw);
            return $query->row()->participant_id;
    }

      public function editParticipant($user, $participantID){
            $fname = $user['first_name'];
            $mname = $user['middle_name'];
            $lname = $user['last_name'];
            $address = $user['address'];
            $email = $user['email'];
            $contactno = $user['contact_no'];
            // die();
            // $aw = "UPDATE participant SET first_name = '$fname', middle_name = '$name', last_name = '$lname', address = '$address', email = '$email', contact_no = '$contactno' WHERE participant_id = $participantID";
            $aw = "UPDATE participant SET contact_no = '$contactno', first_name = '$fname', middle_name = '$mname', last_name = '$lname', address = '$address', email = '$email' WHERE participant_id = $participantID";
            $query = $this->db->query($aw);
           
            // if($query->num_rows() > 0){
            //         foreach($query->result() as $row){
            //                 $data[] = $row;
            //         }
            //         return $data;
            // }
    }

      public function editCoach($user, $coachID){
        $fname = $user['first_name'];
        $mname = $user['middle_name'];
        $lname = $user['last_name'];
        $address = $user['address'];
        $email = $user['email'];
        $contactno = $user['contact_no'];
        // die();
        // $aw = "UPDATE participant SET first_name = '$fname', middle_name = '$name', last_name = '$lname', address = '$address', email = '$email', contact_no = '$contactno' WHERE participant_id = $participantID";
        $aw = "UPDATE coach SET contact_no = '$contactno', first_name = '$fname', middle_name = '$mname', last_name = '$lname', address = '$address', email = '$email' WHERE coach_id = $coachID";
        $query = $this->db->query($aw);

    }

    public function createParticipant($user){
            $this->db->insert('participant', $user);
    }

    public function createTeam($team){
            $this->db->insert('team', $team);
    }

    public function createTeamMembers($team){
            $this->db->insert('teams_members', $team);
    }

    public function createCoach($user){
            $this->db->insert('coach', $user);
    }

    public function checkMatri($participantID){
        $aw = "SELECT * from photos WHERE participant_id = $participantID";
        $query = $this->db->query($aw);
        if($query->num_rows() > 0)
            return true;
        else
            return false;
    }

     public function updateMatri($pID, $filename){
        $aw = "update photos set file_name = '$filename' WHERE participant_id = $pID";
        $query = $this->db->query($aw);
    }   

     public function updateTeamName($teamID, $TeamName){
        $aw = "update team set team_name = '$TeamName' WHERE team_id = $teamID";
        $query = $this->db->query($aw);
    }  

     public function setTeamForParticipant($teamID, $partID){
        $aw = "INSERT INTO teams_members (participant_id, team_id) VALUES ('$partID', '$teamID')";
        $query = $this->db->query($aw);
    }

    public function setTeamForCoach($teamID, $coachID){
        $aw = "update teams_members set coach_id = '$coachID' WHERE team_id = $teamID";
        $query = $this->db->query($aw);
    }

    public function clearTeam($teamID){
        $aw = "DELETE FROM teams_members WHERE team_id = '$teamID'";
        $query = $this->db->query($aw);
    }

    public function clearTeamsCoach($teamID){
        $aw = "update teams_members set coach_id = NULL WHERE team_id = '$teamID'";
        $query = $this->db->query($aw);
    }
    

    function participant_list(){
        $hasil=$this->db->get('participant');
        return $hasil->result();
    }

    public function viewApprovedTeams($catID){
            $aw = "select school.school_name, teams_in_competition.*, GROUP_CONCAT(participants_in_competition.Name) as Members
                    from teams_in_competition 
                    inner join participants_in_competition on participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id
                    inner join school on teams_in_competition.school_id = school.school_id
                    where teams_in_competition.category_id = $catID";

            $query = $this->db->query($aw);
            
            if($query->num_rows() > 0){
                foreach($query->result() as $row){
                    $data[] = $row;
                }
                return $data;
            }
            else
                return 'nothing';

    }

        public function viewApprovedTeamz($catID){
            
            $aw = "select school.school_name, school.school_id, teams_in_competition.*, GROUP_CONCAT(participants_in_competition.Name) as Members
                    from teams_in_competition 
                    inner join participants_in_competition on participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id
                    inner join school on teams_in_competition.school_id = school.school_id
                    inner join slot on slot.team_id = teams_in_competition.teams_in_competition_id
                    where teams_in_competition.category_id = $catID AND slot.status='approved'
                    group by teams_in_competition.teams_in_competition_id";

            $query = $this->db->query($aw);
            
            if($query->num_rows() > 0){
                foreach($query->result() as $row){
                    $data[] = $row;
                }
                return $data;
            }
            else
                return 'nothing';

    }


     public function getSchoolID($name){
            $this->db->select('school_id');
            $this->db->from('school');
            $this->db->where('school_name', $name);
            return $this->db->get()->row()->school_id;
    }

     public function displayTeams($ID){
            while($status=='school'){
                $this->db->select('a.*', 'b.*');
                $this->db->from('team a', 'school b');
                $this->db->where('a.school_id', $ID);
                $this->db->where('a.school_id', 'b.school_id');
                $query= $this->db->get();               //DAPAT NADIDISPLAY MAN SI COACH. SASARUON DAPAT ANG PAG RETURN KANG QUERY
                return $query;

            }
    }

    public function checkCatType($id){
            $this->db->select('category_type');
            $this->db->from('category');
            $this->db->where('category_id', $id);
            return $this->db->get()->row()->category_type;
    }

    public function displayALL($ID, $status){
                $q = "select team.team_name AS 'TeamName', GROUP_CONCAT(CONCAT(' ' , participant.first_name, ' ', participant.last_name)) AS Members, CONCAT(coach.first_name, ' ', coach.last_name) AS Coach, team.team_id AS TeamID, school.school_name AS SchoolName
                from team, participant, coach, school
                where team.team_id = participant.team_id && team.team_id = coach.team_id && team.school_id = school.school_id && school.school_id = $ID
                group by team.team_id"; 

            $query = $this->db->query($q);

            if($query->num_rows() > 0){
                    foreach($query->result() as $row){
                            $data[] = $row;
                    }
                    return $data;
            }

    }

    public function displayALLIndividual($ID, $status){
        $q = "select team.team_name AS 'TeamName', GROUP_CONCAT(CONCAT(' ' , participant.first_name, ' ', participant.last_name)) AS Members, CONCAT(coach.first_name, ' ', coach.last_name) AS Coach, team.team_id AS TeamID, school.school_name AS SchoolName 
from team 
inner join teams_members on teams_members.team_id = team.team_id
inner join participant on teams_members.participant_id = participant.participant_id

left join coach on coach.coach_id = teams_members.coach_id 
inner join school on school.school_id = team.school_id 
where school.school_id = $ID
group by team.team_id 
having count(participant.first_name) = 1";

            $query = $this->db->query($q);
            if($query->num_rows() > 0){
                    foreach($query->result() as $row)
                            $data[] = $row;
                    return $data;
            }
            else
                return 'nothing';
    }

        public function displayALLIndividualInSlot($ID, $status, $catID){
        $q = "select team.team_name AS 'TeamName', GROUP_CONCAT(CONCAT(' ' , participant.first_name, ' ', participant.last_name)) AS Members, CONCAT(coach.first_name, ' ', coach.last_name) AS Coach, team.team_id AS TeamID, school.school_name AS SchoolName 
            from team 
            inner join teams_members on teams_members.team_id = team.team_id
            inner join participant on teams_members.participant_id = participant.participant_id

            left join coach on coach.coach_id = team.coach_id 
            inner join school on school.school_id = team.school_id 
            where school.school_id = $ID
            group by team.team_id 
                        having count(participant.first_name)=1";

            $query = $this->db->query($q);
            if($query->num_rows() > 0){
                    foreach($query->result() as $row)
                            $data[] = $row;
                    return $data;
            }
            else
                return 'nothing';
    }

    public function displayALLGroup($ID, $status){
        //while($status=='school'){

             /*select team.team_name AS 'Team Name', GROUP_CONCAT(participant.first_name) AS Members, coach.first_name AS Coach
                from team, participant, coach
                where team.team_id = participant.team_id && team.team_id = coach.team_id
                group by team.team_id
                */

                


                $q = "select team.team_name AS 'TeamName', GROUP_CONCAT(CONCAT(' ' , participant.first_name, ' ', participant.last_name)) AS Members, CONCAT(coach.first_name, ' ', coach.last_name) AS Coach, team.team_id AS TeamID, school.school_name AS SchoolName 
                    from team 
                    inner join teams_members on teams_members.team_id = team.team_id
                    inner join participant on teams_members.participant_id = participant.participant_id

                    left join coach on coach.coach_id = teams_members.coach_id 
                    inner join school on school.school_id = team.school_id 
                    where school.school_id = $ID
                    group by team.team_id 
                    having count(participant.first_name) >= 3";
                
                $query = $this->db->query($q);
                /*$this->db->select('team.name', 'GROUP_CONCAT(participant.first_name) AS Members', 'coach.first_name');
                $this->db->from('team', 'participant', 'coach');
                $this->db->where('team.team_id', 'participant.team_id');
                $this->db->where('team.team_id', 'coach.team_id');
                $this->db->where('team.school_id', $ID);
                //$this->db->join('team', 'coach.team_id = team.team_id');
                */
                if($query->num_rows() > 0){
                    foreach($query->result() as $row)
                            $data[] = $row;
                    return $data;
                }
                else
                    return 'nothing';


                //$query= $this->db->get();
                //return $query;
        //}
    }

    public function displayTeamsApprovedANDPending($catID){
        $schoolID = $this->session->userdata('id');

        $checker = "select participants_in_competition.Name AS Names, teams_in_competition.team_name
            from participants_in_competition 
            inner join teams_in_competition on teams_in_competition.teams_in_competition_id = participants_in_competition.teams_in_competition_id 
            where teams_in_competition.category_id = $catID AND teams_in_competition.school_id = '$schoolID'";

        $q = "select GROUP_CONCAT(participants_in_competition.Name) AS Names, teams_in_competition.team_name, slot.status, slot.team_id, slot.payment, slot.slot_id
                from participants_in_competition 
                inner join teams_in_competition on teams_in_competition.teams_in_competition_id = participants_in_competition.teams_in_competition_id
                inner join slot on slot.team_id = teams_in_competition.teams_in_competition_id
                where teams_in_competition.category_id = $catID AND teams_in_competition.school_id = $schoolID AND teams_in_competition.category_id = slot.category_id GROUP BY teams_in_competition.teams_in_competition_id";

        $query = $this->db->query($checker);
        if($query->num_rows() > 0){
            $query = $this->db->query($q);
            foreach($query->result() as $row)
                    $data[] = $row;
            return $data;
        }
        else
            return 'nothing';
    }

    public function displayCoach($ID, $status){
            while($status=='school'){

                //SELECT 
                //FROM coach
                //INNER JOIN team ON coach.team_id = team.team_id

                /*
                select coach.first_name, team.team_name, participant.first_name
                from coach
                INNER JOIN team ON coach.team_id = team.team_id
                INNER JOIN participant ON participant.team_id = team.team_id
            
            */

                /*
                SELECT first_name, last_name
                FROM participant
                WHERE EXISTS (SELECT team_name FROM team WHERE team_id = participant.team_id);
                */

               

                $this->db->select('coach.*, team.*, team.team_name');
                $this->db->from('coach');
                $this->db->join('team', 'coach.team_id = team.team_id');
                $query= $this->db->get();
                return $query;

            }
    }

    public function joinTeam($teamid, $participantID, $coachID){
            $aw = "INSERT INTO teams_members (participant_id, team_id, coach_id) VALUES ('$participantID', '$teamid', '$coachID')";
            $query = $this->db->query($aw);
    }

    public function CoachJoin($teamid, $coachID){
            $aw = "INSERT INTO teams_members (coach_id, team_id) VALUES ('$coachID', '$teamid')";
            $query = $this->db->query($aw);
    }

    public function displayMembers($ID, $status){
            while($status=='school'){
                $this->db->select('*');
                $this->db->from('team');
                $query= $this->db->get();
                return $query;

            }
    }
}