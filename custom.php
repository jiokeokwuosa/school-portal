<?php
    require_once'functions.php';
    
      if(isset($_POST['class_id'])){
        $class_id=$_POST['class_id'];
        
        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
        $db->connect();
        echo $db->listSubject('',$class_id);
      }elseif(isset($_POST['student_class'])){
            $class_id=$_POST['student_class'];        
            $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
            $db->connect();
            echo $db->listStudents('',$class_id);
        }


?>