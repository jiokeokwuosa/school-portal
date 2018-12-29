<?php
require_once'header1.php';

if(! isset($_SESSION['login']) or $_SESSION['access_level']<2){
    header('location:login.php');
}

if(!isset($_GET['key']) or !isset($_GET['session']) or !isset($_GET['term']) or !isset($_GET['class'])){
    header('location:index.php');
}else{
  $reg_number=$_GET['key'];
  $session_id=$_GET['session'];
  $term_id=$_GET['term'];
  $class_id=$_GET['class'];
  
  $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
  $db->connect();
  $result=$db->select('results',array('reg_number'=>$reg_number,'session_id'=>$session_id,'term_id'=>$term_id,'class_id'=>$class_id));
      if($db->numRow()==0){
        echo("<h6 class=title>No Existing Record</h6>");
      }else{
        ?>
  <h6 class="title">Edit Result for <?php echo $db->getUserName($reg_number);?></h6>
  <div class="row">
   <div class="col-md-2"></div>
   <div class="col-md-8">
   <form action="transact.php" method="post">
        <table class="table table-striped table-hover">
        <thead style="background-color: #000066; color: white;">
            <tr>
                <th>Subject</th>
                <th>Assesment Score</th>                                
                <th>Exam Score</th>
            </tr>    
        </thead>    
        <tbody>
        
            <?php
            $counter=0;
            while($row=mysqli_fetch_assoc($result)){ 
                $counter++;
                extract($row);
            ?>
            <tr>
                <td><?php echo $db->getSubjectName1($subject_id);?></td>
                <td class="contact-left"><input type="number" name="member[<?php echo $counter;?>][assesment_score]" value="<?php echo $row['assesment_score'];?>" required=""/></td>  
                <td class="contact-left"><input type="number" name="member[<?php echo $counter;?>][exam_score]"  value="<?php echo $row['exam_score'];?>" required=""/></td>
                <input type="hidden" name="member[<?php echo $counter;?>][result_id]"  value="<?php echo $result_id;?>"/>
            </tr>     
            <?php
            }
            ?>              
        </tbody> 
        <tfoot style="background-color: #000066; color: white; text-align: center;">
        <tr>
        <td colspan="3">&nbsp;</td>
        </tr>
        </tfoot>
        
        </table>
        <input type="submit" name="action" value="Modify Result" style="font-weight: bolder; background-color: #000066; color: white;"/>
   </form>
 </div>
 <div class="col-md-2"></div>
</div>    
        
      <?php 
      
       }  
  
  }
  
  
require_once'footer1.php';
?>