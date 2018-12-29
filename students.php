<?php
require_once'header1.php';

if(!isset($_SESSION['access_level']) or $_SESSION['access_level']<3){
  header('location:index.php');   
}
?>
<h6 class="title">Students(s)</h6>

<div class="row clearlink">
    <div class="col-md-12">
   <?php
   
   if(isset($_SESSION['e'])){
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
   
   
   
    
   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
   $db->connect();
   $result=$db->select('user_info_table',array('status'=>'true','access_level'=>'1'),array('reg_number'=>'ASC'));
   $numrow=$db->numRow();
   if($numrow==0){
    echo("<h6 class=title>No Existing Record</h6>");
    
   } else{
   
   ?> 
   
   <div class="newspaper1">
        <ol style="list-style: ; clear: both; padding-left: 0px; font-size: 16px; color: #000066;" class="clearlink">
                                
        <?php
        while($row=mysqli_fetch_assoc($result)){ 
            extract($row);
        ?>
        
         <li class="linespace1">
         <?php echo $reg_number.' : '.$last_name.' '.$first_name.' : '.$db->getClassName($class_id)." : <a onclick='return checkEdit();' title='Edit Account' href=signup.php?key=$reg_number><i class='glyphicon glyphicon-pencil' style='color: green;'></i></a>";
          
         if($_SESSION['access_level']>3) {
            echo"<a onclick='return checkDelete();' title='Delete Account' href=transact.php?key=$user_id&action=deleteUser&dest=students><i class='glyphicon glyphicon-trash' style='color: black;'></i></a>";
         }
         
         if($account_status=='false'){
            echo"<a title='Activate Account' href=transact.php?key=$user_id&action=activateUser&dest=students><i class='glyphicon glyphicon-ok' style='color: red;'></i></a>";
         }else{
            echo"<a title='Deactivate Account' href=transact.php?key=$user_id&action=deactivateUser&dest=students><i class='glyphicon glyphicon-ok' style='color: green;'></i></a>";
           }
         ?>
         </li>
         
            <?php
        }
        ?>              
           
        </ol>
  </div>
     <?php 
   }
   
   ?> 
    
    </div>

</div>









<?php
require_once'footer1.php';
?>