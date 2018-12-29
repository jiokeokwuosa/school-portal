<?php
require_once'header1.php';
$status='';
if(isset($_SESSION['status'])){
 $status='none';   
}

if($_SESSION['access_level']<2){
   header('Location:login.php');
}

?>


<h6 class="title">Set <?php echo $_SESSION['subject'];?> Quiz? you have to Set 10 question in all</h6>
<?php 
    if(isset($_SESSION['c'])){
      echo("<div class='alert alert-success center' role='alert'>
            <strong>Congratulations</strong>
            <br/>Test has been set Successfully
           </div>");
      unset($_SESSION['c']);
    }

?>
<form action="transact.php" method="post" name="question" onsubmit="return checkQuestion();" style="display: <?php echo $status;?>;">
    <div class="row">
        <div class="col-md-4"></div>
        
        <div class="col-md-4 contact-left cont">
        <?php
            if(isset($_SESSION['a'])){
              echo("<div class='alert alert-danger center' role='alert'>
                    <strong>Oops!</strong>
                    <br/>Please Enter the Question
                   </div>");
              unset($_SESSION['a']);
            }elseif(isset($_SESSION['b'])){
                  echo("<div class='alert alert-danger center' role='alert'>
                        <strong>Oops!</strong>
                        <br/>Unable to Set Question
                       </div>");
                  unset($_SESSION['b']);
              }
        ?>
            <textarea name="questions">        
            </textarea>
            <h6 class="title">Enter Question <?php echo $_SESSION['question_no'];?></h6>
        </div>
        
        <div class="col-md-4"></div>
    </div>
    
    <div class="row">
        <div class="col-md-3 contact-left cont">
          <input type="text" name="option1" placeholder="Option 1" required="" style="margin-bottom: 20px;"/>        
        </div>
        
        <div class="col-md-2 contact-left cont">
          <input type="text" name="option2" placeholder="Option 2" required="" style="margin-bottom: 20px;"/>        
        </div>
        
        <div class="col-md-2 contact-left cont">
          <input type="text" name="option3" placeholder="Option 3" required="" style="margin-bottom: 20px;"/>        
        </div>
        
        <div class="col-md-2 contact-left cont">
          <input type="text" name="option4" placeholder="Option 4" required="" style="margin-bottom: 20px;"/>        
        </div>
        
        <div class="col-md-3 contact-left cont">
        <input type="hidden"  name="subject_id" value="<?php echo $_SESSION['subject_id'];?>"/>
        
         <select name="true_answer" required="">
            <option value="">Select Answer</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
         
         </select>      
        </div>
    
    
    </div>
    
    
    <div class="row">
        <div class="col-md-5"></div>
        
        <div class="col-md-2 contact-left1 cont">
            <input type="submit" name="action" value="Set Question" />
        </div>
        
        <div class="col-md-5"></div>
    </div>
</form>

















<?php
require_once'footer1.php';
?>