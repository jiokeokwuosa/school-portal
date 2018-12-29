<?php
    
    require_once'functions.php';
    session_start();
    ob_start();
    
    define("DBHOST", $_SERVER['HTTP_HOST']);
    
    if (DBHOST === "localhost") {
    define("DBUSER", "christ4life");
    define("DBPASSWORD", "");
    define("DBNAME", "school1");
    } else {
        define("DBUSER", "godslov1_christ4life");
        define("DBPASSWORD", "christ4life123/");
        define("DBNAME", "godslov1_school1");
    }
    
    
    if(! isset($_SESSION['login'])){
        $_SESSION['page']='index1.php';
        header('Location:login.php');
    }
    
    if(isset($_SESSION['reg_number'])){
        $dir='D:\xampp\htdocs\school portal\image';
        $path=$dir.'\\'.$_SESSION['reg_number'].'.jpg';
        if(file_exists($path)){
            $src=$_SESSION['reg_number'].'.jpg';    
        }else{
           $src='none.png';
          }         
    }
    
       $title='';     
       $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
       $db->connect();
       $title=$db->getAccessName($_SESSION['access_level']);
       $access_level=$_SESSION['access_level'];
       
       $result1=$db->select('structure');
        if($result1){
              while($row=mysqli_fetch_assoc($result1)) {
                $admin[$row['constant']]['title']=$row['title']; 
                $admin[$row['constant']]['value']=$row['value'];
              }          
        }else{
           die('Resources not Available');  
          }
    
?> 
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Owner" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

	<title>Portal</title>
    
    <link rel="icon" href="images/logo.png" />
    <link  href="css/style.css" rel="stylesheet" media="all" />
    <link  href="css/bootstrap.min.css" rel="stylesheet" media="all" />   
    <link href="css/font-awesome.css" rel="stylesheet"/>    
    <link rel="stylesheet" href="css/alertify.min.css" media="all"/>
    <link rel="stylesheet" href="css/default.min.css" media="all"/>
    <link rel="stylesheet" href="css/semantic.css" media="all"/>

    
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/alertify.min.js"></script>
    <script src="js/script.js"></script>
  </head>
<body>
<header id="header2">
    <div class="container">
      <div class="row">
        <div class="col-md-6"><br />
         <a href="index.php"><img src="images/banner.png" width="80%" class="img-responsive"/></a>
         Hello, Your Reg Number is <?php echo $_SESSION['reg_number'];?>
        </div>
        <div class="col-md-6 right clearlink">
        <br />
        <a href="index.php">Home</a>
   <a href="uploadpix.php"> <img src="image/<?php echo $src;?>" class="img-responsive" style="width: 50px; height: 50px; border-radius: 50%; float: right;" alt=""/></a>
      | <a href="transact.php?action=logout">LogOut</a>
         
        </div>
      
      </div>
    </div>
</header>
<div class="container-fluid divider"><h4 style="color: white; text-align: center;"><marquee><h5 style="font-family: font1, font2;line-height: auto;">Welcome to our School Portal</h5></marquee> </div><br />
<div class="container-fluid">
<div class="row">
        <div class="col-md-3 user-agileits clearlink"  style="color: #333399;">
        <h6 class="title"><?php echo $title;?>'s Dashboard</h6><br />
   <a href="index1.php"><i class="glyphicon glyphicon-home" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Home</a><br />
<?php if($access_level>3){?>
         <a href="session.php"><i class="glyphicon glyphicon-calendar" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Session</a><br />
         <a href="admin.php"><i class="glyphicon glyphicon-user" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Admin</a><br />
         <a href="structure.php"><i class="glyphicon glyphicon-cog" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Structure</a><br />
  <?php } ?>
<?php if($access_level>2){?>  
        <a href="class.php"><i class="glyphicon glyphicon-th-large" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Classes</a><br />
        <a href="subject.php"><i class="glyphicon glyphicon-th-list" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Subject</a><br />
        <a href="approve.php"><i class="glyphicon glyphicon-ok" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Approve Accounts</a><br />
        <a href="teachers.php"><i class="glyphicon glyphicon-user" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Teachers</a><br />
        <a href="students.php"><i class="glyphicon glyphicon-user" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Students</a><br />
        
 <?php }?>
 
<?php if($access_level==2){?><a href="classmates.php"><i class="glyphicon glyphicon-user" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;My Students</a><br /><?php }?>
<?php if($access_level>1){?><a href="elibrary.php"><i class="glyphicon glyphicon-book" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;E-Library</a><br />
<a href="result.php"><i class="glyphicon glyphicon-envelope" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Results</a><br />
<a href="text.php"><i class="glyphicon glyphicon-cloud-upload" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Set Test</a><br />
<a href="myquiz.php"><i class="glyphicon glyphicon-tree-conifer" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;My Test(s)</a><br />
<a href="testresult.php"><i class="glyphicon glyphicon-paperclip" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Test Results</a><br />
 <a href="notify.php"><i class="glyphicon glyphicon-bullhorn" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Notification</a><br /><?php }?>
<?php if($access_level==1){?><a href="myresult.php"><i class="glyphicon glyphicon-eye-open" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;My Result</a><br />
         <a href="classmates.php"><i class="glyphicon glyphicon-thumbs-up" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;View Classmates</a><br />
           <a href="taketest.php"><i class="glyphicon glyphicon-pencil" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Take Test</a><br />
         <a href="index.php"><i class="glyphicon glyphicon-gbp" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;School Fees</a><br /><?php }?>        
         <a href="forum.php"><i class="glyphicon glyphicon-comment" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;ChartRoom</a><br />
         <a href="signup.php"><i class="glyphicon glyphicon-user" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Update Profile</a><br />
        <a href="uploadpix.php"><i class="glyphicon glyphicon-camera" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile Pix</a><br />
        <a href="changepassword.php"><i class="glyphicon glyphicon-lock" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Change Password</a><br />
         <a href="contactus.php"><i class="glyphicon glyphicon-user" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Contact Us</a><br />
        <a href="transact.php?action=logout"><i class="glyphicon glyphicon-log-out" style="margin-bottom: 13px;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a><br />
             
       
        </div>
        
        <div class="col-md-9"><h4 class="title"><?php echo $title;?>'s Dashboard</h4>
        
        
    
         
    
      



