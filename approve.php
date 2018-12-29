<?php
require_once'header1.php';

if(!isset($_SESSION['access_level']) or $_SESSION['access_level']<3){
  header('location:index.php');   
}
?>
<h6 class="title">Approve Account(s)</h6>

<div class="row clearlink">
    <div class="col-md-12">
   <?php
   
   if(isset($_SESSION['b'])){
      echo("<div class='alert alert-danger center' role='alert'>
            <strong>Oops!</strong>
            <br/>Error approving account
           </div>");
      unset($_SESSION['b']);
    }elseif(isset($_SESSION['a'])){
          echo("<div class='alert alert-success center' role='alert'>
                <strong>Congratulations!</strong>
                <br/>The account has been approved
               </div>");
          unset($_SESSION['a']);
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
   
   
   
   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
   $db->connect();
   $result=$db->select('user_info_table',array('status'=>'false'));
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
            <th>Approve</th>
            <th>Delete</th>
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
            <td><?php  echo"<a onclick='return checkApprove();' href=transact.php?key=$reg_number&action=approve>";?><i class="glyphicon glyphicon-ok" style="color: red;"></i></a> </td>
            <td><?php  echo"<a onclick='return checkDelete();' href=transact.php?key=$reg_number&action=deleteAccount>";?><i class="glyphicon glyphicon-trash" style="color: black;"></i></a> </td>
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
    
     <?php 
   }
   
   ?> 
    
    </div>

</div>









<?php
require_once'footer1.php';
?>