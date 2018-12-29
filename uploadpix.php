<?php
require_once'header1.php';

if(! isset($_SESSION['login'])){
   header('location:login.php'); 
}
?>

<form action="transact.php" method="post" enctype="multipart/form-data" name="picture" onsubmit="return checkPicture();">
<div class="row">
<div class="center"><span id="titleImageError"></span></div>
<?php 
if(isset($_SESSION['a'])){
  echo("<div class='alert alert-danger center' role='alert'>
        <strong>Oops!</strong>
        <br/>Please select image of type: .gif, .png, .jpg, .jpeg
       </div>");
  unset($_SESSION['a']);
}elseif(isset($_SESSION['b'])){
      echo("<div class='alert alert-success center' role='alert'>
            <strong>Congratulations!</strong>
            <br/>Your Picture has been Saved Successfully.
           </div>");
      unset($_SESSION['b']);
    }elseif(isset($_SESSION['c'])){
          echo("<div class='alert alert-danger center' role='alert'>
                <strong>Oops!</strong>
                <br/>Error Saving Image
               </div>");
          unset($_SESSION['c']);
        }elseif(isset($_SESSION['d'])){
             $error=$_SESSION['d'];
             echo("<div class='alert alert-danger center' role='alert'>
                    <strong>Oops!</strong>
                    <br/>$error
                 </div>");
             unset($_SESSION['d']);
          }

?>
<h6 class="title">Profile Picture</h6>
 <div class="col-md-4"></div>
 
 <div class="col-md-4 user-agileits contact-left cont" style="text-align: center;">
 
     <div id="image-holder">
               <img src="image/<?php echo $src;?>"  width="80%" style="border-radius: 48.5%;"/>
     </div>
     <br /> <br />
     
     <input type="file" id="titleImage" name="titleImage" style="display: none;" required="" />
     <label for="titleImage" class="button">Upload Image</label><br />
     
     
     <input type="submit" name="action" value="Save Image" style="display: none;" id="submitImage" />
     <label for="submitImage" class="button">Save Image</label>
 
 </div>
 
 <div class="col-md-4"></div>



</div>

</form>



<?php
require_once'footer1.php';
?>
