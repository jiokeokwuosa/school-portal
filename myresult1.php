<?php
session_start();
ob_start();
$status=false;
$status1=false;
if(! isset($_SESSION['login'])){
   header('Location:login.php');
}
    
require_once'functions.php';
   if(isset($_SESSION['passcode']) and !empty($_SESSION['passcode'])){
     $session_id=$_SESSION['session_id'];
     $term_id=$_SESSION['term_id']; 
     $class_id=$_SESSION['class_id']; 
     $passcode=$_SESSION['passcode'];
     $reg_number=$_SESSION['reg_number'];
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
   }else{
       header('Location:index.php');
     } 
     
     if($term_id=='annual'){
       $query="SELECT FROM results WHERE `session_id`=$session_id AND `term_id`='1' AND `class_id`=$class_id AND `reg_number`=$reg_number";     
       $result=$db->custom($query);
       $first_term=$db->numRow();
       
       $query="SELECT FROM results WHERE `session_id`=$session_id AND `term_id`='2' AND `class_id`=$class_id AND `reg_number`=$reg_number";
       $result=$db->custom($query);
       $second_term=$db->numRow();
       
       $query="SELECT FROM results WHERE `session_id`=$session_id AND `term_id`='3' AND `class_id`=$class_id AND `reg_number`=$reg_number";
       $result=$db->custom($query);
       $third_term=$db->numRow();
       
           if($first_term==0 or $second_term==0 or $third_term==0){
            echo("<h6 class=title>Result Not Ready Yet!</h6>");
            
           } else{ 
            
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
            
            //end of position
                $status1='true';
                $db1=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                $db1->connect();
                $result=$db1->select('results',array('reg_number'=>$_SESSION['reg_number'],'session_id'=>$session_id,'term_id'=>1,'class_id'=>$class_id));
                $result1=$db1->select('results',array('reg_number'=>$_SESSION['reg_number'],'session_id'=>$session_id,'term_id'=>2,'class_id'=>$class_id));
                $result2=$db1->select('results',array('reg_number'=>$_SESSION['reg_number'],'session_id'=>$session_id,'term_id'=>3,'class_id'=>$class_id));
                     if($db1->numRow()==0){                    
                        echo("<h6 class=title>Result is not Ready</h6>");
                     }else{
                                 
                        $db1->insert('record_book',array('reg_number'=>$_SESSION['reg_number'],'session_id'=>$session_id,'class_id'=>$class_id,'passcode'=>$passcode));                                              
                       }
              }
        
     }else{
            //position
                  
                   $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`=$term_id AND `class_id`=$class_id";
                   $result=$db->custom($query);
                  
                   $numrow=$db->numRow();
                   $student_no=$numrow;
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
             
             
             
              //end of position
             
              $result=$db->select('results',array('reg_number'=>$_SESSION['reg_number'],'session_id'=>$session_id,'term_id'=>$term_id,'class_id'=>$class_id));
              if($db->numRow()==0){
                echo("<h6 class=title>No Existing Record</h6>");
              }else{
                 $status='true';              
                 $db->insert('record_book',array('reg_number'=>$_SESSION['reg_number'],'session_id'=>$session_id,'class_id'=>$class_id,'passcode'=>$passcode));
                }
               
       
       }
     
     
     
   if(isset($_SESSION['reg_number'])){
        $dir='D:\xampp\htdocs\school portal\image';
        $path=$dir.'\\'.$_SESSION['reg_number'].'.jpg';
        if(file_exists($path)){
            $src=$_SESSION['reg_number'].'.jpg';    
        }else{
           $src='none.png';
          }         
   }
   
   
if($status){   
  
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Owner" />

	<title><?php echo $db->getUserName($_SESSION['reg_number']);?></title>    
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
                       <td> Web: <?php echo $admin['website']['value'];?></td>
                       <td>&nbsp;</td>              
                  </tr>
             
             </table>
                  <h6 class="title">Report Card</h6>
         </div>      
    </div>
    
    <div class="row" style="border: black solid 1px;">
      <div class="col-md-12">
          <table style="width:100%; vertical-align: top;">
              <tr>
                <td rowspan="5" style="font-size: 17px;">
                   <b>Name:</b>&nbsp;&nbsp;&nbsp;<?php echo $db->getUserName($_SESSION['reg_number']);?><br />
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
                    <th class="center">S.No</th>
                    <th class="center">Name of Subject</th>
                    <th class="center">Maximum Marks</th>
                    <th class="center">Test Score(30)</th>
                    <th class="center">Exam Score(70)</th>
                    <th class="center">Total</th>
                    <th class="center">Grade</th>              
                </tr>
                <?php
                $counter=0;
                $sum=0;
                while($row=mysqli_fetch_assoc($result)){ 
                    $counter++;
                    extract($row);
                ?>
                <tr>
                    <td><?php echo $counter;?></td>
                    <td><?php echo $db->getSubjectName2($subject_id);?></td>
                    <td>100</td>                    
                    <td><?php echo $row['assesment_score'];?></td>  
                    <td><?php echo $row['exam_score'];
                    $total=$row['assesment_score']+$row['exam_score'];
                    ?></td>
                    <td><?php echo $total; $sum+=$total;?></td>
                    <td><?php echo $db->getGrade($total);?></td>
                    
                </tr>     
                <?php
                }
                ?>    
               <tr>
                    <td>&nbsp;</td>
                    <td class="right"><b>Total</b></td>
                    <td><?php $totalscore=$counter*100; echo "<b>$totalscore</b>";?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?php echo "<b>$sum</b>";?></td>
                    <td>&nbsp;</td>
               
               </tr>
            
            </table>
            <br />
            <table style="width:100%;" rules="all" frame="box" class="center">
                <tr>
                    <td style="width: 50%;">Total Marks Obtained: <?php 
                    $average=$sum/$counter;
                    echo "<b>$sum</b> out of a possible <b>$totalscore</b><br>Average: <b>".number_format($average,0)."</b>";?><br />
                    Position: <?php echo suffix(getPosition($newStudents,$reg_number))." out of $student_no Students";?> 
                    </td>
                    <td style="width: 50%;"><div style="transform: rotate(-25deg);"><?php echo $db->getRemark($average);?></div></td>                
                </tr>
            
            
            </table>
            <br />
            <table style="width:100%" class="center">
                <tr>
                    <td><b>Class Teacher</b></td>
                    <td><b>Principal</b></td>
                
                </tr>
                
                <tr>
                    <td><b><?php echo $db->getTeacherName($class_id);?></b></td>
                    <td><b><?php echo $admin['principal\'s_name']['value'];?></b></td>
                
                </tr>
                
            
            </table>
        
        
        </div>    
    
    </div>
    
   

</div>




</body>
</html>
<?php } 
if($status1){ 
    
  ?>
 <!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Owner" />

	<title><?php echo $db1->getUserName($_SESSION['reg_number']);?></title>    
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
                       <td> Web: <?php echo $admin['website']['value'];?></td>
                       <td>&nbsp;</td>              
                  </tr>
             
             </table>
                  <h6 class="title">Report Card</h6>
         </div>      
    </div>
    
    <div class="row" style="border: black solid 1px;">
      <div class="col-md-12">
          <table style="width:100%; vertical-align: top;">
              <tr>
                <td rowspan="5" style="font-size: 17px;">
                   <b>Name:</b>&nbsp;&nbsp;&nbsp;<?php echo $db1->getUserName($_SESSION['reg_number']);?><br />
                   <b>Reg.No:</b>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['reg_number'];?><br />
                   <b>Session:</b>&nbsp;&nbsp;&nbsp;<?php echo $db1->getSessionName($session_id);?><br />
                   <b>Term:</b>&nbsp;&nbsp;&nbsp;<?php echo $db1->getTermName($term_id);?><br />
                   <b>Class:</b>&nbsp;&nbsp;&nbsp;<?php echo $db1->getClassName($class_id);?><br />
        
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
                    <th class="center">S.No</th>
                    <th class="center">Name of Subject</th>
                    <th class="center">Maximum Marks</th>
                    <th class="center">Test Score(30)</th>
                    <th class="center">Exam Score(70)</th>
                    <th class="center">Total</th>
                    <th class="center">Grade</th>              
                </tr>
                <?php
                $counter=0;
                $sum=0;
                while($row=mysqli_fetch_assoc($result)){
                $row1=mysqli_fetch_assoc($result1);
                $row2=mysqli_fetch_assoc($result2);   
                $counter++;
                extract($row);
                ?>
                <tr>
                    <td><?php echo $counter;?></td>
                    <td><?php echo $db1->getSubjectName2($subject_id);?></td>
                    <td>100</td>                    
                    <td><?php $assesment=($row['assesment_score']+$row1['assesment_score']+$row2['assesment_score'])/3;
                      echo number_format($assesment,0);
                      ?></td>  
                    <td><?php $exam=($row['exam_score']+$row1['exam_score']+$row2['exam_score'])/3;
                      echo number_format($exam,0);
                      $total=number_format($assesment+$exam,0);
                      ?>                    
                    </td>
                    <td><?php echo $total; $sum+=$total;?></td>
                    <td><?php echo $db1->getGrade($total);?></td>
                    
                </tr>     
                <?php
                }
                ?>    
               <tr>
                    <td>&nbsp;</td>
                    <td class="right"><b>Total</b></td>
                    <td><?php $totalscore=$counter*100; echo "<b>$totalscore</b>";?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?php echo "<b>".$sum."</b>";?></td>
                    <td>&nbsp;</td>
               
               </tr>
            
            </table>
            <br />
            <table style="width:100%;" rules="all" frame="box" class="center">
                <tr>
                    <td style="width: 50%;">Total Marks Obtained: <?php 
                    $average=$sum/$counter;
                    $average=number_format($average,0);
                    
                    echo "<b>$sum</b> out of a possible <b>$totalscore</b><br>Average: <b>$average</b>";?><br /> 
                    Position: <?php echo suffix(getPosition($newStudents,$reg_number))." out of $third_term Students";?>                   
                    
                    </td>
                    <td style="width: 50%;"><div style="transform: rotate(-25deg);"><?php echo $db1->getRemark($average);?></div></td>                
                </tr>    
            
            </table>
            <br />
            <table style="width:100%" class="center">
                <tr>
                    <td><b>Class Teacher</b></td>
                    <td><b>Principal</b></td>
                
                </tr>
                
                <tr>
                    <td><b><?php echo $db1->getTeacherName($class_id);?></b></td>
                    <td><b><?php echo $admin['principal\'s_name']['value'];?></b></td>
                
                </tr>
                
            
            </table>
        
        
        </div>    
    
    </div>
    
   

</div>




</body>


<?php } ?>
</html>