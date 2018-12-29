<?php
require_once'header.php';
if(isset($_REQUEST['action'])){
    switch($_REQUEST['action']){
        
    case 'Go':          
            $keyword=isset($_POST['keyword'])? $_POST['keyword']:'';
            if(!empty($keyword)){
                if(strlen($keyword)>3){
                    $query="SELECT * FROM library WHERE `title` LIKE '%".$keyword."%' OR `description` LIKE '%".$keyword."%' OR `subject` LIKE '%".$keyword."%'";
                    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                    $db->connect();
                    $result=$db->custom($query);
                    $num_record=$db->numRow();
                    
                        if($num_record>0){
                            
                            echo("<h6 class=title>Search Result(s) on $keyword</h6>"); 
                            
                               $threshold=1;
                                $max_columns=3;
                                $num_columns=min($max_columns,ceil($num_record/$threshold));
                                $count_per_column=ceil($num_record/$num_columns);
                                $i=0;
                                
                               echo"<div class='row services-grids'><div class='col-md-4 ser-grid clearlink'>"; 
                                  
                        			while($row=mysqli_fetch_assoc($result)){
                        			extract($row);
                                    
                        				if(($i>0) and ($i%$count_per_column==0)){
                        					echo"</div><div class='col-md-4 ser-grid clearlink'>";
                        				}?>
                        				
                                        	<div class="icon">
                                    					<i class="glyphicon glyphicon-book" aria-hidden="true"></i>
                                    		</div>
                                             <a href="books/<?php echo $book_id.$extension;?>">	
                                                <h6 class="title"><?php echo $title;?></h6>
                                				<p class="justify"><?php echo substr($description,0,160);?></p>
                                			</a>
                                        
                         				
                        	<?php	
                                  $i++;	}
                               
                               echo"</div></div>";   
                            
                            
                            
                            
                            
                        }else{
                             echo("<h6 class=title>No Item Found</h6>"); 
                        }
                }else{
                   $_SESSION['a']=true; 
                   header('location:library.php');
                }
                
            }else{
                $_SESSION['b']=true;
                header('location:library.php');
            }
            
      break;
      
      
      
      
      
    case 'Click':
    
             $keyword=isset($_POST['keyword'])? $_POST['keyword']:'';
             $class=isset($_POST['class_id'])? $_POST['class_id']:'';
               if(!empty($keyword)){
                    if(strlen($keyword)>3){
                        $query="SELECT * FROM user_info_table WHERE `reg_number` LIKE '%".$keyword."%' OR `first_name` LIKE '%".$keyword."%' OR `last_name` LIKE '%".$keyword."%' AND `class_id`=$class";
                        $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                        $db->connect();
                        $result=$db->custom($query);
                        $num_record=$db->numRow();
                        
                            if($num_record>0){
                                
                                echo("<h6 class=title>Search Result(s) on $keyword</h6>"); 
                                
                                   $threshold=1;
                                    $max_columns=3;
                                    $num_columns=min($max_columns,ceil($num_record/$threshold));
                                    $count_per_column=ceil($num_record/$num_columns);
                                    $i=0;
                                    
                                  echo"<div class='row'><div class='col-md-4 user-agileits justify' style='margin-right:0px;margin-left:0px;'>"; 
                  
                        			while($row=mysqli_fetch_assoc($result)){
                        			extract($row);
                                    
                                        
                                    
                        				if(($i>0) and ($i%$count_per_column==0)){
                        					echo"</div><div class='col-md-4 user-agileits justify style='margin-right:0px;margin-left:0px;''>";
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
                                        <span style="font-family: font2;">Edit: <?php  echo"<a onclick='return checkEdit();' href=signup.php?key=$reg_number>";?><i class="glyphicon glyphicon-pencil" style="color: #000066;"></i></a></span>
                                        <?php }?>
                                        
                                        	
                                            
                         				
                        	<?php	
                                  $i++;	}
                               
                               echo"</div></div>";  
                                
                                
                                
                                
                                
                            }else{
                                 echo("<h6 class=title>No Item Found</h6>"); 
                            }
                    }else{
                       $_SESSION['a']=true; 
                       header('location:classmates.php');
                    }
                    
                }else{
                    $_SESSION['b']=true;
                    header('location:classmates.php');
                }
        
        
    
    
    break;  
      
      
      
      
      
      
      
       
   }
    
}
?>