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
                   
        }else{
            if(isset($_POST['action']) and $_POST['action']=='Next Question'){
              
              $_SESSION['question']=$_SESSION['question']+1;
           
            }elseif(isset($_POST['action']) and $_POST['action']=='Done'){
                
                    unset($_SESSION['question']);
    				unset($_SESSION['subject_id']);    				
    				header('location:index1.php');
                               
                }
            
            
            
            
            
            
         }

     
     
     
     
  }

mysqli_data_seek($result,$_SESSION['question']);
$row= mysqli_fetch_assoc($result);  
extract($row);
$no=$_SESSION['question']+1;
?>
<form action="review.php" method="post">
<h6 class="title">Review Answered Questions</h6><br />
<div class="row">
    <div class="col-md-3"></div>
    
    
   
    <div class="col-md-6 style2 user-agileits">
        
         <p style="font-family: font2; font-size: 20px;">  Question <?php echo $no;?>:</p><br />
         <p><?php echo ucfirst($questions);?></p>
         <br />
              
            <div class="row">
                <div class="col-md-6">
               <p class="<?php echo ($true_answer=='option1')?'correct':'style8';?>"> <?php echo  ucfirst($option1);?></p><br />
               <p class="<?php echo ($true_answer=='option3')?'correct':'style8';?>" style="margin-bottom: 25px;"> <?php echo  ucfirst($option3);?></p>
                </div>
                
                <div class="col-md-6">
                <p class="<?php echo ($true_answer=='option2')?'correct':'style8';?>"> <?php echo  ucfirst($option2);?></p><br />
                <p class="<?php echo ($true_answer=='option4')?'correct':'style8';?>"> <?php echo  ucfirst($option4);?></p>
                </div>
            
            </div> 
            
                       
            <div class="row">
                <div class="col-md-12 contact-left1">
                <?php 
                if($_SESSION['question']<$db->numRow()-1){
                  echo'<input type="submit" name="action" value="Next Question"/>';  
                }else{
                  echo'<input type="submit" name="action" value="Done"/>';  
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