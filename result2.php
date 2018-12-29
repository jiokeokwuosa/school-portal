<?php
require_once'header1.php';

if($_SESSION['access_level']<2){
   header('Location:login.php');
 }
 
 $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
 $db->connect();
 $session_id='';
 $term_id='';
 $class_id='';
 $status=false;
 $status1=false;
 $disable=null;
 
 if($_SESSION['access_level']<3){
   $disable='disabled=""'; 
 }
 
 if(isset($_POST['action']) and $_POST['action']=='Search' and $_POST['term_id'] !='annual'){
    $validate=new Validator($_POST);
    $validate->validate_result2();
     if($validate->getIsValid()){
        $session_id=$_POST['session_id'];
        $_SESSION['session_id']=$_POST['session_id'];
        $term_id=$_POST['term_id'];
        $_SESSION['term_id']=$_POST['term_id'];
        
        if($_SESSION['access_level']>2){
           $class_id=$_POST['class_id'];
           $_SESSION['class_id']=$_POST['class_id'];
        }else{
             $result=$db->select('user_info_table',array('reg_number'=>$_SESSION['reg_number']));
             if($result){
                $row=mysqli_fetch_assoc($result);
                $class_id=$row['class_id']; 
                $_SESSION['class_id']=$row['class_id'];               
             }else{
                echo'Error Occured';
               }
          }
       
      $status='true'; 
        //Compute Position
        
                
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
        
      
      
      
      
  
  
      
     }else{
            $my_error='';
            $error=$validate->getError();
             foreach($error as $a=>$b){
                   $my_error.=$b;
                   $my_error.="<br>";                   
             } 
             $_SESSION['c']=$my_error;   
            
                            
       }
    
 }elseif(isset($_POST['action']) and $_POST['action']=='Search' and $_POST['term_id'] =='annual'){
        $validate=new Validator($_POST);
        $validate->validate_result2();
         if($validate->getIsValid()){
            $session_id=$_POST['session_id'];
            $_SESSION['session_id']=$_POST['session_id'];
            $term_id=$_POST['term_id'];
            $_SESSION['term_id']=$_POST['term_id'];
            
            if($_SESSION['access_level']>2){
               $class_id=$_POST['class_id'];
               $_SESSION['class_id']=$_POST['class_id'];
            }else{
                 $result=$db->select('user_info_table',array('reg_number'=>$_SESSION['reg_number']));
                 if($result){
                    $row=mysqli_fetch_assoc($result);
                    $class_id=$row['class_id']; 
                    $_SESSION['class_id']=$row['class_id'];               
                 }else{
                    echo'Error Occured';
                   }
              }
           
                    $status1='true'; 
              
          
          //position
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
          
          
          
         }else{
                $my_error='';
                $error=$validate->getError();
                 foreach($error as $a=>$b){
                       $my_error.=$b;
                       $my_error.="<br>";                   
                 } 
                 $_SESSION['c']=$my_error;   
                
                                
           }
    
    
    
 }
?>
<h6 class="title">View Result Sheet</h6>
 <form action="result2.php" method="Post">
    <div class="row">
        
        <div class="col-md-3 contact-left cont"><select name="session_id" style="margin-bottom: 20px;" required=""><?php echo $db->listSession($session_id);?></select>  </div>
        <div class="col-md-3 contact-left cont"><select name="term_id" style="margin-bottom: 20px;" required=""><?php echo $db->listTerm($term_id);?>
        <option value="annual">Annual</option>        
        </select>  </div>
        <div class="col-md-3 contact-left cont"><select id="class_id"  name="class_id" class="class_id" style="margin-bottom: 20px;" required=""<?php echo $disable;?>><?php echo $db->listClasses($class_id);?></select></div>
        <div class="col-md-3 contact-left1 cont"><input  type="submit" name="action" style="margin-bottom: 20px;" value="Search"/>       </div>
           
    </div>
 </form>
<?php
   if(isset($_SESSION['c'])){
      $error=$_SESSION['c'];
      echo("<div class='alert alert-danger center' role='alert'>
            <strong>Oops!</strong>
            <br/>$error
         </div>");
     unset($_SESSION['c']);
    }elseif(isset($_SESSION['e'])){
        echo("<div class='alert alert-success center' role='alert'>
                <strong>Congratulations</strong>
                <br/>Data Deleted Successfully
               </div>");
        unset($_SESSION['e']);
      }elseif(isset($_SESSION['f'])){
            echo("<div class='alert alert-danger center' role='alert'>
                    <strong>Oops!</strong>
                    <br/>Error Deleting Data
                   </div>");
            unset($_SESSION['f']);
         }  

  if($status){  
    
    ?>
   <div class="row">
        <div class="col-md-12">
        <h6 class="title"><?php echo $db->getTermName($term_id);?> Term Result</h6>
        
       <?php
       $query="SELECT DISTINCT `reg_number` FROM results WHERE `session_id`=$session_id AND `term_id`=$term_id AND `class_id`=$class_id";
       $result=$db->custom($query);
      
       $numrow=$db->numRow();
       if($numrow==0){
        echo("<h6 class=title>No Existing Record</h6>");
        
       } else{
       
       ?> 
        <table class="table table-striped table-hover">
        <thead style="background-color: #000066; color: white;">
            <tr>
                <th>S/No</th>
                <th>Student Name</th>
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
                    echo'<th>'.$db1->getSubjectName1($value).'</th>';
                   }                  
                  ?>
                <th>Total</th>
                <th>Average</th>
                <th>Position</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>    
        </thead>    
        <tbody>
        
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
                <td><?php  echo"<a onclick='return checkDelete();' href=transact.php?key=$row_id&action=deleteResult>";?><i class="glyphicon glyphicon-remove" style="color: red;"></i></a> </td>
                <td><?php  echo"<a onclick='return checkEdit();' href=editresult.php?key=$reg_number&session=$session_id&term=$term_id&class=$class_id>";?><i class="glyphicon glyphicon-pencil" style="color: black;"></i></a> </td>          
            </tr> 
            <?php
            }
            ?>              
        </tbody> 
        <tfoot style="background-color: #000066; color: white; text-align: center;">
        <tr>
        <td colspan="<?php echo $add+7;?>">We have <?php echo $numrow;?> Record(s)</td>
        </tr>
        </tfoot>
        
        </table>
        <h6 class="title clearlink"><a href="print.php">Want to Print? <i class="glyphicon glyphicon-print" style="color: black;"></i></a></h6>
         <?php 
       }
       
       ?> 
        
        </div>
    </div>
 


 
<?php
    }
 if($status1){
 
?>
  <div class="row">
        <div class="col-md-12">
        <h6 class="title">Annual Result</h6>
       <?php
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
        <table class="table table-striped table-hover">
        <thead style="background-color: #000066; color: white;">
            <tr>
                <th>S/No</th>
                <th>Student Name</th>
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
                    echo'<th>'.$db1->getSubjectName1($value).'</th>';
                   }                  
                  ?>
                <th>Total</th>
                <th>Average</th> 
                <th>Position</th>               
            </tr>    
        </thead>    
        <tbody>
        
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
        </tbody> 
        <tfoot style="background-color: #000066; color: white; text-align: center;">
        <tr>
        <td colspan="<?php echo $add+5;?>">We have <?php echo $first_term;?> Record(s)</td>
        </tr>
        </tfoot>
        
        </table>
        <h6 class="title clearlink"><a href="print.php">Want to Print? <i class="glyphicon glyphicon-print" style="color: black;"></i></a></h6>
         <?php 
         
       }
       
       ?> 
        
        </div>
    </div>






<?php   
 }  
require_once'footer1.php';
?>