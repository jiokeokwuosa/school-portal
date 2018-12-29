<?php
require_once'header1.php';

if(!isset($_SESSION['access_level']) or $_SESSION['access_level']<3){
  header('location:index.php');   
}
?>
<h6 class="title">Teacher(s)</h6>

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
      }elseif(isset($_SESSION['g'])){
          echo("<div class='alert alert-success center' role='alert'>
                    <strong>Congratulations</strong>
                    <br/>Account Status Changed Successfully
                   </div>");
          unset($_SESSION['g']);
        }elseif(isset($_SESSION['h'])){
            echo("<div class='alert alert-danger center' role='alert'>
                    <strong>Oops!</strong>
                    <br/>Error Changing Account Status
                   </div>");
            unset($_SESSION['h']);
          }  
   
      
    
   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
   $db->connect();
   $result=$db->select('user_info_table',array('status'=>'true','access_level'=>'2'));
   $numrow=$db->numRow();
   if($numrow==0){
    echo("<h6 class=title>No Existing Record</h6>");
    
   } else{
   
   ?> 
    <table class="table table-striped table-hover">
    <thead style="background-color: #000066; color: white;">
        <tr>
            <th>Reg.Number</th>
            <th>Name</th>
            <th>Class</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Activate/Deactivate</th>
        </tr>    
    </thead>    
    <tbody>
    
        <?php
        while($row=mysqli_fetch_assoc($result)){ 
            extract($row);
        ?>
        <tr>
            <td><?php echo $reg_number;?></td>
            <td><?php echo $last_name.' '.$first_name;?></td>
            <td><?php echo $db->getClassName($class_id);?></td>
            <td><?php  echo"<a onclick='return checkEdit();' href=signup.php?key=$reg_number>";?><i class="glyphicon glyphicon-pencil" style="color: green;"></i></a> </td>
            <?php if($_SESSION['access_level']>3){
               ?>
            <td><?php  echo"<a onclick='return checkDelete();' href=transact.php?key=$user_id&action=deleteUser&dest=teachers>";?><i class="glyphicon glyphicon-trash" style="color: black;"></i></a> </td>
                
           <?php     
            }else{
               ?> 
               <td><?php  echo"Not Allowed"; ?> </td> 
           <?php     
            }?>
        <?php if($account_status=='false'){
        
         ?>         
         <td><?php  echo"<a href=transact.php?key=$user_id&action=activateUser&dest=teachers>";?><i class="glyphicon glyphicon-ok" style="color: red;"></i></a> </td>
                   
       <?php
             }else{
          ?>
          
           <td><?php  echo"<a href=transact.php?key=$user_id&action=deactivateUser&dest=teachers>";?><i class="glyphicon glyphicon-ok" style="color: green;"></i></a> </td>
                
         <?php       
          }  
   }
        ?>              
    </tbody> 
    <tfoot style="background-color: #000066; color: white; text-align: center;">
    <tr>
    <td colspan="6">We have <?php echo $numrow;?> Record(s)</td>
    </tr>
    </tfoot>
    
    </table>
    
     <?php 
   }

   ?> 
    
    </div>

</div>









<?php
require_once'footer1.php';
?>