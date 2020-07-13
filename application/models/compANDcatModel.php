<?php
    class compANDcatModel extends CI_Model{

        public function __construct() 
        {
           parent::__construct(); 
           $this->load->database();
        }

        public function displayComp($ID, $status){
            if($status=='director' || $status=='Secretariat Committee' || $status = 'Technical Committee'){
                $this->db->select('*');
                $this->db->from('competition');
                $this->db->where('director_id', $ID);
                $this->db->order_by('start_date', 'desc');
                $query= $this->db->get();
     		    return $query;
            }

            else if($status=='school'){
                $this->db->select('*');
                $this->db->from('competition');
                $query= $this->db->get();
                return $query;
            }
         }

        public function getFeedbackFromCompetition($compID){
            $query = $this->db->query("SELECT * FROM feedback WHERE competition_id = '$compID'");
            if($query->result())
                return $query;
            else
                return 'false';
        }

        public function getResponse1FromCompetition($compID){
            $query = $this->db->query("SELECT response1, count(*) as no 
                                       FROM feedback 
                                       WHERE competition_id = '$compID'
                                       GROUP BY response1
                                       ORDER BY feedback_id");
            if($query->result())
                return $query->result_array();
            else
                return 'false';            
        }

        public function getResponse2FromCompetition($compID){
            $query = $this->db->query("SELECT response2, count(*) as no 
                                       FROM feedback 
                                       WHERE competition_id = '$compID'
                                       GROUP BY response2
                                       ORDER BY feedback_id");
            if($query->result())
                return $query->result_array();
            else
                return 'false';            
        }

        public function getResponse3FromCompetition($compID){
            $query = $this->db->query("SELECT response3, count(*) as no 
                                       FROM feedback 
                                       WHERE competition_id = '$compID'
                                       GROUP BY response3
                                       ORDER BY feedback_id");
            if($query->result())
                return $query->result_array();
            else
                return 'false';            
        }

        public function getResponse4FromCompetition($compID){
            $query = $this->db->query("SELECT response4, count(*) as no 
                                       FROM feedback 
                                       WHERE competition_id = '$compID'
                                       GROUP BY response4
                                       ORDER BY feedback_id");
            if($query->result())
                return $query->result_array();
            else
                return 'false';            
        }

        public function getResponse5FromCompetition($compID){
            $query = $this->db->query("SELECT response5, count(*) as no 
                                       FROM feedback 
                                       WHERE competition_id = '$compID'
                                       GROUP BY response1
                                       ORDER BY feedback_id");
            if($query->result())
                return $query->result_array();
            else
                return 'false';            
        }

        public function getResponse6FromCompetition($compID){
            $query = $this->db->query("SELECT response6, count(*) as no 
                                       FROM feedback 
                                       WHERE competition_id = '$compID'
                                       GROUP BY response1
                                       ORDER BY feedback_id");
            if($query->result())
                return $query->result_array();
            else
                return 'false';            
        }

        public function getResponse7FromCompetition($compID){
            $query = $this->db->query("SELECT response7, count(*) as no 
                                       FROM feedback 
                                       WHERE competition_id = '$compID'
                                       GROUP BY response1
                                       ORDER BY feedback_id");
            if($query->result())
                return $query->result_array();
            else
                return 'false';            
        }

        public function getMostLikedComments($compID){
            $query = $this->db->query("SELECT comments1 FROM feedback WHERE competition_id = '$compID'");
            if($query->result())
                return $query->result_array();
            else
                return 'false';
        }

        public function getExpectationsComments($compID){
            $query = $this->db->query("SELECT comments2 FROM feedback WHERE competition_id = '$compID'");
            if($query->result())
                return $query->result_array();
            else
                return 'false';
        }

        public function getSuggestionsComments($compID){
            $query = $this->db->query("SELECT comments3 FROM feedback WHERE competition_id = '$compID'");
            if($query->result())
                return $query->result_array();
            else
                return 'false';
        }

        public function getAverage($compID){
            $query = $this->db->query("SELECT round((rating/5)*100, 2) as average FROM `feedback` WHERE competition_id = '$compID'");
            if($query->result_array())
                return $query->row()->average;
            else
                return 'false';
        }

        public function countComp($ID, $status){
            if($status=='director' || $status=='Secretariat Committee' || $status = 'Technical Committee'){
                $this->db->select('*');
                $this->db->from('competition');
                $this->db->where('director_id', $ID);
                $this->db->order_by('start_date', 'desc');
                $query = $this->db->get();
                return $query->num_rows();
            }

            else if($status=='school'){
                $this->db->select('*');
                $this->db->from('competition');
                $query= $this->db->get();
                return $query;
            }
         }

         public function fetchCompetitions($query, $directorID){
            
              $this->db->select("competition_id, competition_name, DATE_FORMAT(start_date, '%M %e, %Y') as start_date, DATE_FORMAT(end_date, '%M %e, %Y') as end_date");
              $this->db->from("competition");
              $this->db->where("director_id", $directorID);

              if($query != ''){
                   $this->db->like('competition_name', $query);
                   $this->db->or_like("date_format(start_date, '%M %e, %Y')", $query);
                   // $this->db->or_like("date_format(end_date, '%M %e, %Y')", $query);
              }

              $this->db->order_by('start_date', 'DESC');
              return $this->db->get();
        }

         public function fetchCompetitions2($query, $directorID, $limit, $start){
              $this->db->limit($limit, $start);
              $this->db->select("competition_id, competition_name, DATE_FORMAT(start_date, '%M %e, %Y') as start_date, DATE_FORMAT(end_date, '%M %e, %Y') as end_date");
              $this->db->from("competition");
              $this->db->where("director_id", $directorID);

              if($query != ''){
                   $this->db->like('competition_name', $query);
                   $this->db->or_like("date_format(start_date, '%M %e, %Y')", $query);
                   // $this->db->or_like("date_format(end_date, '%M %e, %Y')", $query);
              }

              $this->db->order_by('start_date', 'DESC');
              return $this->db->get();
        }

        public function getDateOfCat($catID){

            $query = $this->db->query("SELECT competition.start_date, competition.end_date 
                              FROM competition
                              inner join category on category.competition_id = competition.competition_id
                              WHERE category.category_id = '$catID'");
            
            return $query->row()->start_date;
        }

        public function getCompetitionsForSchool(){
            $query = $this->db->query("select DISTINCT (a.competition_id) as CompID, a.competition_name, date_format(a.start_date, '%M %e, %Y') as start_date, a.invite_only from competition a");
            if($query->result()){
                return $query;
            }else{
                return 'false';
            }
        }

        public function checkIfInvited($competition_id, $school_id){
            $query = $this->db->query("SELECT * FROM invites WHERE competition_id = $competition_id AND school_id = $school_id");
            if($query->result())
                return true;
            else
                return false;
        }

        public function getComps($params=array()){
            $this->db->select("competition_id, competition_name, DATE_FORMAT(start_date, '%M %e, %Y') as start_date, DATE_FORMAT(end_date, '%M %e, %Y') as end_date, director_id");
            $this->db->from('competition');
            $this->db->where('director_id', $this->session->userdata('id'));
            $this->db->order_by('start_date', 'desc');

                    //filter data by searched keywords


            if(!empty($params['searchKeyword'])){
                $this->db->like('competition_name',$params['searchKeyword']);
                $this->db->or_like("DATE_FORMAT(start_date, '%M %e, %Y')",$params['searchKeyword']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }
            else{
                if(array_key_exists("id", $params)){
                    $this->db->where('id', $params['id']);
                    $query = $this->db->get();
                    $result = $query->row_array();
                }else{
                    $this->db->order_by('start_date', 'asc');
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                    }
                    
                    $query = $this->db->get();
                    $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
                }
            }
            return $result;
        }

        public function getDoneComps($params=array()){
            $this->db->select("competition_id, competition_name, DATE_FORMAT(start_date, '%M %e, %Y') as start_date, DATE_FORMAT(end_date, '%M %e, %Y') as end_date, director_id");
            $this->db->from('competition');
            $this->db->where('director_id', $this->session->userdata('id'));
            $this->db->where("start_date <= CURDATE() ");
            $this->db->order_by('start_date', 'desc');

            //filter data by searched keywords
            if(!empty($params['searchKeyword'])){
                $this->db->like('competition_name',$params['searchKeyword']);
                $this->db->or_like("DATE_FORMAT(start_date, '%M %e, %Y')",$params['searchKeyword']);
                $this->db->where("DATE_FORMAT(start_date, '%M %e, %Y') <= CURDATE()" );
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }
            else{
                if(array_key_exists("id", $params)){
                    $this->db->where('id', $params['id']);
                    $query = $this->db->get();
                    $result = $query->row_array();
                }else{
                    $this->db->order_by('start_date', 'desc');
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                    }
                    
                    $query = $this->db->get();
                    $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
                }
            }
            return $result;
        }
            
         

         public function getTeamsFromAttendance($compID){
            $query = $this->db->query("SELECT competition.competition_name, competition.start_date, competition.end_date, teams_in_competition.team_name, participants_in_competition.Name FROM competition INNER JOIN teams_in_competition ON teams_in_competition.competition_id = competition.competition_id INNER JOIN participants_in_competition ON participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id WHERE competition.competition_id = $compID AND participants_in_competition.attend='yes'");
            if($query->num_rows()>0)
                return $query->result_array();
            return false;

         }

         public function secCountComp($secID,$status){
            if($status = 'Secretariat Committee'){
           $query= $this->db->query("SELECT count(competition.competition_name) as countComp from competition,committee where competition.director_id = committee.director_id AND committee.committee_id = '$secID'");
           return $query->row()->countComp;
            }
        }
       public function countCompetitions($directorID){
           $query = $this->db->query("SELECT count(competition_name) as countComp from competition where director_id = $directorID");
           return $query->row()->countComp;
       }
       public function countTeams(){
           $query = $this->db->query("SELECT count(*) as countTeams from team");
           return $query->row()->countTeams;
       }
       public function countAllComp(){
           $query = $this->db->query("SELECT count(*) as countAll from competition");
           return $query->row()->countAll;
       }
        public function getWinners($catID){
           $query = $this->db->query("SELECT team_competition_winners.rank, team_competition_winners.team_name FROM competition_scoreboard INNER JOIN team_competition_winners on competition_scoreboard.competition_scoreboard_id = team_competition_winners.competition_scoreboard_id WHERE competition_scoreboard.category_id = $catID  ORDER BY team_competition_winners.rank ASC");
           if($query->num_rows()>0)
               return $query;
           return false;
        }


        public function getWinnersDataTables($params=array()){
            // $query = $this->db->query("SELECT team_competition_winners.rank, team_competition_winners.team_name FROM competition_scoreboard INNER JOIN team_competition_winners on competition_scoreboard.competition_scoreboard_id = team_competition_winners.competition_scoreboard_id WHERE competition_scoreboard.category_id = $catID ORDER BY team_competition_winners.rank ASC");
            
            $this->db->select("a.rank, a.team_name");
            $this->db->from('competition_scoreboard b');
            $this->db->join('team_competition_winners a', 'a.competition_scoreboard_id = b.competition_scoreboard_id', 'INNER');
            $this->db->where('b.category_id', $params['catID']);
            $this->db->order_by('a.rank', 'ASC');

            if(!empty($params['searchKeyword'])){
                $this->db->like('team_name',$params['searchKeyword']);
                $this->db->or_like("rank",$params['searchKeyword']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }
            else{
                if(array_key_exists("id", $params)){
                    $this->db->where('id', $params['id']);
                    $query = $this->db->get();
                    $result = $query->row_array();
                }else{
                    $this->db->order_by('rank', 'asc');
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                    }
                    
                    $query = $this->db->get();
                    $result = ($query->num_rows() > 0)?$query->result_array():'nothing';
                }
            }
            return $result;
         }

        public function displayDoneComp($ID, $status){
            if($status=='director' || $status=='Secretariat Committee' || $status = 'Technical Committee'){
                $query = $this->db->query("SELECT * FROM competition WHERE end_date <= CURDATE()");
                
                return $query;
            }

            else if($status=='school'){
                $this->db->select('*');
                $this->db->from('competition');
                $query= $this->db->get();
                return $query;

            }
         }

         public function getDescription($CompID){
            $this->db->select('description');
            $this->db->from('competition');
            $this->db->where('competition_id', $CompID);
            return $this->db->get()->row()->description;
         }



        public function getApprovedTeamInComp($compID, $schoolID){
            $query = $this->db->query(" 
                    SELECT participants_in_competition.Name, teams_in_competition.* 
                    from participants_in_competition 
                    inner join teams_in_competition 
                    on teams_in_competition.teams_in_competition_id = participants_in_competition.teams_in_competition_id 
                    where teams_in_competition.school_id = $schoolID AND teams_in_competition.competition_id = $compID");
            return $query;
        }

        public function getPaymentmethod($catID){
            $query = $this->db->query("SELECT payment FROM category WHERE category_id = $catID");
            return $query->row()->payment;
        }

        public function getCategoryType($catID){
            $query = $this->db->query("SELECT category_type FROM category WHERE category_id = $catID");
            return $query->row()->category_type;
        }

        public function getApprovedInCat($catID, $schoolID){
            $query = $this->db->query("SELECT participants_in_competition.Name FROM teams_in_competition INNER JOIN participants_in_competition ON participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id WHERE teams_in_competition.category_id = $catID AND teams_in_competition.school_id = $schoolID");
            return $query;
        }

        public function getApprovedInComp($compID, $schoolID){
            $query = $this->db->query("SELECT DISTINCT(participants_in_competition.Name) FROM teams_in_competition INNER JOIN participants_in_competition ON participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id WHERE teams_in_competition.competition_Id = $compID AND teams_in_competition.school_id = $schoolID");
            return $query;
        }

        
        public function displayCompSchool($params=array()){

               
                $id = $params['SchoolID'];
               
                $this->db->distinct();
                $this->db->select("a.competition_id, a.competition_name, DATE_FORMAT(a.start_date, '%M %e, %Y') as start_date, DATE_FORMAT(a.end_date, '%M %e, %Y') as end_date, a.director_id");
                $this->db->from('competition a');
                $this->db->join('category b', 'b.competition_id = a.competition_id', 'INNER');
                $this->db->join('slot c', 'c.category_id = b.category_id', 'INNER');
                $this->db->join('teams_in_competition d', 'c.team_id = d.teams_in_competition_id', 'INNER');
                $this->db->join('school e', 'e.school_id = d.school_id', 'INNER');
                $this->db->where("e.school_id", $id);
                $this->db->where('c.status', 'approved');
                $this->db->order_by('start_date', 'desc');

                //filter data by searched keywords
                if(!empty($params['searchKeyword'])){
                    $this->db->like('competition_name',$params['searchKeyword']);
                    $this->db->or_like("DATE_FORMAT(start_date, '%M %e, %Y')",$params['searchKeyword']);
                    $this->db->where("DATE_FORMAT(start_date, '%M %e, %Y') <= CURDATE()" );
                }
                
                if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                    $result = $this->db->count_all_results();
                }
                else{
                    if(array_key_exists("id", $params)){
                        $this->db->where('id', $params['id']);
                        $query = $this->db->get();
                        $result = $query->row_array();
                    }else{
                        $this->db->order_by('start_date', 'desc');
                        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit'],$params['start']);
                        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                            $this->db->limit($params['limit']);
                        }
                        
                        $query = $this->db->get();
                        $result = ($query->num_rows() > 0)?$query->result_array():'false';
                    }
                }
                return $result;



        }


    public function countApprovedTeams($catID, $schoolID){
         
         $query = $this->db->query("select count(teams_in_competition.team_name) as count
                                    from teams_in_competition
                                    inner join slot on slot.team_id = teams_in_competition.teams_in_competition_id
                                    where teams_in_competition.category_id = $catID AND teams_in_competition.school_id = $schoolID AND teams_in_competition.category_id = slot.category_id AND slot.status='approved'");
        if($query->num_rows()>0)
                return $query->row()->count;
        return false;

    }

    public function countApprovedTeamsDirector($catID){
         $query = $this->db->query("select count(teams_in_competition.team_name) as count
                                    from teams_in_competition
                                    inner join slot on slot.team_id = teams_in_competition.teams_in_competition_id
                                    where teams_in_competition.category_id = $catID AND teams_in_competition.category_id = slot.category_id AND slot.status='approved'");
        if($query->num_rows()>0)
                return $query->row()->count;
        return false;        
    }
    
    public function getTeamNameViaCode($code){
        $query = $this->db->query("select teams_in_competition.team_name from teams_in_competition inner join slot on teams_in_competition.teams_in_competition_id = slot.team_id where slot.code = '$code'");
        if($query->num_rows()>0)
            return $query->row()->team_name;
    }

    public function getTeamIDViaCode($code){
        $query = $this->db->query("select teams_in_competition.teams_in_competition_id from teams_in_competition inner join slot on teams_in_competition.teams_in_competition_id = slot.team_id where slot.code = '$code'");
        if($query->num_rows()>0)
            return $query->row()->teams_in_competition_id;
    }

        public function countPendingTeams($catID, $schoolID){
         $query = $this->db->query("select count(teams_in_competition.team_name) as count
                                    from teams_in_competition
                                    inner join slot on slot.team_id = teams_in_competition.teams_in_competition_id
                                    where teams_in_competition.category_id = $catID AND teams_in_competition.school_id = $schoolID AND teams_in_competition.category_id = slot.category_id AND slot.status='pending'");
        if($query->num_rows()>0)
                return $query->row()->count;
        return false;

        }

        public function getMembersInTeam($teamID){
            $query = $this->db->query("SELECT concat(' ', participant.first_name, ' ', participant.last_name) as Name, photos.file_name, photos.participant_id
                                        from participant 
                                        inner join teams_members on teams_members.participant_id = participant.participant_id
                                        inner join photos on photos.participant_id = participant.participant_id
                                        where teams_members.team_id = $teamID");
            return $query;
        }

        public function getCode($catID, $teamID){
            $query = $this->db->query("SELECT code FROM slot where category_id = $catID AND team_id = $teamID");
            return $query->row()->code;
        }

        public function getSchoolEmail($teamID){
            $query = $this->db->query("select email from school inner join teams_in_competition on teams_in_competition.school_id = school.school_id WHERE teams_in_competition.teams_in_competition_id = $teamID");
            return $query->row()->email;
        }

        public function getSchoolNamebyTeamID($teamID){
            $query = $this->db->query("SELECT school.school_name 
                                        FROM school
                                        INNER JOIN team on team.school_id = school.school_id
                                        WHERE team.team_id = $teamID");
            return $query->row()->school_name;
        }

        public function getSchoolNamebySchoolID($teamID){
            $query = $this->db->query("SELECT school.school_name 
                                        FROM school
                                        WHERE school.school_id = $teamID");
            return $query->row()->school_name;
        }

        public function getDirectorIDofCat($catID){
            $query = $this->db->query("SELECT director.director_id
                                        FROM director
                                        INNER JOIN competition on competition.director_id = director.director_id
                                        INNER JOIN category on competition.competition_id = category.competition_id
                                        WHERE category.category_id = $catID");
            return $query->row()->director_id;
        }

        public function getParticipantEmail($teamID){
            $query = $this->db->query("select email from participant 
                                    inner join participants_in_competition on participants_in_competition.participant_id = participant.participant_id
                                    inner join teams_in_competition on participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id 
                                    where teams_in_competition.teams_in_competition_id = $teamID");
            return $query;
        }

        public function regSchool($code, $id){
            $query = $this->db->query("select slot.category_id from slot 
                            inner join teams_in_competition on slot.team_id = teams_in_competition.teams_in_competition_id INNER JOIN school on teams_in_competition.school_id = school.school_id where slot.code = '$code' && slot.status = 'pending' && school.school_id = $id");
            if($query->num_rows() > 0){
                $this->db->set('status', 'approved');
                $this->db->where('code', $code);
                $this->db->update('slot');
                return "true";
            }
            return "false";
               
        }

        public function getTeamName($code){
            $query = $this->db->query("select team.team_name FROM team INNER JOIN slot on slot.team_id = team.team_id WHERE slot.code = $code");
            return $query;
        }

        public function displayPendingCat($compID){
            $query = $this->db->query("select DISTINCT category.* from category inner join competition on category.competition_id = competition.competition_id inner join slot on category.category_id = slot.category_id where slot.status = 'pending' AND competition.competition_id = $compID");
            if($query->num_rows() > 0)
                return $query;
        }

        public function displayMembersApplying($teamID){
                //             select b.file_name, c.team_id, a.participant_id, a.Name 
                // from participants_in_competition a
                // inner join teams_in_competition c on c.teams_in_competition_id = a.teams_in_competition_id
                // inner join photos b on a.participant_id = b.participant_id
                // where c.teams_in_competition_id = 27
            $this->db->select('b.file_name, c.team_id, a.participant_id, a.Name, c.teams_in_competition_id as team_id')->from('participants_in_competition a')->join('teams_in_competition c', 'c.teams_in_competition_id = a.teams_in_competition_id', 'INNER JOIN')->join('photos b', 'a.participant_id = b.participant_id', 'LEFT OUTER')->where('c.teams_in_competition_id', $teamID);
            return $this->db->get();
        }

        public function displayPendingTeamsInCat($catID){
            $query = $this->db->query("SELECT teams_in_competition.*, school.school_name, slot.*
                                        FROM teams_in_competition
                                        inner join slot on slot.team_id = teams_in_competition.teams_in_competition_id
                                        inner join school on teams_in_competition.school_id = school.school_id
                                        WHERE slot.category_id = $catID");
            if($query->num_rows() >0)
                return $query;
        }

        public function getTeamNamebyTeamIDReal($teamID){
            $query = $this->db->query("SELECT team_name from team WHERE team_id = $teamID");
            return $query->row()->team_name;
        }


        public function getTeamNamebyTeamID($teamID){
            $query = $this->db->query("SELECT team_name from teams_in_competition WHERE teams_in_competition.teams_in_competition_id = $teamID");
            return $query->row()->team_name;
        }

        public function checkIfMembersHaveMatri($teamID){
            $query = $this->db->query("SELECT photos.* FROM photos 
                                        inner join participants_in_competition on photos.participant_id = participants_in_competition.participant_id 
                                        inner join teams_in_competition on participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id 
                                        where teams_in_competition.teams_in_competition_id = $teamID");
            if($query->num_rows() > 0)
                return true;
        }

         public function checkIfRequiresPayment($catID){
            $query = $this->db->query("SELECT payment FROM category where category_id = '$catID' AND payment = 'Yes'");
            if($query->num_rows() > 0)
                return true;
            return false;
        }

         public function displayApprovedParticipantsInComp($id){
            if($this->session->userdata('status')=='director' || $this->session->userdata('status')=='Secretariat Committee'){
                $query = $this->db->query("select DISTINCT participants_in_competition.Name, competition.competition_name, competition.start_date, competition.end_date, DATE_FORMAT(`start_date`,'%M %d, %Y') as date, teams_in_competition.team_name


                    from participants_in_competition

                    INNER JOIN teams_in_competition ON participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id
                    INNER JOIN competition ON teams_in_competition.competition_id = competition.competition_id 
                    WHERE competition.competition_id = $id AND participants_in_competition.attend = 'yes' ");
                return $query;
            }
         }

         public function displayAvailableComp($ID, $status){
            if($status=='school'){
                $this->db->select('competition_name, start_date, end_date');
                $this->db->from('competition');
                $this->db->where('start_date >=', date("Y/m/d") );
                $query= $this->db->get();
                return $query;

            }
         }

          public function displayCompByCompID($ID, $status){
            if($status=='director'){
                $this->db->select('*');
                $this->db->from('competition');
                $this->db->where('competition_id', $ID);
                $query= $this->db->get();
                return $query;
            }
         }

         public function editCatName($catID, $CatName){
        
                $data = array(
                'category_name' => $CatName
                );

                $this->db->where('category_id', $catID);
                $this->db->update('category', $data);
         }

        public function sentEmailIdentifier($code){
        
                $data = array(
                'email_sent' => 'Yes'
                );

                $this->db->where('code', $code);
                $this->db->update('slot', $data);
         }

         public function checkCategories($name, $compID){
            
                $this->db->select('*');
                $this->db->from('category');
                $this->db->where('competition_id', $compID);
                $this->db->where('category_name', $name);
                $query= $this->db->get();
                if($query->num_rows()>=1)
                    return true;
                return false;
            
         }


         public function displayCat($wew){
            //$this->db->select('competition_id');
           // $this->db->from('competition');
            //$this->db->where('competition_name', $wew);
            //$aw = $this->db->get();

            //$this->db->select('*');
            //$this->db->from('category');
            //$this->db->where('competition_id', $aw);
            //$query= $this->db->get();

            $query = $this->db->query("SELECT category.*, competition.* FROM category INNER JOIN competition ON category.competition_id = competition.competition_id WHERE competition.competition_name = '$wew'");
                
                return $query;
         }

         public function displayCatForScoreboard($compID){
            // $query = $this->db->query("select competition_scoreboard.*, category.*
            //                             from category 
            //                             LEFT OUTER JOIN
            //                             competition_scoreboard on category.category_id = competition_scoreboard.category_id
            //                             inner join competition on category.competition_id = competition.competition_id
            //                             where competition.competition_id = $compID");
            $query = $this->db->query("select category.*, competition_scoreboard.file_name
                                        from category 
                                        inner join competition on category.competition_id = competition.competition_id
                                        left outer join competition_scoreboard on competition_scoreboard.competition_id = competition.competition_id AND competition_scoreboard.category_id = category.category_id
                                        where competition.competition_id = $compID");
            return $query;
         }

        public function displayCatApproved($wew, $SchoolID){
            //$this->db->select('competition_id');
           // $this->db->from('competition');
            //$this->db->where('competition_name', $wew);
            //$aw = $this->db->get();

            //$this->db->select('*');
            //$this->db->from('category');
            //$this->db->where('competition_id', $aw);
            //$query= $this->db->get();

            $query = $this->db->query(" SELECT DISTINCT category.* 
                                        FROM category 
                                        INNER JOIN competition ON category.competition_id = competition.competition_id
                                        INNER JOIN slot ON category.category_id = slot.category_id
                                        INNER JOIN teams_in_competition ON teams_in_competition.teams_in_competition_id = slot.team_id
                                        INNER JOIN school on teams_in_competition.school_id = school.school_id
                                        WHERE competition.competition_name = '$wew' && slot.status = 'approved' AND school.school_id = $SchoolID ");
                
                return $query;
         }

         public function getTeamsInCompID($teamArray){

            $TeamName = $teamArray['team_name'];
            $CompID = $teamArray['competition_id'];
            $CatID = $teamArray['category_id'];
            $TeamID = $teamArray['team_id'];

            $query = $this->db->query("SELECT teams_in_competition_id FROM teams_in_competition WHERE team_id = $TeamID AND team_name = '$TeamName' AND competition_id = $CompID  AND category_id = $CatID");
            return $query->row()->teams_in_competition_id;
            
         }

         public function checkIfAlreadyInComp($teamArray){

            $TeamName = $teamArray['team_name'];
            $CompID = $teamArray['competition_id'];
            $CatID = $teamArray['category_id'];
            $TeamID = $teamArray['team_id'];

            $query = $this->db->query("SELECT teams_in_competition_id FROM teams_in_competition WHERE team_id = $TeamID AND team_name = '$TeamName' AND competition_id = $CompID  AND category_id = $CatID");

            if($query->num_rows()>0)
                return true;
            else
                return false;
         }

        public function displayCatByID($wew){
            //$this->db->select('competition_id');
           // $this->db->from('competition');
            //$this->db->where('competition_name', $wew);
            //$aw = $this->db->get();

            //$this->db->select('*');
            //$this->db->from('category');
            //$this->db->where('competition_id', $aw);
            //$query= $this->db->get();

            $query = $this->db->query("SELECT category.*, competition.* FROM category INNER JOIN competition ON category.competition_id = competition.competition_id WHERE competition.competition_id = '$wew'");
                
                return $query;
         }

       

         public function displayEditCat($wew){
            $query = $this->db->query("SELECT * FROM category WHERE category_id = '$wew'");
            return $query;
         }

         public function displayCatUsingCompID($wew){


            $query = $this->db->query("SELECT category.*, competition.* FROM category INNER JOIN competition ON category.competition_id = competition.competition_id WHERE competition.competition_id = '$wew'");
                
                return $query;
         }

         public function deleteComp($wew){ 
            $id = $this->db->query("SELECT competition_id FROM competition WHERE competition_name = '$wew' ");
            $query2 = $this->db->query("DELETE w FROM category w INNER JOIN competition e ON w.competition_id=e.competition_id WHERE e.competition_name = '$wew'");
            $query = $this->db->query("DELETE FROM `competition` WHERE `competition`.`competition_name` = '$wew' ");
         }

         public function deleteCat($wew){
            $query = $this->db->query("DELETE FROM `category` WHERE `category`.`category_id` = '$wew' ");
         }

         public function deleteSlot($catID, $teamID){
            $query = $this->db->query("DELETE FROM `slot` WHERE `slot`.`category_id` = '$catID' && `slot`.`team_id` = '$teamID'");
            $query = $this->db->query("DELETE FROM participants_in_competition WHERE teams_in_competition_id = $teamID");
            $query = $this->db->query("DELETE FROM teams_in_competition WHERE category_id = $catID AND teams_in_competition_id = $teamID");
         }

        public function displayTeams($wew2){

            $query = $this->db->query("SELECT slot.*, teams_in_competition.team_name , school.school_name
                        FROM slot 
                        INNER JOIN teams_in_competition ON slot.team_id = teams_in_competition.teams_in_competition_id
                        INNER JOIN school ON school.school_id = teams_in_competition.school_id 
                        WHERE slot.category_id = $wew2");

            
            if($query->num_rows() > 0){
                    $query = $this->db->query("SELECT slot.*, teams_in_competition.team_name , school.school_name, GROUP_CONCAT(participants_in_competition.Name) AS Members
                        FROM slot 
                        INNER JOIN teams_in_competition ON slot.team_id = teams_in_competition.teams_in_competition_id
                        INNER JOIN participants_in_competition ON participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id
                        INNER JOIN school ON school.school_id = teams_in_competition.school_id WHERE slot.category_id = $wew2");
                    return $query;
            }
            else
                    return 'nothing';
         }

         public function InviteIndividual($params=array()){

            // $this->db->select("GROUP_CONCAT(concat(' ', a.first_name, ' ', a.last_name)) AS Name, 
            //     count(concat(' ', a.first_name, ' ', a.last_name)) as MembersCount, 
            //     c.team_name, c.team_id,
            //     d.school_name, 
            //     concat(' ', e.first_name,' ', e.last_name) As Coach");
            // $this->db->from('participant a ');
            // $this->db->join('teams_members b', 'b.participant_id = a.participant_id', 'inner');
            // $this->db->join('team c', 'c.team_id = b.team_id', 'INNER');
            // $this->db->join('coach e', 'b.coach_id = e.coach_id', 'left outer');
            // $this->db->join('school d', 'd.school_id = c.school_id', 'inner');
            // $this->db->group_by('c.team_id');
            // $this->db->having('MembersCount = 1');

            $this->db->select("*");
            $this->db->from('school a');
            // $this->db->join('teams_members b', 'b.participant_id = a.participant_id', 'inner');
            // $this->db->join('team c', 'c.team_id = b.team_id', 'INNER');
            // $this->db->join('coach e', 'b.coach_id = e.coach_id', 'left outer');
            // $this->db->join('school d', 'd.school_id = c.school_id', 'inner');
            // $this->db->group_by('c.team_id');
            // $this->db->having('MembersCount = 1');
                    //filter data by searched keywords


            if(!empty($params['searchKeyword'])){
                $this->db->like('competition_name',$params['searchKeyword']);
                $this->db->or_like("DATE_FORMAT(start_date, '%M %e, %Y')",$params['searchKeyword']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }
            else{
                if(array_key_exists("id", $params)){
                    $this->db->where('id', $params['id']);
                    $query = $this->db->get();
                    $result = $query->row_array();
                }else{
                    $this->db->order_by('school_name', 'asc');
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                    }
                    
                    $query = $this->db->get();
                    $result = ($query->num_rows() > 0)?$query->result_array():'nothing';
                }
            }
            return $result;

            // $query = $this->db->query("
            //     select GROUP_CONCAT(concat(' ', a.first_name, ' ', a.last_name)) AS Name, 
            //     count(concat(' ', a.first_name, ' ', a.last_name)) as MembersCount, 
            //     c.team_name, c.team_id,
            //     d.school_name, 
            //     concat(' ', e.first_name,' ', e.last_name) As Coach 
            //     from participant a 
            //     inner join teams_members b on a.participant_id = b.participant_id 
            //     inner join team c on c.team_id = b.team_id 
            //     left outer join coach e on b.coach_id = e.coach_id 
            //     inner join school d on d.school_id = c.school_id 
            //     group by c.team_id 
            //     having MembersCount = 1 ");
            // if($query->num_rows() > 0){
            //     return $query;
            // }
            // return 'nothing';
         }



            public function displayTeamz($wew2){

            $query = $this->db->query("SELECT slot.*, teams_in_competition.team_name , school.school_name
                        FROM slot 
                        INNER JOIN teams_in_competition ON slot.team_id = teams_in_competition.teams_in_competition_id
                        INNER JOIN school ON school.school_id = teams_in_competition.school_id 
                        WHERE slot.category_id = $wew2
                        GROUP BY teams_in_competition.teams_in_competition_id");

            
            if($query->num_rows() > 0){
                    $query = $this->db->query("SELECT slot.*, teams_in_competition.team_name , school.school_name, GROUP_CONCAT(participants_in_competition.Name) AS Members
                        FROM slot 
                        INNER JOIN teams_in_competition ON slot.team_id = teams_in_competition.teams_in_competition_id
                        INNER JOIN participants_in_competition ON participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id
                        INNER JOIN school ON school.school_id = teams_in_competition.school_id WHERE slot.category_id = $wew2
                        GROUP BY teams_in_competition.teams_in_competition_id");
                    return $query;
            }
            else
                    return 'nothing';
         }

         public function getCompWithParticipants($ID){
            $query = $this->db->query("SELECT distinct competition.*
                                        FROM competition
                                        INNER JOIN category on competition.competition_id = category.competition_id
                                        inner join slot on slot.category_id = category.category_id
                                        inner join teams_in_competition on slot.team_id = teams_in_competition.teams_in_competition_id
                                        inner join participants_in_competition on participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id
                                        where competition.director_id = $ID");

            if($query->num_rows()>0)
                return $query;
            else
                return "nothing";

         }

         public function getCompsWithParticipants($params=array()){
            $id = $params['DirectorID'];
            // $query = $this->db->query("SELECT distinct competition.*
            //                             FROM competition
            //                             INNER JOIN category on competition.competition_id = category.competition_id
            //                             inner join slot on slot.category_id = category.category_id
            //                             inner join teams_in_competition on slot.team_id = teams_in_competition.teams_in_competition_id
            //                             inner join participants_in_competition on participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id
            //                             where competition.director_id = '$id'");
            $this->db->distinct();
            $this->db->select("a.competition_id, a.competition_name, a.director_id, DATE_FORMAT(a.start_date, '%M %e, %Y') as start_date");
            $this->db->from('competition a');
            $this->db->join('category b', 'a.competition_id = b.competition_id', 'INNER');
            $this->db->join('slot c', 'c.category_id = b.category_id', 'INNER');
            $this->db->join('teams_in_competition d', 'c.team_id = d.teams_in_competition_id', 'INNER');
            $this->db->join('participants_in_competition e', 'd.teams_in_competition_id = e.teams_in_competition_id', 'INNER');
            $this->db->where('director_id', $id);
            $this->db->order_by('start_date', 'desc');
            //filter data by searched keywords


            if(!empty($params['searchKeyword'])){
                $this->db->like('competition_name',$params['searchKeyword']);
                $this->db->or_like("DATE_FORMAT(start_date, '%M %e, %Y')",$params['searchKeyword']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }
            else{
                if(array_key_exists("DirectorID", $params)){
                    // $this->db->where('director_id', $params['DirectorID']);
                    $query = $this->db->get();
                    $result = $query->row_array();
                    return $query;
                }else{
                    $this->db->order_by('start_date', 'desc');
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                    }
                    
                    $query = $this->db->get();
                    $result = ($query->num_rows() > 0)?$query:FALSE;
                }
            }
            return $result;
        }

        public function displaySchoolTeams($wew2){
         
            $query = $this->db->query("SELECT * FROM `team` WHERE school_id = '$wew2' ");
            return $query;
         }

        public function insertComp($user){
            $this->db->insert('competition', $user);
        }

        public function insertParticipantInComp($team){
            $this->db->insert('participants_in_competition', $team);
        }

        public function regTeamToComp($team){
            $this->db->insert('teams_in_competition', $team);
        }

        public function getCompIDofCode($code){
            $query = $this->db->query("SELECT competition.competition_id FROM competition INNER JOIN category on competition.competition_id = category.competition_id INNER JOIN slot on category.category_id = slot.category_id WHERE slot.code = '$code'");
            return $query->row()->competition_id;
        }

        public function getCatIDbyCode($code){
            $query = $this->db->query("SELECT category_id FROM slot WHERE code = '$code' ");
            return $query->row()->category_id;
        }

        public function getCompID($name){
            $this->db->select('competition_id');
            $this->db->from('competition');
            $this->db->where('competition_name', $name);
            return $this->db->get()->row()->competition_id;
        }

        public function getCategory($catID){
            $query = $this->db->query("SELECT * FROM category WHERE category_id = $catID");
            return $query;
        }

        public function getCompNamebyCatID($catID){
            $query = $this->db->query("SELECT competition.competition_name from competition INNER JOIN category ON competition.competition_id = category.competition_id WHERE category.category_id = '$catID'");
            return $query->row()->competition_name;
        }

        public function getTeamWinners($catID){
            $query = $this->db->query("SELECT teams_in_competition.team_name, participants_in_competition.Name, team_competition_winners.rank
                                        FROM team_competition_winners 
                                        inner join competition_scoreboard on competition_scoreboard.competition_scoreboard_id = team_competition_winners.competition_scoreboard_id 
                                        inner join teams_in_competition on teams_in_competition.team_name = team_competition_winners.team_name 
                                        inner join participants_in_competition on teams_in_competition.teams_in_competition_id = participants_in_competition.teams_in_competition_id 
                                        where competition_scoreboard.category_id = $catID AND team_competition_winners.rank < 4
                                        order by rank ASC
                                        ");
            if($query->num_rows()>0)
                return $query->result_array();
            return false;
        }

        public function getCatNameCompNameAndDate($catID){
            $query = $this->db->query("select category.category_name, competition.competition_name, competition.end_date
                                        from category
                                        inner join competition on competition.competition_id = category.competition_id
                                        where category.category_id = $catID");
            if($query->num_rows()>0)
                return $query->result_array();
            return false;
        }

        public function getCompDateByCompID($compID){
            $query = $this->db->query("select start_date, end_date
                                        from competition 
                                        where competition_id = $compID");
            if($query->num_rows()>0)
                return $query->row()->start_date;
            return false;
        }

        public function getCatNamebyCatID($catID){
            $query = $this->db->query("SELECT category.category_name from category WHERE category.category_id = '$catID'");
            return $query->row()->category_name;
        }

        public function getCompIDbyCatID($catID){
            $query = $this->db->query("SELECT competition.competition_id from competition INNER JOIN category ON competition.competition_id = category.competition_id WHERE category.category_id = '$catID'");
            return $query->row()->competition_id;
        }

        public function getCompNamebyCompID($compID){
            $query = $this->db->query("SELECT competition_name from competition where competition_id = '$compID'");
            return $query->row()->competition_name;
        }

        public function getCompNameAndDate($compID){
            $query = $this->db->query("SELECT competition_name, end_date from competition where competition_id = '$compID'");
            return $query->result_array();

        }
        
        public function getCatID($compid){
            $this->db->select('category_id');
            $this->db->from('category');
            $this->db->where('competition_id', $compid);
            return $this->db->get();
        }

        public function getCatIDofCode($code){
            $this->db->select('category_id');
            $this->db->from('slot');
            $this->db->where('code', $code);
            return $this->db->get();
        }

        public function countCat($compID){
            $this->db->select('count(category_id) AS count');
            $this->db->from('category');
            $this->db->where('competition_id', $compID);
            return $this->db->get()->row()->count;
        }
        public function addCategory($compid){
            $this->db->select('category_id');
            $this->db->from('category');
            $this->db->where('competition_id', $compid);
            return $this->db->get();
        }

        public function insertCat($cat){
            $this->db->insert('category', $cat);
        }

        public function insertPartInComp($memberName){
            $this->db->insert('participants_in_competition', $memberName);
        }

        public function insertSlot($slot){
            $this->db->insert('slot', $slot);
        }

        public function checkCodes($code){
            $this->db->select('*');
            $this->db->from('slot');
            $this->db->where('code', $code);
            $query = $this->db->get();
            if($query->num_rows()>0)
                return true;
        }

        public function checkCodesApproval($code){
            $this->db->select('*');
            $this->db->from('admin_approve');
            $this->db->where('code', $code);
            $query = $this->db->get();
            if($query->num_rows()>0)
                return true;
        }

        public function checkCodesComp($code){
            $this->db->select('*');
            $this->db->from('competition');
            $this->db->where('code', $code);
            $query = $this->db->get();
            if($query->num_rows()>0)
                return true;
        }

        public function checkTeamIfPending($TeamID, $CatID){
            $query = $this->db->query("SELECT * FROM SLOT WHERE CATEGORY_ID = '$CatID' AND TEAM_ID = '$TeamID' AND Status = 'pending'");
            if($query->num_rows()>0)
                return true;
            return false;
        }

                public function checkTeamIfApproved($TeamID, $CatID){
            $query = $this->db->query("SELECT * FROM SLOT WHERE CATEGORY_ID = '$CatID' AND TEAM_ID = '$TeamID' AND Status = 'approved'");
            if($query->num_rows()>0)
                return true;
            return false;
        }

        public function checkTeamIfApprovedInComp($TeamID, $CompID){
            $query = $this->db->query("SELECT slot.team_id, slot.status FROM slot, category, competition WHERE slot.category_id = category.category_id AND category.competition_id = $CompID AND slot.team_id = $TeamID AND slot.status='approved'");
            if($query->num_rows()>0)
                return true;
            return false;
        }

    
        public function checkTeamIfPendingInComp($TeamID, $CompID){
            $query = $this->db->query("SELECT slot.team_id, slot.status FROM slot, category, competition WHERE slot.category_id = category.category_id AND category.competition_id = $CompID AND slot.team_id = $TeamID AND slot.status= 'pending'");
            if($query->num_rows()>0)
                return true;
            return false;
        }

        public function checkTeamIfPendingInCat($catID, $teamID){
            $query = $this->db->query("select team.team_name, participant.first_name
                                        from team
                                        inner join teams_members on teams_members.team_id = team.team_id
                                        inner join participant on teams_members.participant_id = participant.participant_id
                                        inner join teams_in_competition on teams_in_competition.team_id = team.team_id
                                        inner join slot on teams_in_competition.teams_in_competition_id = slot.team_id
                                        where slot.status = 'pending' AND slot.category_id = $catID AND teams_in_competition.team_id = $teamID");
            if($query->num_rows()>0)
                return 'true';
            return false;
        }


        public function getCompWithPending($ID){
            $query = $this->db->query("select DISTINCT competition.* 
                                       FROM competition
                                       inner join category on competition.competition_id = category.competition_id 
                                       inner join slot on slot.category_id = category.category_id
                                       where slot.status = 'pending' && competition.director_id = '$ID' ");
            if($query->num_rows()>0)
                return $query;
            return false;
        }

        public function getCompWithPendingNew($ID){
            $query = $this->db->query("select DISTINCT competition.* 
                                       FROM competition
                                       inner join category on competition.competition_id = category.competition_id 
                                       inner join slot on slot.category_id = category.category_id
                                       where slot.status = 'pending' && competition.director_id = '$ID' && competition.start_date >= CURRENT_DATE");
            if($query->num_rows()>0)
                return $query;
            return false;
        }

        public function getCompsWithPending($params=array()){
            $this->db->distinct();
            $this->db->select("a.competition_id, a.competition_name, DATE_FORMAT(a.start_date, '%M %e, %Y') as start_date, DATE_FORMAT(a.end_date, '%M %e, %Y') as end_date, a.director_id");
            $this->db->from('competition a');
            $this->db->join('category b', 'b.competition_id = a.competition_id', 'INNER');
            $this->db->join('slot c', 'b.category_id = c.category_id', 'INNER');
            $this->db->where('c.status', 'pending');
            $this->db->where('a.director_id', $this->session->userdata('id'));
            $this->db->where('a.start_date >= CURDATE()');

                    //filter data by searched keywords


            if(!empty($params['searchKeyword'])){
                $this->db->like('competition_name',$params['searchKeyword']);
                $this->db->or_like("DATE_FORMAT(start_date, '%M %e, %Y')",$params['searchKeyword']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();
            }
            else{
                if(array_key_exists("id", $params)){
                    $this->db->where('id', $params['id']);
                    $query = $this->db->get();
                    $result = $query->row_array();
                }else{
                    $this->db->order_by('start_date', 'asc');
                    if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit'],$params['start']);
                    }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                        $this->db->limit($params['limit']);
                    }
                    
                    $query = $this->db->get();
                    $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
                }
            }
            return $result;
        }



        public function getFilenameOfTeamInCat($catID, $teamID){
            $query = $this->db->query("SELECT payment from slot where category_id = $catID AND team_id = $teamID");
            if($query->num_rows()>0)
                return $query->row()->payment;
            return false;
        }

        public function countPendingInAllComp($directorID){
            $query = $this->db->query("select count(slot.status) as count
                                       FROM competition
                                       inner join category on competition.competition_id = category.competition_id 
                                       inner join slot on slot.category_id = category.category_id
                                       where slot.status = 'pending' && competition.director_id = '$directorID' ");
            if($query->num_rows()>0)
                return $query->row()->count;
            return false;
        }

        public function checkInvite($schoolID, $compID){
            $query = $this->db->query("SELECT * FROM invites WHERE school_id = $schoolID AND competition_id = $compID");
            if($query->num_rows()>0)
                return true;
            return false;
        }

        public function sendInvite($schoolID, $compID){
            $this->db->query("INSERT INTO invites (school_id, competition_id) VALUES ('$schoolID', '$compID')");
        }

        public function countPendingInCompNotSentEmail($directorID){

            //date_default_timezone_set('Asia/Manila');
            //$date = date('yyyy-mm-dd');

            $query = $this->db->query("select distinct count(slot.status) as count
                                       FROM competition
                                       inner join category on competition.competition_id = category.competition_id 
                                       inner join slot on slot.category_id = category.category_id
                                       where slot.status = 'pending' AND slot.email_sent = '' && competition.director_id = '$directorID' && competition.end_date >= curdate()");
            if($query->num_rows()>0)
                return $query->row()->count;
            return false;
        }

        public function countPendingInCompWithSentEmail($compID){
            $query = $this->db->query("select COUNT(*) as count
                                    FROM competition
                                    inner join category on competition.competition_id = category.competition_id
                                    inner join slot on slot.category_id = category.category_id
                                    where slot.status = 'pending' AND slot.email_sent = 'Yes' AND competition.competition_id = $compID");
            if($query->num_rows()>0)
                return $query->row()->count;
            return false;
        }


        public function countPendingInComp($compID){
            $query = $this->db->query("select count(slot.status) as count
                                       FROM competition
                                       inner join category on competition.competition_id = category.competition_id 
                                       inner join slot on slot.category_id = category.category_id
                                       where slot.status = 'pending' AND slot.email_sent='' && competition.competition_id = $compID");
            if($query->num_rows()>0)
                return $query->row()->count;
            return false;
        }

        public function countPendingInCat($catID){
            $query = $this->db->query("select COUNT(*) as count
                                    FROM category
                                    inner join slot on slot.category_id = category.category_id
                                    where slot.status = 'pending' AND slot.email_sent = '' AND category.category_id = '$catID'");
            if($query->num_rows()>0)
                return $query->row()->count;
            return false;
        }

        public function countPendingInCatEmailSent($catID){
            $query = $this->db->query("select COUNT(*) as count
                                    FROM category
                                    inner join slot on slot.category_id = category.category_id
                                    where slot.status = 'pending' AND slot.email_sent = 'Yes' AND category.category_id = '$catID'");
            if($query->num_rows()>0)
                return $query->row()->count;
            return false;
        }

        public function AcceptRequest($TeamID, $CatID){
            //UPDATE Customers SET ContactName = 'Alfred Schmidt', City= 'Frankfurt' WHERE CustomerID = 1;
            //$query = $this->db->query("UPDATE slot SET status = 'approved' WHERE category_id = '$CatID' AND team_id = '$TeamID'");
            //$this->db->replace('table', $data);
            $data = array(
                'status' => "approved"
            );

            $this->db->where('category_id', $CatID);
            $this->db->where('team_id', $TeamID);
            $this->db->update('slot', $data);
            //$this->db->set('status', "approved");
            //$this->db->where('team_id','category_id', $TeamID, $CatID);
            //$this->db->update('slot');
        }

        public function updateCatName($CatID, $newName, $catType, $catpayment){
            
            $data = array(
                'category_name' => $newName,
                'category_type' => $catType,
                'payment' => $catpayment
            );

            $this->db->where('category_id', $CatID);
            $this->db->update('category', $data);
            
        }

        public function editCompName($newCompName, $compID){

            $data = array(
                'competition_name' => $newCompName
            );
            $this->db->where('competition_id', $compID);
            $this->db->update('competition', $data);
        }

        public function editStartDate($newStart, $compID){

            $data = array(
                'start_date' => $newStart
            );
            $this->db->where('competition_id', $compID);
            $this->db->update('competition', $data);
        }

        public function editEndDate($newEnd, $compID){

            $data = array(
                'end_date' => $newEnd
            );
            $this->db->where('competition_id', $compID);
            $this->db->update('competition', $data);   
        }

        public function DeclineRequest($TeamID, $CatID){
            // $data = array(
            //     'status' => "pending"
            // );

            // $this->db->where('category_id', $CatID);
            // $this->db->where('team_id', $TeamID);
            // $this->db->update('slot', $data);

            //ANG NASA TAAS DECLINE

            $query=$this->db->query("DELETE from slot WHERE team_id = $TeamID AND category_id = $CatID");
           }

        public function getCompIDFromScoreboard($catID){

            $query = $this->db->query("SELECT competition_scoreboard_id FROM competition_scoreboard WHERE category_id= $catID"); 
                return $query->row()->competition_scoreboard_id;

        }
    }
?>