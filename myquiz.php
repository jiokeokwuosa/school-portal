<?php 
require_once'header1.php';


if($_SESSION['access_level']<2){
   header('Location:login.php');
}
?>

<h6 class="title">My Test (s)</h6>


<div class="row">
    <div class="col-md-12">
    
   <?php
   if(isset($_SESSION['a'])){
      echo("<div class='alert alert-success center' role='alert'>
            <strong>Congratulations</strong>
            <br/>Data Deleted Successfully
           </div>");
      unset($_SESSION['a']);
   }elseif(isset($_SESSION['b'])){
                echo("<div class='alert alert-danger center' role='alert'>
                        <strong>Oops!</strong>
                        <br/>Error Inserting Data
                       </div>");
                unset($_SESSION['b']);
        }
   
   
   
   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
   $db->connect();
   $result=$db->select('exam_subject_list',array('creator_id'=>$_SESSION['reg_number']),array('subject_id'=>'desc'));
   $numrow=$db->numRow();
   if($numrow==0){
    echo("<h6 class=title>No Existing Record</h6>");
    
   } else{
   
   ?> 
    <table class="table table-striped table-hover">
    <thead style="background-color: #000066; color: white;">
        <tr>
            <th>Subject (s)</th>
            <th>Delete</th>
            <th>Try</th>
        </tr>    
    </thead>    
    <tbody>
    
        <?php
        while($row=mysqli_fetch_assoc($result)){ 
            extract($row);
        ?>
        <tr>
            <td><?php echo ucwords($name);?></td>
            <td><?php  echo"<a onclick='return checkDelete();' href=transact.php?class_id=$class_id&subject_id=$subject_id&action=deleteSubject>";?><i class="glyphicon glyphicon-trash" style="color: black;"></i></a> </td>
            <td><?php  echo"<a href=quiz.php?subject_id=$subject_id>";?><i class="glyphicon glyphicon-play" style="color: green;"></i></a> </td>          
        </tr> 
        <?php
        }
        ?>              
    </tbody> 
    <tfoot style="background-color: #000066; color: white; text-align: center;">
    <tr>
    <td colspan="3">We have <?php echo $numrow;?> Record(s)</td>
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



