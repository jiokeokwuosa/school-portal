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
     if($_SESSION['access_level']==2){
         $result=$db->select('user_info_table',array('reg_number'=>$_SESSION['reg_number']));
         if($result){
            $row=mysqli_fetch_assoc($result);
            $class_id=$row['class_id'];                
         }else{
            echo'Error Occured';
           }
      }
 $reg_number='';
 $status=false;
 $disable=null;
  
     if($_SESSION['access_level']<3){
       $disable='disabled=""'; 
     }
 
 if(isset($_POST['action']) and $_POST['action']=='Search'){
    $validate=new Validator($_POST);
    $validate->validate_result3();
     if($validate->getIsValid()){
        $session_id=$_POST['session_id'];
        $term_id=$_POST['term_id'];
        if($_SESSION['access_level']>2){
          $class_id=$_POST['class_id'];
        }  
        $reg_number=$_POST['reg_number'];
          $result=$db->select('results',array('session_id'=>$session_id,'term_id'=>$term_id,'class_id'=>$class_id,'reg_number'=>$reg_number));
          if($db->numRow()>0){
            $_SESSION['b']=true;
          }else{
            $status=true;
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
<h6 class="title">Add Single Result</h6>
 <form action="result3.php" method="Post">
    <div class="row">
    
        <div class="col-md-2 contact-left cont"><select name="session_id" style="margin-bottom: 20px;" required=""><?php echo $db->listSession($session_id);?></select>  </div>
        <div class="col-md-2 contact-left cont"><select name="term_id" style="margin-bottom: 20px;" required=""><?php echo $db->listTerm($term_id);?></select>  </div>
        <div class="col-md-2 contact-left cont"><select id="class_id" name="class_id" class="class" style="margin-bottom: 20px;" required="" <?php echo $disable;?>><?php echo $db->listClasses($class_id);?></select></div>
        <div class="col-md-3 contact-left cont"><select name="reg_number" class="reg_number" style="margin-bottom: 20px;" required=""><?php echo $db->listStudents($reg_number,$class_id);?></select></div>
        <div class="col-md-3 contact-left1 cont"><input type="submit" name="action" style="margin-bottom: 20px;" value="Search"/>       </div>
           
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
    }elseif(isset($_SESSION['b'])){
         echo("<div class='alert alert-danger center' role='alert'>
                <strong>Oops!</strong>
                <br/>Result Already Exist
             </div>");
         unset($_SESSION['b']);
       }
 
  if($status){
 
    ?>
      <form action="" method="post">   
         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
           <?php
           $result=$db->select('subjects',array('class_id'=>$class_id));
           $numrow=$db->numRow();
           if($numrow==0){
            echo("<h6 class=title>No Existing Record</h6>");
            
           } else{
           
           ?> 
            <table class="table table-striped table-hover">
            <thead style="background-color: #000066; color: white;">
                <tr>
                    <th>Subject</th>
                    <th>Test Score</th>
                    <th>Exam Score</th>
                </tr>    
            </thead>    
            <tbody>
            
                <?php
                $counter=0;
                while($row=mysqli_fetch_assoc($result)){ 
                    ++$counter;
                    extract($row);
                ?>
                <tr>
                    <td><?php  echo $name;?></td>
                    <td class="contact-left"><input type="number" max="30"  name="member[<?php echo $counter;?>][assesment_score]" required=""/></td> 
                    <td class="contact-left"><input type="number" max="70" name="member[<?php echo $counter;?>][exam_score]" required=""/></td>  
                    <input type="hidden" name="member[<?php echo $counter;?>][reg_number]"  value="<?php echo $reg_number;?>"/>  
                    <input type="hidden" name="member[<?php echo $counter;?>][session_id]"  value="<?php echo $session_id;?>"/>
                    <input type="hidden" name="member[<?php echo $counter;?>][term_id]"  value="<?php echo $term_id;?>"/>  
                    <input type="hidden" name="member[<?php echo $counter;?>][class_id]"  value="<?php echo $class_id;?>"/>
                    <input type="hidden" name="member[<?php echo $counter;?>][subject_id]"  value="<?php echo $subject_id;?>"/> 
                    <input type="hidden" name="member[<?php echo $counter;?>][uploader]"  value="<?php echo $_SESSION['reg_number'];?>"/>                      
                </tr> 
                <?php
              
               
                }
                ?>
                            
            </tbody> 
            <tfoot style="background-color: #000066; color: white; text-align: center;">
            <tr>
            <td colspan="5">We have <?php echo $numrow;?> Record(s)</td>
            </tr>
            </tfoot>
            
            </table>
            <input type="submit" name="action" value="Submit Result" style="font-weight: bolder; background-color: #000066; color: white;"/>
             <?php 
           }
           
           ?> 
            
            </div>
            <div class="col-md-2"></div>
        </div>   
            
      </form>  
 
<?php
    }
    
    if(isset($_POST['action']) and $_POST['action']=='Submit Result'){
      $values=array();
        for($i=1; $i<count($_POST['member'])+1;  $i++){
           $values[]='("'.$_POST['member'][$i]['reg_number'].'","'.$_POST['member'][$i]['session_id'].'","'.$_POST['member'][$i]['term_id'].'","'.$_POST['member'][$i]['class_id'].'","'.$_POST['member'][$i]['subject_id'].'","'.$_POST['member'][$i]['assesment_score'].'","'.$_POST['member'][$i]['exam_score'].'","'.$_POST['member'][$i]['uploader'].'")'; 
        }
        $query="REPLACE INTO results (`reg_number`,`session_id`,`term_id`,`class_id`,`subject_id`,`assesment_score`, `exam_score`,`uploader`) VALUES ".implode(',', $values);
        $result=$db->custom($query);
        if($result){
           echo("<div class='row alert alert-success center' role='alert'>
            <strong>Congratulations</strong>
            <br/>Result Inserted Successfully
           </div>");
        }else{
           echo("<div class='alert alert-danger center' role='alert'>
                <strong>Oops!</strong>
                <br/>Error Inserting Result
            </div>"); 
        }
    }
    
    
    
    
require_once'footer1.php';
?>