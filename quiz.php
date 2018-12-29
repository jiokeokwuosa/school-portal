<?php
require_once'header1.php';

if(isset($_GET['subject_id'])){
    $_SESSION['subject_id']=$_GET['subject_id'];
}
if(!isset($_SESSION['login'])){
   header('location:index.php');    
}else{     
     extract($_SESSION);
     if(!isset($subject_id)){
        header('location:index1.php');
        
     }
          
     $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
     $db->connect();
     $result=$db->select('exam_question',array('subject_id'=>$subject_id));
    
      
        if(!isset($_SESSION['question'])){
            $_SESSION['question']=0;
            $_SESSION['true_answer']=0;        
        }else{
            if(isset($_POST['action']) and $_POST['action']=='Next Question' and isset($_POST['your_answer'])){
              mysqli_data_seek($result,$_SESSION['question']);
              $row= mysqli_fetch_assoc($result);  
              extract($row);  
              
                  if($_POST['your_answer']==$true_answer){
                     $_SESSION['true_answer']=$_SESSION['true_answer']+1;
                  }                    
              
              $_SESSION['question']=$_SESSION['question']+1;
           
            }elseif(isset($_POST['action']) and $_POST['action']=='Get Result' and isset($_POST['your_answer'])){
                  mysqli_data_seek($result,$_SESSION['question']);
                  $row= mysqli_fetch_assoc($result);  
                  extract($row);  
              
                  if($_POST['your_answer']==$true_answer){
                    $_SESSION['true_answer']=$_SESSION['true_answer']+1;
                  } 
              $_SESSION['question']=$_SESSION['question']+1;
              ?>
                  <div class="row">
                    <div class="col-md-4">     </div>
                    
                    <div class="col-md-4"> 
                    
                    <table class="table table-striped table-hover">
                        <thead style="background-color: #000066; color: white;">
                            <tr>
                                <th colspan="2">Result</th>
                            </tr>    
                        </thead>    
                        <tbody>
                         <tr>   
                            <td>Total Question:</td>
                            <td><?php echo $_SESSION['question'];?></td>
                         </tr> 
                         <tr>   
                            <td>Total No of Correct Answers:</td>
                            <td><?php echo $_SESSION['true_answer'];?></td>
                         </tr> 
                         <tr>   
                            <td>Total No of Wrong Answers:</td>
                            <td><?php echo $_SESSION['question']-$_SESSION['true_answer'];?></td>
                         </tr>                                   
                        </tbody> 
                        <tfoot style="background-color: #000066; color: white; text-align: center;">
                        <tr>
                        <td colspan="2">Dear, you scored <?php echo $_SESSION['true_answer'].'/'.$_SESSION['question'];?></td>
                        </tr>
                        </tfoot>
                        
                    </table> 
                    <h6 class="title clearlink"><a href="review.php?subject_id=<?php echo $subject_id;?>">Review Questions<br />click</a> </h6>     
                    
                    </div>
                    
                    <div class="col-md-4">     </div>
                  
                  
                  </div>
                  
                  
                  
                  
                  <?php
                    $result=$db->select('exam_subject_list',array('subject_id'=>$_SESSION['subject_id'])); 
                    if($result){
                        $row=mysqli_fetch_assoc($result);
                        extract($row);
                    }  
                    $db->insert('exam_result',array('reg_number'=>$_SESSION['reg_number'],'subject_id'=>$subject_id,'score'=>$_SESSION['true_answer'],'creator_id'=>$creator_id));
            
                    unset($_SESSION['question']);
    				unset($_SESSION['subject_id']);
    				unset($_SESSION['true_answer']);
    				exit;
                  
              
                }
            
            
            
            
            
            
         }

     
     
     
     
  }










mysqli_data_seek($result,$_SESSION['question']);
$row= mysqli_fetch_assoc($result);  
extract($row);
$no=$_SESSION['question']+1;
?>
<form action="quiz.php" method="post">
<h6 class="title">Test</h6><br />
<div class="row">
    <div class="col-md-3"></div>
    
    
   
    <div class="col-md-6 style2 user-agileits">
        
         <p style="font-family: font2; font-size: 20px;">  Question <?php echo $no;?>:</p><br />
         <p><?php echo ucfirst($questions);?></p>
         <br />
              
            <div class="row style8">
                <div class="col-md-6">
                <input type="radio" style="margin-bottom: 20px;" name="your_answer" value="option1"/> <?php echo  ucfirst($option1);?><br />
                <input type="radio" style="margin-bottom: 20px;" name="your_answer" value="option3" /> <?php echo  ucfirst($option3);?>
                </div>
                
                <div class="col-md-6">
                <input type="radio" style="margin-bottom: 20px;" name="your_answer" value="option2"/> <?php echo  ucfirst($option2);?><br />
                <input type="radio" style="margin-bottom: 20px;" name="your_answer" value="option4"/> <?php echo  ucfirst($option4);?>
                </div>
            
            </div> 
            
                       
            <div class="row">
                <div class="col-md-12 contact-left1">
                <?php 
                if($_SESSION['question']<$db->numRow()-1){
                  echo'<input type="submit" name="action" value="Next Question"/>';  
                }else{
                  echo'<input type="submit" name="action" value="Get Result"/>';  
                   }                
                ?>
                
                
                </div>
            
            </div>     
        
    </div> 
    
    
    
  
    
    <div class="col-md-3"></div>


</div>

</form>


<?php
require_once'footer1.php';
?>