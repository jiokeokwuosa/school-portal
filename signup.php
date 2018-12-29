<?php
require_once'header.php';

$reg_number='';
$first_name='';
$last_name='';
$phone_number='';
$gender='';
$class_id='';
$access_level='';

if(isset($_SESSION['login']) and isset($_SESSION['reg_number'])){
    $reg_number=$_SESSION['reg_number'];
        if(isset($_GET['key'])){
            $reg_number=$_GET['key'];
        }
    $title='Modify Account';
    $title1='Modify Account';
    $button='Modify';
    
    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    $db->connect();
    $result=$db->select('user_info_table',array('reg_number'=>$reg_number));
        if($result){
            $row=mysqli_fetch_assoc($result);
            extract($row);
            
        }else{
            die('Error Occured');
          }
    
}else{
    $title='Register'; 
    $title1='SignUp';
    $button='Register';
  }
?>
<div class="banner-w3agile" style="background: url(images/img12.jpg) no-repeat 0px 0px; background-size: cover;">
	<div class="container clearlink">
		<h3><a href="index.php">Home</a> / <span><?php echo $title1;?></span></h3>
	</div>
</div>
<br /><br />

<div class="container">
<a name="success"></a>
<h4 class="title"><?php echo $title;?></h4><br /><br />
     <form action="transact.php" method="post" name="register" <?php if(!isset($_SESSION['login'])){?>onsubmit="return checkRegister();"<?php } else{?> onsubmit="return checkModify();"<?php }?>>
       <div class="row">
           <div class="col-md-4">     </div>
           <div class="col-md-4 center contact-left cont user-agileits1"> 
                      <h6 class="title">User Info.</h6>
                      
                <?php
                 if(isset($_SESSION['a'])){
                    echo('<div class="alert alert-success center" role="alert">
                            <strong>Congratulations!</strong>
                            <br/>Account was created successfully but is subject to approval by the Admin.
                         </div>');
                    unset($_SESSION['a']);
                 }elseif(isset($_SESSION['b'])){
                      echo('<div class="alert alert-danger center" role="alert">
                            <strong>Oops!</strong>
                            <br/>Error Occured.
                         </div>');
                      unset($_SESSION['b']);
                    }elseif(isset($_SESSION['c'])){
                         $error=$_SESSION['c'];
                         echo("<div class='alert alert-danger center' role='alert'>
                                <strong>Oops!</strong>
                                <br/>$error
                             </div>");
                         unset($_SESSION['c']);
                        }elseif(isset($_SESSION['d'])){
                                    echo("<div class='alert alert-danger center' role='alert'>
                                        <strong>Oops!</strong>
                                        <br/>Reg Number already in use, please contact admin.
                                        </div>");
                                    unset($_SESSION['d']);
                             }elseif(isset($_SESSION['e'])){
                                    echo("<div class='alert alert-success center' role='alert'>
                                        <strong>Congratulations!</strong>
                                        <br/>Account Updated Successfully.
                                        </div>");
                                    unset($_SESSION['e']);
                             }
                ?>
                <?php if(! isset($_SESSION['login']) or (isset($_SESSION['access_level']) and $_SESSION['access_level']==3)){ ?>
	            <input type="text" name="reg_number" placeholder="Reg. Number" value="<?php echo $reg_number;?>" style="margin-bottom: 20px;"/>
			           <br /> 
                <?php }?> 
                <?php if(! isset($_SESSION['login'])){?>              
                <input type="password" name="password1" placeholder="Password"  style="margin-bottom: 20px;"/>
                       <br />
                <input type="password" name="password2" placeholder="Confirm Password"  style="margin-bottom: 20px;"/>
                       <br />
                <?php }else{
                         echo"<input type='hidden' name='reg_number' value=$reg_number>";                       
                        }?>
                        
                <input type="text" name="first_name" placeholder="First Name"  style="margin-bottom: 20px;" value="<?php echo $first_name;?>"/>
			           <br />                
	            <input type="text" name="last_name" placeholder="Last Name" style="margin-bottom: 20px;" value="<?php echo $last_name;?>"/>
			           <br />                
                <input type="text" name="phone_number" placeholder="You or Parent's Phone Number" style="margin-bottom: 20px;" value="<?php echo $phone_number;?>"/>
			           <br />
                <select name="gender" style="margin-bottom: 20px;">
                    <option value="">Select Gender</option>
                    <option value="male" <?php if($gender=='male'){echo"selected=selected";}?> >Male</option>
                    <option value="female" <?php if($gender=='female'){echo"selected=selected";}?>>Female</option>                               
                </select>
                <br />
                <?php if(! isset($_SESSION['login']) or (isset($_SESSION['access_level']) and $_SESSION['access_level']>3)){ ?>
                <select name="access_level" style="margin-bottom: 20px;" class="selectOption">
                   <?php
                    
                       $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                       $db->connect();
                       echo $db->listAccessLevel($access_level);         
                   
                   ?>               
                </select>
                <br />
                <?php }?>
                
                <select id="class_id" name="class_id" class="classes <?php echo ($class_id !='')? null:"hide"?>" style="margin-bottom: 20px;">
                    <?php                     
                    echo $db->listClasses($class_id);?>                                      
                </select>
                <br />
                <script>
                
                            
                </script>
                
                
                <input type="submit" name="action" value="<?php echo $button;?>" style="margin-right: 5px; float: left;"/>
    			<input type="reset" value="Clear" style="float: left;" />    <br />  
                </form>     
                 <?php
                  if(isset($_SESSION['access_level']) and $_SESSION['access_level']>1){
                    echo"<h6 class=title>$password1.</h6>";
                  }
                 ?>
                        
           </div>
           <div class="col-md-4"> </div>
       
       </div>
      				
       
</div><br /><br /><br />

<?php
require_once'footer.php';
?>