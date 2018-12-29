<?php
session_start();
ob_start();
$status=false;
$status1=false;
    if(! isset($_SESSION['login'])){
        header('Location:login.php');
    }
    
    define("DBHOST", $_SERVER['HTTP_HOST']);
    if (DBHOST === "localhost") {
    define("DBUSER", "christ4life");
    define("DBPASSWORD", "");
    define("DBNAME", "school1");
    } else {
        define("DBUSER", "godslov1_christ4life");
        define("DBPASSWORD", "christ4life123/");
        define("DBNAME", "godslov1_school1");
    }
        
require_once'functions.php';
     if(isset($_SESSION['session_id']) and isset($_SESSION['term_id']) and isset($_SESSION['class_id'])){
         $session_id=$_SESSION['session_id'];
         $term_id=$_SESSION['term_id']; 
         $class_id=$_SESSION['class_id'];        
         $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
         $db->connect();
         
            $result1=$db->select('structure');
            if($result1){
                  while($row=mysqli_fetch_assoc($result1)) {
                    $admin[$row['constant']]['title']=$row['title']; 
                    $admin[$row['constant']]['value']=$row['value'];
                  }          
            }else{
               die('Resources not Available');  
              }
                 
                 
                 
             if($term_id!='annual'){
                $status=true;
                
                
                   $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`=$term_id AND `class_id`=$class_id";
                   $result=$db->custom($query);
                  
                   $numrow=$db->numRow();
                   if($numrow==0){
                    echo("<h6 class=title>No Existing Record</h6>");
                    
                   } else{
                       
                          $db1=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                          $db1->connect();
                          $query="SELECT DISTINCT `subject_id` FROM results WHERE `class_id`=$class_id";
                          $result1=$db1->custom($query);             
                          $subject_no=array();
                              while($row1=mysqli_fetch_assoc($result1)){
                                $subject_no[]=$row1['subject_id'];
                              }
                           $students=array();
                           while($row=mysqli_fetch_assoc($result)){ 
                           extract($row);  
                          
                                  $db2=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                                  $db2->connect();
                                  $total=0;                          
                                   foreach($subject_no as $key=>$value){
                                     
                                     $result2=$db2->select('results',array('reg_number'=>$reg_number,'subject_id'=>$value,'session_id'=>$session_id,'term_id'=>$term_id));
                                     if($db2->numRow()==0){
                                        echo'<td>0</td>';
                                     }else{
                                        $row2=mysqli_fetch_assoc($result2);
                                        $subject_total=$row2['assesment_score']+$row2['exam_score'];
                                        $row_id=$row2['result_id'];
                                        $total+=$subject_total;
                                                               
                                       }
                                   } 
                                   
                                    $average=number_format(($total/count($subject_no)),0); 
                                    
                                    $students[$reg_number]=$average;                         
                                                    
                          
                           }
                           arsort($students);
                           include_once'position.php';                               
                    
                      }
               
             }elseif($term_id=='annual'){
                $status1=true;
               
                   $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`='1' AND `class_id`=$class_id";
                   $result=$db->custom($query);
                   $first_term=$db->numRow();
                   
                   $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`='2' AND `class_id`=$class_id";
                   $result=$db->custom($query);
                   $second_term=$db->numRow();
                   
                   $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`='3' AND `class_id`=$class_id";
                   $result=$db->custom($query);
                   $third_term=$db->numRow();
                   
                   if($first_term==0 or $second_term==0 or $third_term==0){
                    echo("<h6 class=title>Result Not Ready Yet!</h6>");
                    
                   }else{
                    
                          $db1=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                          $db1->connect();
                          $query="SELECT DISTINCT `subject_id` FROM results WHERE `class_id`=$class_id";
                          $result1=$db1->custom($query);
                          $subject_no=array();
                           while($row1=mysqli_fetch_assoc($result1)){
                            $subject_no[]=$row1['subject_id'];
                           }
                           
                            $students=array();
                            while($row=mysqli_fetch_assoc($result)){ 
                            extract($row);
                            
                                  $db2=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                                  $db2->connect();
                                  $total=0;
                                   foreach($subject_no as $key=>$value){                     
                                     $result2=$db2->select('results',array('reg_number'=>$reg_number,'subject_id'=>$value,'session_id'=>$session_id,'term_id'=>'1'));
                                     $result3=$db2->select('results',array('reg_number'=>$reg_number,'subject_id'=>$value,'session_id'=>$session_id,'term_id'=>'2'));
                                     $result4=$db2->select('results',array('reg_number'=>$reg_number,'subject_id'=>$value,'session_id'=>$session_id,'term_id'=>'3'));
                                     if($db2->numRow()==0){
                                        echo'<td>0</td>';
                                     }else{
                                        $row2=mysqli_fetch_assoc($result2);
                                        $row3=mysqli_fetch_assoc($result3);
                                        $row4=mysqli_fetch_assoc($result4);
                                        $subject_total=$row2['assesment_score']+$row2['exam_score']+$row3['assesment_score']+$row3['exam_score']+$row4['assesment_score']+$row4['exam_score'];
                                        $subject_total1=number_format(($subject_total/3),0);
                                        $total+=$subject_total1;
                                                                
                                       }
                                   }
                                   
                                    $average=number_format(($total/count($subject_no)),0);                             
                                    $students[$reg_number]=$average;                    
                            
                            
                            
                            }
                            
                             arsort($students);
                             include_once'position.php'; 
                    
                    
                     }
               
               
               
               
               
               
               }
               $result4=$db->select('user_info_table',array('access_level'=>'2','class_id'=>$class_id));
                   if($result4){
                    $row4=mysqli_fetch_assoc($result4);
                    $reg_teacher=$row4['reg_number'];
                   }
               
               if(isset($reg_teacher)){
                  $dir='D:\xampp\htdocs\school portal\image';
                  $path=$dir.'\\'.$reg_teacher.'.jpg';
                    if(file_exists($path)){
                        $src=$reg_teacher.'.jpg';    
                    }else{
                        $src='none.png';
                      }         
               }
   
     }else{
           header('Location:index.php');
       } 
?>


<?php 
if($status){
     $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`=$term_id AND `class_id`=$class_id";
       $result=$db->custom($query);
      
       $numrow=$db->numRow();
       if($numrow==0){
        echo("<h6 class=title>No Existing Record</h6>");
        
       } else{
          
 ?>
 <!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Owner" />

	<title><?php echo $db->getClassName($class_id);?></title>    
    <link rel="icon" href="images/logo.png" />
    <link  href="css/style.css" rel="stylesheet" media="all" />
    <link  href="css/bootstrap.min.css" rel="stylesheet" media="all" /> 
    
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row center">
        <img src="images/logo.png" width="9%"/>
    
    </div>
    
    <div class="row">
      <div class="col-md-12 center">
      <h4 class="title"><?php echo $admin['name']['value'];?></h4> <span style="font-size: 20px;"><?php echo $admin['address']['value'];?></span>
      </div>
    </div>

    <div class="row" style="font-size: 17px;">
         <div class="col-md-12">
             <table style="width:100%">
                  <tr>
                      <td>Phone No: <?php echo $admin['phone']['value'];?></td>
                      <td class="right">Email: <?php echo $admin['email']['value'];?></td>
                  </tr>
                  <tr>
                       <td> Website: <?php echo $admin['website']['value'];?></td>
                       <td>&nbsp;</td>              
                  </tr>
             
             </table>
                  <h6 class="title">Result Sheet</h6>
         </div>      
    </div>
    
    <div class="row" style="border: black solid 1px;">
      <div class="col-md-12">
          <table style="width:100%; vertical-align: top;">
              <tr>
                <td rowspan="5" style="font-size: 17px;" style="width:70%">
                   <b>Teacher's Name:</b>&nbsp;&nbsp;&nbsp;<?php echo $db->getTeacherName($class_id);?><br />
                   <b>Reg.No:</b>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['reg_number'];?><br />
                   <b>Session:</b>&nbsp;&nbsp;&nbsp;<?php echo $db->getSessionName($session_id);?><br />
                   <b>Term:</b>&nbsp;&nbsp;&nbsp;<?php echo $db->getTermName($term_id);?><br />
                   <b>Class:</b>&nbsp;&nbsp;&nbsp;<?php echo $db->getClassName($class_id);?><br />
        
                </td>
                <td rowspan="5"><img  src="image/<?php echo $src;?>" width="15%" style="float: right; border: black solid 1px;"/></td>
              </tr>          
          </table>    
      </div>    
    </div>
    <br />
    <div class="row" style="font-size: 17px;">
        <div class="col-md-12">
            <table style="width:100%;" rules="all" frame="box" class="center">
                <tr class="center">
                    <th class="center">S/No</th>
                    <th class="center">Student Name</th>
                       <?php
                          $db1=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                          $db1->connect();
                          $query="SELECT DISTINCT `subject_id` FROM results WHERE `class_id`=$class_id";
                          $result1=$db1->custom($query);
                          $add=$db1->numRow();
                          $subject_no=array();
                           while($row1=mysqli_fetch_assoc($result1)){
                            $subject_no[]=$row1['subject_id'];
                           }
                           foreach($subject_no as $key=>$value){
                            echo'<th class="center">'.$db1->getSubjectName1($value).'</th>';
                           }                  
                      ?>
                    <th class="center">Total</th>
                    <th class="center">Average</th>
                    <th class="center">Position</th>
                </tr>    
                <?php
                $counter=0;
                while($row=mysqli_fetch_assoc($result)){ 
                extract($row);
                ?>
                <tr>
                    <td><?php echo ++$counter;?></td>
                    <td><?php echo $db->getUserName($reg_number);?></td>  
                    <?php
                      $db2=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                      $db2->connect();
                         $total=0;
                       foreach($subject_no as $key=>$value){
                         
                         $result2=$db2->select('results',array('reg_number'=>$reg_number,'subject_id'=>$value,'session_id'=>$session_id,'term_id'=>$term_id));
                         if($db2->numRow()==0){
                            echo'<td>0</td>';
                         }else{
                            $row2=mysqli_fetch_assoc($result2);
                            $subject_total=$row2['assesment_score']+$row2['exam_score'];
                            $row_id=$row2['result_id'];
                            $total+=$subject_total;
                            echo'<td>'.$subject_total.'</td>';                         
                           }
                       }               
                      ?>    
                    <td><?php echo $total;?></td>  
                    <td><?php echo number_format(($total/count($subject_no)),0);?></td>  
                    <td><?php echo suffix(getPosition($newStudents,$reg_number));?></td>      
              </tr>     
                <?php
                }
                ?>    
               
            
            </table>
            <br />
          
                
        
        </div>    
    
    </div>
    
   

</div>




</body>
</html>
 
    
    
    
<?php    
}
}elseif($status1){
    
       $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`='1' AND `class_id`=$class_id";
       $result=$db->custom($query);
       $first_term=$db->numRow();
       
       $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`='2' AND `class_id`=$class_id";
       $result=$db->custom($query);
       $second_term=$db->numRow();
       
       $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`='3' AND `class_id`=$class_id";
       $result=$db->custom($query);
       $third_term=$db->numRow();
       
       if($first_term==0 or $second_term==0 or $third_term==0){
        echo("<h6 class=title>Result Not Ready Yet!</h6>");
        
       } else{       
        
 ?>
 
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Owner" />

	<title><?php echo $db->getClassName($class_id);?></title>    
    <link rel="icon" href="images/logo.png" />
    <link  href="css/style.css" rel="stylesheet" media="all" />
    <link  href="css/bootstrap.min.css" rel="stylesheet" media="all" /> 
    
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row center">
        <img src="images/logo.png" width="9%"/>
    
    </div>
    
    <div class="row">
      <div class="col-md-12 center">
      <h4 class="title"><?php echo $admin['name']['value'];?></h4> <span style="font-size: 20px;"><?php echo $admin['address']['value'];?></span>
      </div>
    </div>

    <div class="row" style="font-size: 17px;">
         <div class="col-md-12">
             <table style="width:100%">
                  <tr>
                      <td>Phone No:<?php echo $admin['phone']['value'];?></td>
                      <td class="right">Email: <?php echo $admin['email']['value'];?></td>
                  </tr>
                  <tr>
                       <td> Website: <?php echo $admin['website']['value'];?></td>
                       <td>&nbsp;</td>              
                  </tr>
             
             </table>
                  <h6 class="title">Result Sheet</h6>
         </div>      
    </div>
    
    <div class="row" style="border: black solid 1px;">
      <div class="col-md-12">
          <table style="width:100%; vertical-align: top;">
              <tr>
                <td rowspan="5" style="font-size: 17px;">
                   <b>Teacher's Name:</b>&nbsp;&nbsp;&nbsp;<?php echo $db->getTeacherName($class_id);?><br />
                   <b>Reg.No:</b>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['reg_number'];?><br />
                   <b>Session:</b>&nbsp;&nbsp;&nbsp;<?php echo $db->getSessionName($session_id);?><br />
                   <b>Term:</b>&nbsp;&nbsp;&nbsp;<?php echo $db->getTermName($term_id);?><br />
                   <b>Class:</b>&nbsp;&nbsp;&nbsp;<?php echo $db->getClassName($class_id);?><br />
        
                </td>
                <td rowspan="5"><img  src="image/<?php echo $src;?>" width="15%" style="float: right; border: black solid 1px;"/></td>
              </tr>          
          </table>    
      </div>    
    </div>
    <br />
    <div class="row" style="font-size: 17px;">
        <div class="col-md-12">
            <table style="width:100%;" rules="all" frame="box" class="center">
                <tr class="center">
                    <th class="center">S/No</th>
                    <th class="center">Student Name</th>
                       <?php
                          $db1=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                          $db1->connect();
                          $query="SELECT DISTINCT `subject_id` FROM results WHERE `class_id`=$class_id";
                          $result1=$db1->custom($query);
                          $add=$db1->numRow();
                          $subject_no=array();
                           while($row1=mysqli_fetch_assoc($result1)){
                            $subject_no[]=$row1['subject_id'];
                           }
                           foreach($subject_no as $key=>$value){
                            echo'<th class="center">'.$db1->getSubjectName1($value).'</th>';
                           }                  
                      ?>
                    <th class="center">Total</th>
                    <th class="center">Average</th>
                    <th class="center">Position</th>
                </tr>    
                <?php
                $counter=0;
                while($row=mysqli_fetch_assoc($result)){ 
                extract($row);
                ?>
                <tr>
                    <td><?php echo ++$counter;?></td>
                    <td><?php echo $db->getUserName($reg_number);?></td>  
                    <?php
                      $db2=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                      $db2->connect();
                      $total=0;
                       foreach($subject_no as $key=>$value){                     
                         $result2=$db2->select('results',array('reg_number'=>$reg_number,'subject_id'=>$value,'session_id'=>$session_id,'term_id'=>'1'));
                         $result3=$db2->select('results',array('reg_number'=>$reg_number,'subject_id'=>$value,'session_id'=>$session_id,'term_id'=>'2'));
                         $result4=$db2->select('results',array('reg_number'=>$reg_number,'subject_id'=>$value,'session_id'=>$session_id,'term_id'=>'3'));
                         if($db2->numRow()==0){
                            echo'<td>0</td>';
                         }else{
                            $row2=mysqli_fetch_assoc($result2);
                            $row3=mysqli_fetch_assoc($result3);
                            $row4=mysqli_fetch_assoc($result4);
                            $subject_total=$row2['assesment_score']+$row2['exam_score']+$row3['assesment_score']+$row3['exam_score']+$row4['assesment_score']+$row4['exam_score'];
                            $subject_total1=number_format(($subject_total/3),0);
                            $total+=$subject_total1;
                            echo'<td>'.$subject_total1.'</td>';                         
                           }
                       }               
                      ?>    
                    <td><?php echo $total;?></td>  
                    <td><?php echo number_format(($total/count($subject_no)),0);?></td>  
                    <td><?php echo suffix(getPosition($newStudents,$reg_number));?></td>      
                </tr>     
                <?php
                }
                ?>    
               
            
            </table>
            <br />
          
                
        
        </div>    
    
    </div>
    
   

</div>




</body>
</html>
    
<?php    
         }
 }
?>