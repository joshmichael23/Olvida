<?php
    class Connect_Db extends CI_Model{

        public function __construct() 
     {
           parent::__construct(); 
           $this->load->database();
     }

        public function login($user,$pass){
            $this->db->select('*');
            $this->db->from('director');
            $this->db->where('username',$user);
            $this->db->where('password',$pass);
            $query = $this->db->get();

            if($query->num_rows()==1)
                return true;

            else if($query->num_rows()==0){

                $this->db->select('*');
                $this->db->from('school');
                $this->db->where('user',$user);
                $this->db->where('pass',$pass);
                $query = $this->db->get();

                if($query->num_rows()==1)
                    return true;

            }

            return false;
        }

        public function submitDirectorChanges($id, $email, $contactno, $password){
            $query = $this->db->query("UPDATE director SET email = '$email', contact_no = '$contactno', password = '$password' WHERE director_id = $id");
        }

        public function submitSchoolChanges($id, $email, $password){
            $query = $this->db->query("UPDATE school SET email = '$email', pass = '$password' WHERE school_id = $id");
        }

        public function getCode($id, $role){

                $query = $this->db->query("SELECT code FROM admin_approve WHERE target_id = $id AND role = '$role'");
                return $query->row()->code;               
            
        }

        public function getEmail($id, $role){

                if($role=='director'){
                    $query = $this->db->query("SELECT director.email FROM admin_approve 
                                                INNER JOIN director ON admin_approve.target_id = director.director_id
                                                WHERE director.director_id = $id");
                    return $query->row()->email;               
                }
                else{
                    $query = $this->db->query("SELECT school.email FROM admin_approve 
                                                INNER JOIN school ON admin_approve.target_id = school.school_id
                                                WHERE school.school_id = $id");
                    return $query->row()->email;     
                }
        }

        public function getDirectorName($id){
            // SELECT CONCAT(first_name, ' ' ,last_name) AS 'Whole Name'
            // FROM director
            // WHERE director_id = 2

            $this->db->select('CONCAT(first_name, " ", last_name) AS whole');
            $this->db->from('director');
            $this->db->where('director_id', $id);
            $query = $this->db->get()->row()->whole;
            return $query;
        }

        public function enterCode($code){
            $this->db->query("UPDATE admin_approve SET status = 'approved' WHERE code = '$code'");

            $query = $this->db->query("SELECT * from admin_approve WHERE code = '$code'");
            if($query->num_rows()>0)
                return true;
            return false;
        }

        public function  getAccountDirector($id){
            $query = $this->db->query("SELECT * FROM director WHERE director_id = '$id'");
            return $query;
        }

        public function  getAccountSchool($id){
            $query = $this->db->query("SELECT * FROM school WHERE school_id = '$id'");
            return $query;
        }

        public function getSchoolName($id){
            // SELECT CONCAT(first_name, ' ' ,last_name) AS 'Whole Name'
            // FROM director
            // WHERE director_id = 2

            $this->db->select('school_name');
            $this->db->from('school');
            $this->db->where('school_id', $id);
            $query = $this->db->get()->row()->school_name;
            return $query;
        }

        public function checkDirectorIfApproved($id){
            $query = $this->db->query("SELECT * FROM admin_approve WHERE target_id = $id AND role = 'director' AND status = 'approved' ");
            if($query->num_rows()>0)
                return true;
            return false;

        }

        public function checkSchoolIfApproved($id){
            $query = $this->db->query("SELECT * FROM admin_approve WHERE target_id = $id AND role = 'school' AND status = 'approved' ");
            if($query->num_rows()>0)
                return true;
            return false;

        }

        public function checkSchoolORDirector($user, $pass){
            $this->db->select('*');
            $this->db->from('director');
            $this->db->where('username',$user);
            $this->db->where('password',$pass);
            $query = $this->db->get();//->row()->director_id;

            if($query->num_rows()==1){
                return "director";
            }

            else if($query->num_rows()==0){

                $this->db->select('*');
                $this->db->from('school');
                $this->db->where('user',$user);
                $this->db->where('pass',$pass);
                $query = $this->db->get();

                if($query->num_rows()==1)
                    return "school";
                else if($query->num_rows()==0)
                {

                   $aw = "select role from committee where username ='$user' AND password = '$pass' AND role = 'Technical Committee' ";
                   $query = $this->db->query($aw);
                   if($query->num_rows()>0)
                        return "Technical Committee";
                   else{
                      $aw2="select role from committee where username = '$user' AND password = '$pass' AND role = 'Secretariat Committee' ";
                      $query = $this->db->query($aw2);
                      if($query->num_rows()>0)
                          return "Secretariat Committee";
                      else{
                        $aw3 = "SELECT * from admin where username = '$user' AND password = '$pass'";
                        $query = $this->db->query($aw3);
                        if($query->num_rows()>0)
                            return "Admin";
                      }
                   }

                }

            }

            return "director ang error";
        }
        
        public function getDirectorIDofCom($user){
            $this->db->select('director_id');
            $this->db->from('committee');
            $this->db->where('username',$user);
            $query = $this->db->get()->row()->director_id;
            return $query;
        }

        

        public function getDirectorID($user){
            $this->db->select('director_id');
            $this->db->from('director');
            $this->db->where('username',$user);
            $query = $this->db->get()->row()->director_id;
            return $query;
        }

        public function getAdminID($user){
            $this->db->select('admin_id');
            $this->db->from('admin');
            $this->db->where('username',$user);
            $query = $this->db->get()->row()->admin_id;
            return $query;            
        }

          public function getSchoolID($user){
            $this->db->select('school_id');
            $this->db->from('school');
            $this->db->where('user',$user);
            $query = $this->db->get()->row()->school_id;
            return $query;
        }

        public function email_check($email){
 
            $this->db->select('*');
            $this->db->from('director');
            $this->db->where('email',$email);
            $query=$this->db->get();
     
            if($query->num_rows()>0){
                    return false;
            }
            else{
                    return true;
            }
        }

        public function username_check($username){
 
            $this->db->select('*');
            $this->db->from('director');
            $this->db->where('username',$username);
            $query=$this->db->get();
     
            if($query->num_rows()>0){
                    return false;
            }
            else{
                    return true;
            }
        }

        public function disapprove($role, $id){
            $this->db->query("DELETE FROM admin_approve WHERE role = '$role' AND target_id = $id");
            if($role='director')
                $this->db->query("DELETE FROM director WHERE director_id = '$id'");
            else
                $this->db->query("DELETE FROM school WHERE school_id = '$id'");
        }

        public function register_user($user){
                $this->db->insert('director', $user);
        }

        public function sentEmailFunc($id, $role){
            if($role=='director'){
                $this->db->query("UPDATE admin_approve SET status = 'yes' WHERE role = 'director' AND target_id = '$id'");
            }
            else{
                $this->db->query("UPDATE admin_approve SET status = 'yes' WHERE role = 'school' AND target_id = '$id'");
            }
        }

        public function countPendingRequest(){
                $query = $this->db->query("SELECT count(approval_id) as count FROM admin_approve WHERE status ='pending' ");
                if($query->num_rows()>0)
                    return $query->row()->count;
                return false;
        }

        public function PendingDirectorRequest(){
                $query = $this->db->query("SELECT admin_approve.sent_email, director.email, director.contact_no, admin_approve.status, admin_approve.target_id, CONCAT(' ', director.first_name, ' ', director.last_name) AS Name , admin_approve.role FROM admin_approve
                                        INNER JOIN director on admin_approve.target_id = director.director_id
                                        WHERE admin_approve.status = 'pending' ");
                if($query->num_rows()>0)
                    return $query;        
                return false; 
        }

        public function PendingSchoolRequest(){
                $query = $this->db->query("SELECT admin_approve.sent_email, school.email, admin_approve.status, admin_approve.target_id, school.school_name AS Name, admin_approve.role
                                        FROM admin_approve
                                        INNER JOIN school on admin_approve.target_id = school.school_id WHERE admin_approve.status = 'pending'
                                        ");
                if($query->num_rows()>0)
                    return $query;
                return false;         
        }

        public function DirectorRequestApproval($user, $code){
                $username = $user['username'];
                $password=  $user['password'];
                $query = $this->db->query("SELECT director_id FROM director WHERE username = '$username' AND password = '$password'");
                $director_id = $query->row()->director_id;
                $this->db->query("INSERT INTO admin_approve (target_id, status, code, role) VALUES ($director_id, 'pending', '$code', 'director')");
        }

        public function SchoolRequestApproval($user, $code){
                $username = $user['user'];
                $password=  $user['pass'];
                $query = $this->db->query("SELECT school_id FROM school WHERE user = '$username' AND pass = '$password'");
                $school_id = $query->row()->school_id;
                $this->db->query("INSERT INTO admin_approve (target_id, status, code, role) VALUES ($school_id, 'pending', '$code', 'school')");
        }        

         public function registerSchool($school){
                $this->db->insert('school', $school);
        }

        public function getNotificationSchool($ID){
            $query = $this->db->query("SELECT * FROM `notifications` inner join school_notifications on notifications.notifications_id = school_notifications.notifications_id where school_notifications.target_id = $ID ORDER BY notifications.date DESC");
            return $query;
        }

        public function getNotificationDirector($ID){
            $query = $this->db->query("SELECT * FROM `notifications` inner join director_notifications on notifications.notifications_id = director_notifications.notifications_id where director_notifications.target_id = $ID ORDER BY notifications.date DESC");
            return $query;
        }

        public function DismissNotificationSchool($notifID, $id){
            $query = $this->db->query("UPDATE school_notifications SET school_notifications.status = 1
                                    WHERE school_notifications.target_id = $id AND school_notifications.notifications_id = $notifID");

        }

        public function DismissNotificationDirector($notifID, $id){
            $query = $this->db->query("UPDATE director_notifications SET director_notifications.status = 1
                                    WHERE director_notifications.target_id = $id AND director_notifications.notifications_id = $notifID");

        }

        public function countNotificationsSchool($ID){
            $query = $this->db->query("SELECT count(notifications.notifications_id) as count FROM `notifications` inner join school_notifications on notifications.notifications_id = school_notifications.notifications_id where school_notifications.target_id = $ID AND school_notifications.status = 0");
            return $query->row()->count;
        }

        public function countNotificationsDirector($ID){
            $query = $this->db->query("SELECT count(notifications.notifications_id) as count FROM `notifications` inner join director_notifications on notifications.notifications_id = director_notifications.notifications_id where director_notifications.target_id = $ID AND director_notifications.status = 0");
            return $query->row()->count;
        }

        public function notifySchoolsInCat($CatID, $subject, $message){
            $query = $this->db->query("SELECT teams_in_competition.school_id
                        FROM teams_in_competition
                        INNER JOIN slot ON slot.team_id = teams_in_competition.teams_in_competition_id
                        WHERE slot.category_id = $CatID");
            $SchoolID = $query->row()->school_id;

            date_default_timezone_set('Asia/Manila');
            $date = date("Y-m-d H:i:s");

            $query = $this->db->query("INSERT INTO Notifications ('subject', 'text', 'date') VALUES ($subject, $message, $date)");

        }

  
  
 


    }
?>