<?php
require_once'header1.php';

if(isset($_SESSION['status'])){
    unset($_SESSION['status']);
}

if($_SESSION['access_level']<2){
   header('Location:login.php');
}

$_SESSION['question_no']=1;
?>
<form action="transact.php" method="post">
<div class="row">
<h6 class="title">Upload Quiz (Step 1)</h6>
<?php
if(isset($_SESSION['a'])){
  echo("<div class='alert alert-danger center' role='alert'>
        <strong>Oops!</strong>
        <br/>Data already Exist: Delete Existing text
       </div>");
  unset($_SESSION['a']);
}


?>
 <div class="col-md-6 contact-left cont">
    <input type="text" name="name" placeholder="Enter Subject Name" style="margin-bottom: 20px;" required=""/>
 </div>
 
 <div class="col-md-6 contact-left cont">
     <select name="class_id" required="">
     <?php
        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
        $db->connect();
        echo  $db->listClasses();     
     ?>
     </select> 
 </div>
</div>

<div class="row">
    <div class="col-md-4">   </div>
    <input type="hidden" name="creator_id" value="<?php echo $_SESSION['reg_number'];?>" />
    <div class="col-md-4 contact-left1 cont"><input type="submit" name="action" value="Proceed" />   </div>
    <div class="col-md-4">   </div>
</div>
</form>
<?php
require_once'footer1.php';
?>






