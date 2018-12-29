<?php
require_once'header1.php';

if(!isset($_SESSION['login'])){
    header('location:index.php');
}

    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    $db->connect();
    $result=$db->select('user_info_table',array('reg_number'=>$_SESSION['reg_number']));
     if($result){
        $row=mysqli_fetch_assoc($result);
        $class_id=$row['class_id'];                
     }else{
        echo'Error Occured';
       }
if($_SESSION['access_level']=='1'){
    $title='My Classmates';
}else{
    $title='My Students';
  }
?>
<h6 class="title"><?php echo $title;?></h6>


  <form action="search.php" method="post">
        <div class="row">
           
                    <div class="col-md-3"></div>
    				<div class="col-md-6 contact-left cont center" style="margin-bottom: 20px;"> 
                    <?php
                        if(isset($_SESSION['a'])){
                          echo("<div class='alert alert-danger center' role='alert'>
                                <strong>Oops!</strong>
                                <br/>Keyword should be up to 4 characters
                               </div>");
                          unset($_SESSION['a']);
                        }elseif(isset($_SESSION['b'])){
                              echo("<div class='alert alert-danger center' role='alert'>
                                    <strong>Oops!</strong>
                                    <br/>Enter Keyword
                                   </div>");
                              unset($_SESSION['b']);
                           }
                    ?>              
    				<input type="text" name="keyword" placeholder="Search by Name, Reg. Number" required=""/><br />
                    <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                    <input type="submit" value="Click" name="action"/>
    				</div>
                    <div class="col-md-3"></div>
    				
           
    	</div>
 </form>
   <?php 
    
  
    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    $db->connect();
    $result=$db->select('user_info_table',array('reg_number'=>$_SESSION['reg_number']));
    if($db->numRow()==0){
        header('location:index.php');
    }else{
        $row=mysqli_fetch_assoc($result);
        extract($row);
        $result=$db->select('user_info_table',array('class_id'=>$class_id,'access_level'=>1,'status'=>'true'));     
        $num_record=$db->numRow();    
            if($num_record>0){         
                $threshold=1;
                $max_columns=3;
                $num_columns=min($max_columns,ceil($num_record/$threshold));
                $count_per_column=ceil($num_record/$num_columns);
                $i=0;
                
               echo"<div class='row'><div class='col-md-4 user-agileits justify' style='margin-bottom:4px;'>"; 
                  
        			while($row=mysqli_fetch_assoc($result)){
        			extract($row);
                    
        				if(($i>0) and ($i%$count_per_column==0)){
        					echo"</div><div class='col-md-4 user-agileits justify style='margin-bottom:4px;'>";
        				}
                        
                        if(isset($reg_number)){
                            $dir='D:\xampp\htdocs\school portal\image';
                            $path=$dir.'\\'.$reg_number.'.jpg';
                            if(file_exists($path)){
                                $src=$reg_number.'.jpg';    
                            }else{
                               $src='none.png';
                              }         
                        }                       
                        
                        ?>
        				
                        <img  src="image/<?php echo $src;?>" style="float: left; border-radius: 48%; width: 60px; margin-right: 10px; border: double #000066 2px;"/>
                        <span style="font-family: font2;">Name: <?php echo $db->getUserName($reg_number);?></span><br />
                        <span style="font-family: font2;">Gender: <?php echo $gender;?></span><br />
                        <span style="font-family: font2;">Phone: <?php echo $phone_number;?></span><br /><br />
                        <?php if($_SESSION['access_level']>1){                            
                        ?>
                        <span style="font-family: font2;">Edit: <?php  echo"<a onclick='return checkEdit();' href=signup.php?key=$reg_number>";?><i class="glyphicon glyphicon-pencil" style="color: #000066;"></i></a></span><br /><br />
                        <?php }?>
                        	
                            
         				
        	<?php	
                  $i++;	}
               
               echo"</div></div>";
                
            }else{
               echo("<h6 class=title>No Existing Record</h6>"); 
              }   
    
      } 
    
    ?>

<?php
require_once'footer1.php';
?>