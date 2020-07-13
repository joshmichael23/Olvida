<?php
class notification extends CI_Model{

        public function __construct() 
        {
           parent::__construct(); 
           $this->load->database();
        }
       
       public function getSchoolIDsInCat($catID){
        $query = $this->db->query("SELECT DISTINCT(school.school_id) FROM category INNER JOIN slot on slot.category_id = category.category_id INNER join teams_in_competition on slot.team_id = teams_in_competition.teams_in_competition_id inner join participants_in_competition on participants_in_competition.teams_in_competition_id = teams_in_competition.teams_in_competition_id inner join school on school.school_id = teams_in_competition.school_id where category.category_id = $catID");
        return $query;
       }

       public function insertNotification($notification){
            $this->db->insert("notifications",$notification);
            $query = $this->db->insert_id();
            return $query;
       }

       public function sendNotificationSchool($ID, $notifID){
        $query = $this->db->query("INSERT INTO school_notifications (notifications_id, target_id, status) VALUES ($notifID, $ID, '0')");
       }

       public function sendNotificationDirector ($ID, $notifID){
        $query = $this->db->query("INSERT INTO director_notifications (notifications_id, target_id, status) VALUES ($notifID, $ID, '0')");
       }

       public function deleteTeams($catID){
        $query = $this->db->query("DELETE a, b, c
                                    FROM slot a 
                                    inner join teams_in_competition b on b.teams_in_competition_id = a.team_id
                                    inner join participants_in_competition c on c.teams_in_competition_id = b.teams_in_competition_id
                                    where a.category_id = $catID");
       }

       public function getDirectorIDofCat($catID){
        $query = $this->db->query("SELECT director.director_id from director 
                                inner join competition on competition.director_id = director.director_id
                                inner join category on category.competition_id = competition.competition_id
                                where category.category_id = $catID");
        return $query;
                               
       }

      public function getSchoolIDofTeam($teamID){
           $query = $this->db->query("select school.school_id from school inner join teams_in_competition on teams_in_competition.school_id = school.school_id WHERE teams_in_competition.teams_in_competition_id = $teamID");
            return $query->row()->school_id;
        return $query;
                               
       }

        public function clearNotificationSchool($SchoolID){
        $query = $this->db->query("UPDATE school_notifications SET school_notifications.status = 1
                                    WHERE school_notifications.target_id = $SchoolID");
        return $query;
                               
       }

        public function clearNotificationDirector($directorID){
        $query = $this->db->query("UPDATE director_notifications SET director_notifications.status = 1
                                    WHERE director_notifications.target_id = $directorID");
        return $query;
                               
       }
    }
?>