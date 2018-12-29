<?php
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
//you can generate 100 by 100

//Unizik screening Science
/*

$db=new Database(DBHOST,DBUSER,'','screeningtest');
$db->connect();

for($i=100;$i>=1;$i--){
    $password=strtoupper(substr(sha1(time()),rand(0,36),4)); 
    $password.=strtoupper(substr(sha1(time()),rand(0,36),4));
       
    $result=$db->select('unizik018',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('unizik018',array('passcode'=>$password));
     }   
   
}
echo'done';
*/

//Unizik screening Art
/*
$db=new Database(DBHOST,DBUSER,'','screeningtest');
$db->connect();

for($i=20;$i>=1;$i--){
    $password=strtoupper(substr(sha1(time()),rand(0,35),5));
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3)); 
        
    $result=$db->select('unizikart018',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('unizikart018',array('passcode'=>$password));
     }   
   
}
echo'done';
*/


//Unilorin screening
/*
$db=new Database(DBHOST,DBUSER,'','screeningtest');
$db->connect();

for($i=100;$i>=1;$i--){
    $password=strtoupper(substr(sha1(time()),rand(0,36),4));
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3)); 
        
    $result=$db->select('unilorin018',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('unilorin018',array('passcode'=>$password));
     }   
   
}
echo'done';

*/


//Jamb Government
/*
$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='G';
    $password.=strtoupper(substr(sha1(time()),rand(0,39),1));    
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));
    $password.=strtoupper(substr(sha1(time()),rand(0,35),5));
    $password.='A';
    
        
    $result=$db->select('government',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('government',array('passcode'=>$password));
     }   
   
}
echo'done';
*/

//Jamb CRK
/*
$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='C';
    $password.=strtoupper(substr(sha1(time()),rand(0,38),2));    
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));
    $password.=strtoupper(substr(sha1(time()),rand(0,36),4));
    $password.='B';
    
        
    $result=$db->select('crk',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('crk',array('passcode'=>$password));
     }   
   
}
echo'done';

*/

//Jamb Biology
/*
$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='B';
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));    
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));
    $password.='C';
    
        
    $result=$db->select('biology',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('biology',array('passcode'=>$password));
     }   
   
}
echo'done';

*/

//Jamb Economics
/*
$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='E';
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));    
    $password.=strtoupper(substr(sha1(time()),rand(0,39),1));
    $password.=strtoupper(substr(sha1(time()),rand(0,35),5));
    $password.='D';
    
        
    $result=$db->select('economics',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('economics',array('passcode'=>$password));
     }   
   
}
echo'done';
*/

//Jamb Physics
/*
$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='P';
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));    
    $password.=strtoupper(substr(sha1(time()),rand(0,38),2));
    $password.=strtoupper(substr(sha1(time()),rand(0,36),4));
    $password.='E';
    
        
    $result=$db->select('physics',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('physics',array('passcode'=>$password));
     }   
   
}
echo'done';
*/


//Jamb Commerce
/*
$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='C';
    $password.=strtoupper(substr(sha1(time()),rand(0,35),5));    
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));
    $password.=strtoupper(substr(sha1(time()),rand(0,39),1));
    $password.='F';
    
        
    $result=$db->select('commerce',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('commerce',array('passcode'=>$password));
     }   
   
}
echo'done';
*/

//Jamb Accounts
/*
$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='A';
    $password.=strtoupper(substr(sha1(time()),rand(0,36),4));    
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));
    $password.=strtoupper(substr(sha1(time()),rand(0,38),2));
    $password.='G';
    
        
    $result=$db->select('accounts',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('accounts',array('passcode'=>$password));
     }   
   
}
echo'done';

*/

//Jamb English
/*
$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='E';
    $password.=strtoupper(substr(sha1(time()),rand(0,36),4));    
    $password.=strtoupper(substr(sha1(time()),rand(0,38),2));
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));
    $password.='I';
    
        
    $result=$db->select('english',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('english',array('passcode'=>$password));
     }   
   
}
echo'done';
*/


//Jamb Chemistry
/*
$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='C';
    $password.=strtoupper(substr(sha1(time()),rand(0,37),3));    
    $password.=strtoupper(substr(sha1(time()),rand(0,36),4));
    $password.=strtoupper(substr(sha1(time()),rand(0,38),2));
    $password.='J';
    
        
    $result=$db->select('chemistry',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('chemistry',array('passcode'=>$password));
     }   
   
}
echo'done';
*/

//Jamb literature

$db=new Database(DBHOST,DBUSER,'','pastquestions');
$db->connect();

for($i=100;$i>=1;$i--){
    $password='L';
    $password.=strtoupper(substr(sha1(time()),rand(0,38),2)); 
    $password.=strtoupper(substr(sha1(time()),rand(0,35),5));   
    $password.=strtoupper(substr(sha1(time()),rand(0,38),2));    
    $password.='k';
    
        
    $result=$db->select('literature',array('passcode'=>$password)); 
     if($db->numRow()==0){
        $db->insert('literature',array('passcode'=>$password));
     }   
   
}
echo'done';




?>
