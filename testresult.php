<?php
require_once'header1.php';
?>

<h6 class="title">Test Results</h6><br />
<div class="row">
    <div class="col-md-12">
   <?php
   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
   $db->connect();
   $result=$db->select('exam_result',array('creator_id'=>$_SESSION['reg_number']));
   $numrow=$db->numRow();
   if($numrow==0){
    echo("<h6 class=title>No Existing Result</h6>");
    
   } else{
   
   ?> 
    <table class="table table-striped table-hover">
    <thead style="background-color: #000066; color: white;">
        <tr>
            <th>Reg.Number</th>
            <th>Subject</th>
            <th>Score</th>
            <th>Date/Time</th>
        </tr>    
    </thead>    
    <tbody>
    
        <?php
        while($row=mysqli_fetch_assoc($result)){ 
            extract($row);
        ?>
        <tr>
            <td><?php echo $reg_number;?></td>
            <td><?php echo $db->getSubjectName($subject_id);?></td>
            <td><?php echo $score;?></td>
            <td><?php  echo $date;?> </td>
        </tr> 
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
   
   ?> 
    
    </div>
</div>






<?php
require_once'footer1.php';
?>