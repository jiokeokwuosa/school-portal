<?php
require_once'header1.php';

if(!isset($_SESSION['access_level']) or $_SESSION['access_level']<2){
  header('location:index.php');   
}
?>
<h6 class="title">My Students</h6>

<div class="row clearlink">
    <div class="col-md-12">
   <?php
   
    
   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
   $db->connect();
   $result=$db->select('user_info_table',array('reg_number'=>$_SESSION['reg_number']));
   if($db->numRow()==0){
     echo("<h6 class=title>No Existing Record</h6>");
   }else{
    
     $row=mysqli_fetch_assoc($result);
     extract($row);
     $result=$db->select('user_info_table',array('access_level'=>'1','class_id'=>$class_id));
     
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
           <?php
            }
            ?>              
        </tbody> 
        <tfoot style="background-color: #000066; color: white; text-align: center;">
        <tr>
        <td colspan="4">We have <?php echo $numrow;?> Record(s)</td>
        </tr>
        </tfoot>
        
        </table>
        
         <?php 
       }
 }
   ?> 
    
    
    
    
    
   
   
   
   
    
    </div>

</div>









<?php
require_once'footer1.php';
?>