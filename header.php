<?php
    session_start();
   
    require_once'functions.php';
    
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

    
    if(isset($_SESSION['reg_number'])){
        $dir='D:\xampp\htdocs\school portal\image';
        $path=$dir.'\\'.$_SESSION['reg_number'].'.jpg';
        if(file_exists($path)){
            $src=$_SESSION['reg_number'].'.jpg';    
        }else{
           $src='none.png';
          }         
    }
    
    
    
    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    $db->connect();
    $result=$db->select('notification',array(), array('notify_id'=>'DESC'),'4');
    if($result){
        $message1=array();
        $i=0;
        
       while($row=mysqli_fetch_assoc($result)){
        extract($row);
        $message1[$i]=$message;
        $i++;
       }
       
    }
    
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
	<title>God's Love Institution</title>
    <link rel="icon" href="images/logo.png" />
    <link  href="css/style.css" rel="stylesheet" media="all" />
    <link  href="css/bootstrap.min.css" rel="stylesheet" media="all" />
    <link  href="css/smartmenus.css" rel="stylesheet" media="all" />
    <link  href="css/simple.css" rel="stylesheet" media="all" />
    <link rel="stylesheet" href="css/ken-burns.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/animate.min.css" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet"/>    
    <link rel="stylesheet" href="css/alertify.min.css" media="all"/>
    <link rel="stylesheet" href="css/default.min.css" media="all"/>
    <link rel="stylesheet" href="css/semantic.css" media="all"/>

    
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cycle2.js"></script>
    <script src="js/smartmenus.js"></script>
    <script src="js/alertify.min.js"></script>
    <script src="js/script.js"></script>
    
</head>

<body>
<header id="header1">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <b class="org" style="float: left;">Latest Updates ::&nbsp;&nbsp;</b>
                <div class="cycle-slideshow clearLink" data-cycle-slides=">div" data-cycle-timeout="2000" style="float: left; width: 60%;">
                    <div class="clearlink">
                     <a href=""> <?php if(!empty($message1[0])){echo $message1[0];}else{ echo 'Welcome to Gods Love College';}?> </a>
                    </div>
                    
                    <div class="clearlink">
                     <a href=""> <?php if(!empty($message1[1])){echo $message1[1];}else{ echo 'For God So loved the world... ';}?> </a>
                    </div>
                    
                    <div class="clearlink">
                     <a href=""> <?php if(!empty($message1[2])){echo $message1[2];}else{ echo 'Jesus Died for You';}?> </a>
                    </div>
                    
                    <div class="clearlink">
                     <a href=""> <?php if(!empty($message1[3])){echo $message1[3];}else{ echo 'We Love you!';}?> </a>
                    </div>
        
                </div>
            
            </div>
            
            <div class="col-md-6 right">
            <i class="glyphicon glyphicon-time"></i>
             <?php 
        		//$time=time();
        		$actualtime=date('F j, Y', strtotime('now'));
        		echo $actualtime;
        	 ?>&nbsp;&nbsp;&nbsp;
             <i class="glyphicon glyphicon-map-marker"></i> <?php echo $admin['address']['value'];?>
            </div>
        
        </div>
    </div>
</header>


<header id="header2">
    <div class="container">
      <div class="row">
        <div class="col-md-6"><br />
         <a href="index.php"><img src="images/banner.png" width="80%" class="img-responsive"/></a>
        </div>
        <div class="col-md-6 right clearlink">
        <br />
        <a href="index1.php">Portal</a>
       <?php if(!isset($_SESSION['login'])){?>|<a href="login.php"> Login</a> | <a href="signup.php">Create Account</a><?php }?>
       <?php if(isset($_SESSION['login'])){?>
    <a href="uploadpix.php"><img src="image/<?php echo $src;?>" class="img-responsive" style="width: 50px; height: 50px; border-radius: 50%; float: right;" alt=""/></a>
      | <a href="transact.php?action=logout">LogOut</a>
       <?php }?>
        
        </div>
      
      </div>
    </div>




</header>

<nav id="nav1">
    <div class="container">
       <nav id="main-nav">
                <!-- Mobile menu toggle button (hamburger/x icon) -->
                <input id="main-menu-state" type="checkbox" />
                <label class="main-menu-btn" for="main-menu-state">
                  <span class="main-menu-btn-icon"></span> Toggle main menu visibility
                </label>
             <ul id="main-menu" class="sm sm-simple">
            	<li><a href="index.php">Home</a></li>            	
            	<li><a href="about.php">About</a></li>
            	<li><a href="about.php#programme">Programmes</a></li>			
               	<li><a href="library.php">E-Library</a></li>
                <li><a href="forum.php">ChatRoom</a></li>			
                <li><a href="contactus.php">Contact Us</a></li>
             </ul>
        </nav>    
    </div>
</nav>
<script>
       $(function(){
        $('#main-menu').smartmenus();
        
       });
       
       $(function() {
          var $mainMenuState = $('#main-menu-state');
          if ($mainMenuState.length) {
            // animate mobile menu
            $mainMenuState.change(function(e) {
              var $menu = $('#main-menu');
              if (this.checked) {
                $menu.hide().slideDown(250, function() { $menu.css('display', ''); });
              } else {
                $menu.show().slideUp(250, function() { $menu.css('display', ''); });
              }
            });
        // hide mobile menu beforeunload
            $(window).on('beforeunload unload', function() {
              if ($mainMenuState[0].checked) {
                $mainMenuState[0].click();
              }
            });
          }
        });
</script>    



