<footer id="links" class="divide">
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 footer-grid justify">
        		 <h3 style="font-family: font1, font2;">About Us</h3><br />
        		<p>God's love College is a citadel of learning, here we focus on learning, students will be oriented to use their education to solve pratical problems confronting them in the Nigeria
            society and beyound.</p>
	        </div>
            <div class="col-md-3">
                    <h3 style="font-family: font1, font2;">Quick Links</h3><br />
                    <div class="newspaper">
                        <ul style="list-style: none; clear: both; padding-left: 0px;" class="clearlink">
                            <li class="linespace"><a href="index.php">Home</a></li>
                            <li class="linespace"><a href="aboutus.php">About Us</a></li>
                            <li class="linespace"><a href="about.php#programme">Programmes</a></li>
                            <li class="linespace"><a href="about.php#staff">Staff</a></li>
                            <li class="linespace"><a href="library.php">E-Library</a></li>
                            <li class="linespace"><a href="forum.php">Forum</a></li>
                            <li class="linespace"><a href="contactus.php">Contact-us</a></li>
                            
                        </ul>
                    </div>
              </div>
              
              <div class="col-md-2">
                    <h3 style="font-family: font1, font2;">My Account</h3><br />
                       <ul style="list-style: none;padding-left: 0px;" class="clearlink">
                            <li class="linespace"><a href="index1.php">Portal</a></li>
                            <li class="linespace"><a href="login.php">Login</a></li>
                            <li class="linespace"><a href="signup.php">Signup</a></li>                                                       
                       </ul>
                    
              </div>
              
              <div class="col-md-3">
                <h3 style="font-family: font1, font2;">Information</h3><br />
					<ul style="list-style: none;padding-left: 0px;" class="clearlink">
						<li class="linespace"><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>  <?php echo $admin['address']['value'];?></li>
						<li class="linespace"><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>  <?php echo $admin['phone']['value'];?></li>
						<li class="linespace"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>  <a href="mailto:<?php echo $admin['email']['value'];?>"><?php echo $admin['email']['value'];?></a></li>
			        </ul>
              
              </div>
        
        </div>
    
    </div>
    
</footer>

<footer id="footer2">
    
    <div class="copy-section handle-overflow">
        <div class="social-icons">
        	<a href="#"><i class="icon1"></i></a>
        	<a href="#"><i class="icon2"></i></a>
        	<a href="#"><i class="icon3"></i></a>
        	<a href="#"><i class="icon4"></i></a>
        </div>

    <div class="footer-logo" style="margin-bottom: 20px;">
        <h2 style="font-family: font1, font2;"><a href=""><?php echo $admin['name']['value'];?><span>...education is the key</span></a></h2>
    </div>
    <div class="text-center" style="margin-bottom: 20px;">
        <p style="font-family: font3;">
            <?php echo $admin['copyright']['value'];?>
        </p>
    </div>
    <div class="clearfix"></div>

</div>

</footer>
</body>
</html>