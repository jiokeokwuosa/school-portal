<?php
require_once'header1.php';

   
if(isset($_POST['action']) and $_POST['action']=='Submit'){
    $passcode=$_POST['pin'];
   
    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    $db->connect(); 
    $result=$db->select('passcode',array('passcode'=>$passcode)); 
     if($db->numRow()==0){
        $_SESSION['a']=true;
     }else{
        $result1=$db->select('record_book',array('passcode'=>$passcode));
         if($db->numRow()==0){
           $_SESSION['passcode']=$passcode;
           header('location:myresult1.php'); 
         }else{
            $_SESSION['b']=true;
           }
       }
}


if(isset($_SESSION['a'])){
 echo("<div class='alert alert-danger center' role='alert'>
        <strong>Oops!</strong>
        <br/>Invalid Pin
     </div>");
 unset($_SESSION['a']);
}elseif(isset($_SESSION['b'])){
     echo("<div class='alert alert-danger center' role='alert'>
            <strong>Oops!</strong>
            <br/>Pin already been used
         </div>");
     unset($_SESSION['b']);
  }
?>
<h6 class="title">Enter Pin Code</h6>
<div class="row">
   <div class="col-md-4"></div>
   
 <form action="valid.php" method="post"> 
   <div class="col-md-4 contact-left cont">
    <input type="text" name="pin" placeholder="Enter Pin"  style="margin-bottom: 10px;" required=""/><br />
    <div class="contact-left1">
     <input type="submit" name="action" value="Submit" style="margin-bottom: 10px;"/>
    </div>   
   </div>
  </form>  
   
   <div class="col-md-4"></div>
</div>


<?php
require_once'footer1.php';
?>