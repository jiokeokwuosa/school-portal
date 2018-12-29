<?php
require_once'header.php';
?>
<div class="banner-w3agile" style="background: url(images/img14.jpg) no-repeat 0px 0px; background-size: cover;">
	<div class="container clearlink">
		<h3><a href="index.php">Home</a> / <span>Contact Us</span></h3>
	</div>
</div>
<br /><br />
<div class="container">
     <h4 class="title">Contact Us</h4><br />
 <div class="row user-agileits1">
     <div class="col-md-4 contact-left">
     		<div class="contct-info">
        		<h6 class="title"> Contact Information</h6>
			<p class="justify"><?php echo $admin['mission']['value'];?> You can get us with the details below.
            <ul style="list-style: none; padding-left: 0px;">
				<li>Phone : <?php echo $admin['phone']['value'];?></li>
                <li>Address : <?php echo $admin['address']['value'];?></li>				
				<li>Email : <a href="mailto:<?php echo $admin['email']['value'];?>"><?php echo $admin['email']['value'];?></a></li>
			</ul>
		</div>
	</div>
    
    <div class="col-md-8 contact-left cont">
    <a name="failure"></a>
		<div class="contct-info">
			<h6 class="title">Contact Form</h6>
            <?php
            if(isset($_SESSION['a'])){
             $error=$_SESSION['a'];
             echo("<div class='alert alert-danger center' role='alert'>
                    <strong>Oops!</strong>
                    <br/>$error
                 </div>");
             unset($_SESSION['a']);
            }elseif(isset($_SESSION['b'])){
                echo("<div class='alert alert-success center' role='alert'>
                    <strong>Congratulations!!!</strong>
                    <br/>Mail Sent Successfully.
                 </div>");
                unset($_SESSION['b']);
              }elseif(isset($_SESSION['c'])){
                echo("<div class='alert alert-danger center' role='alert'>
                    <strong>Oops!</strong>
                    <br/>Error Occured!.
                 </div>");
                unset($_SESSION['c']);
              }
            ?>
            
			<form action="transact.php" method="post" name="contact" onsubmit="return checkContact();">
				<div class="row">
					<div class="col-md-6" style="margin-bottom: 20px;">
					   <input type="text" name="full_name" placeholder="Your Full Name"/>
					</div>
					<div class="col-md-6">
	                   <input type="text" name="reg_number" placeholder="Reg Number"/>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-6" style="margin-bottom: 20px;">
					   <input type="text" name="subject" placeholder="Subject"/>
					</div>
					<div class="col-md-6" style="margin-bottom: 20px;">
					   <input type="text" name="phone_number" placeholder="Phone number"/>
					</div>
					<div class="clearfix"></div>
				</div>
				<textarea placeholder="Message" name="message" ></textarea>
				<input type="submit" value="Send Message" name="action" />
				<input type="reset" value="Clear" />
			</form>
		</div>
	</div>
 </div> 
</div><br /><br />

<?php
require_once'footer.php';
?>
