<?php 
require_once'header1.php';


if(!isset($_SESSION['login'])){
   header('Location:login.php');
}
?>

<h6 class="title">Take Test</h6>


<div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        
       <?php
       $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
       $db->connect();
       $result=$db->select('user_info_table',array('reg_number'=>$_SESSION['reg_number']));
       if($db->numRow()==0){
         echo("<h6 class=title>No Existing Record</h6>");
       }else{
        
         $row=mysqli_fetch_assoc($result);         
         extract($row);          
          
             
           
           $result=$db->select('exam_subject_list',array('class_id'=>$class_id),array('subject_id'=>'desc'));
           $numrow=$db->numRow();
           if($numrow==0){
            echo("<h6 class=title>No Existing Record</h6>");
            
           } else{
       
       ?> 
        <table class="table table-striped table-hover">
        <thead style="background-color: #000066; color: white;">
            <tr>
                <th>Subject (s)</th>
                <th>Take Test</th>
            </tr>    
        </thead>    
        <tbody>
        
            <?php
            while($row=mysqli_fetch_assoc($result)){ 
                extract($row);
            ?>
            <tr>
                <td><?php echo ucwords($name);?></td>
                <td><?php  echo"<a href=quiz.php?subject_id=$subject_id>";?><i class="glyphicon glyphicon-play" style="color: green;"></i></a> </td>          
            </tr> 
            <?php
            }
            ?>              
        </tbody> 
        <tfoot style="background-color: #000066; color: white; text-align: center;">
        <tr>
        <td colspan="2">We have <?php echo $numrow;?> Record(s)</td>
        </tr>
        </tfoot>
        
        </table>
        
             <?php 
           }
       }
       ?> 
        
        </div>
        <div class="col-md-3"></div>
</div>







<?php 
require_once'footer1.php';
?>



