<?php
require_once'header1.php';
$session_id='';
$term_id='';
$class_id='';

$db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
$db->connect();


    if(isset($_POST['action']) and $_POST['action']=='Get Result'){
        $validate=new Validator($_POST);
        $validate->validate_result4();
            if($validate->getIsValid()){
                $_SESSION['session_id']=$_POST['session_id'];
                $_SESSION['term_id']=$_POST['term_id']; 
                $_SESSION['class_id']=$_POST['class_id'];
                 echo $_SESSION['reg_number'];                  
               
                $result=$db->select('record_book',array('reg_number'=>$_SESSION['reg_number'],'session_id'=>$_SESSION['session_id'])); 
                if($db->numRow()>0){
                    $row=mysqli_fetch_assoc($result);
                    extract($row);
                   $_SESSION['passcode']=$passcode;
                   header('location:myresult1.php'); 
                   
                }else{
                    
                   header('location:valid.php');
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
<h6 class="title">My Result(s)</h6>
<?php
    if(isset($_SESSION['c'])){
      $error=$_SESSION['c'];
      echo("<div class='alert alert-danger center' role='alert'>
            <strong>Oops!</strong>
            <br/>$error
         </div>");
      unset($_SESSION['c']);
    }
?>
<form action="myresult.php" method="Post">
    <div class="row">
    
        <div class="col-md-3 contact-left cont"><select name="session_id" style="margin-bottom: 20px;" required=""><?php echo $db->listSession($session_id);?></select>  </div>
        <div class="col-md-3 contact-left cont"><select name="term_id" style="margin-bottom: 20px;" required=""><?php echo $db->listTerm($term_id);?>
        <option value="annual">Annual</option>
        </select>  </div>
        <div class="col-md-3 contact-left cont"><select id="class_id" name="class_id" class="class_id" style="margin-bottom: 20px;" required=""><?php echo $db->listClasses($class_id);?></select></div>
        <div class="col-md-3 contact-left1 cont"><input type="submit" name="action" style="margin-bottom: 20px;" value="Get Result"/>       </div>
           
    </div>
</form>













<?php
require_once'footer1.php';
?>