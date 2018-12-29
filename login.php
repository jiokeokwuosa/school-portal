<?php
require_once'header.php';
?>
<div class="banner-w3agile" style="background: url(images/img13.jpg) no-repeat 0px 0px; background-size: cover;">
	<div class="container clearlink">
		<h3><a href="index.php">Home</a> / <span>Login</span></h3>
	</div>
</div>
<br /><br />

<div class="container">
<a name="failure"></a>
<h4 class="title">Login Form</h4><br /><br />
     <form action="transact.php" method="post"  name="login" onsubmit="return checkLogin();">
       <div class="row">
           <div class="col-md-4">     </div>
           <div class="col-md-4 center contact-left cont user-agileits1"> 
                      <h6 class="title">User Info.</h6>
                      <?php
                        if(isset($_SESSION['c'])){
                         $error=$_SESSION['c'];
                         echo("<div class='alert alert-danger center' role='alert'>
                                <strong>Oops!</strong>
                                <br/>$error
                             </div>");
                         unset($_SESSION['c']);
                        }elseif(isset($_SESSION['a'])){
                                echo("<div class='alert alert-danger center' role='alert'>
                                    <strong>Oops!</strong>
                                    <br/>Your Account has not been approved, please contact admin.
                                    </div>");
                                unset($_SESSION['a']);
                            }elseif(isset($_SESSION['b'])){
                                    echo("<div class='alert alert-danger center' role='alert'>
                                        <strong>Oops!</strong>
                                        <br/>Invalid Reg Number/Password
                                        </div>");
                                    unset($_SESSION['b']);
                                }
                        
                        
                      
                      ?>
	            <input type="text" name="reg_number" placeholder="Reg Number"  style="margin-bottom: 20px;"/>
			           <br />               
                
                <input type="password" name="password" placeholder="Password"  style="margin-bottom: 20px;"/><br />
                <select name="access_level" style="margin-bottom: 20px;">
                   <?php
                       $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                       $db->connect();
                       echo $db->listAccessLevel();                   
                   ?>          
                </select>
                <br />
                <input type="submit" name="action" value="Login" style="margin-right: 5px; float: left;" />
    			<input type="reset" value="Clear" style="float: left;" />
                        
           </div>
           <div class="col-md-4"> </div>
       
       </div>
     </form>  
				

</div><br /><br /><br />

<?php
require_once'footer.php';
?>