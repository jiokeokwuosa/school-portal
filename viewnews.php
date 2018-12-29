<?php
require_once'header.php';

  if(isset($_GET['id'])){
    $_SESSION['article_id']=$_GET['id'];    
  }
  
  if(! isset($_GET['id']) and ! isset($_SESSION['article_id'])){
    header('location:index.php');
  }
?>

<div class="container">
    <h4 class="title">Full Story</h4>
    <div class="row">
         <div class="col-md-3"> </div>
         <div class="col-md-6 user-agileits justify">
          <?php
          $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
          $db->connect();
          $result=$db->select('articles',array('article_id'=>$_SESSION['article_id']));
          if($db->numRow()==0){
            echo("<h6 class=title>No Existing Record</h6>");
          }else{
            
            
                while($row=mysqli_fetch_assoc($result)){ 
                    extract($row);
                
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
                         <img  src="image/<?php echo $src;?>" style="float: left; border-radius: 48%; width: 66px; margin-right: 10px; border: double #000066 2px;"/>
                         <span style="width: 100%; background-color: #000066; color: white; font-family: font1,font2;">By <?php echo $db->getUserName($reg_number);?> on <?php echo date('d-m-y @ h:ia',strtotime($submit_date));?></span><br />
                        <span class="clearlink"><a href="viewnews.php?id=<?php echo $article_id;?>"> 
                          <?php
                               echo $article_text;   
                            ?>            
                               </a> 
                         </span> <br />
                            <br /> 
                           
               <?php     
                }
            }
        
        ?>
         </div>
         <div class="col-md-3"> </div>
    </div>

   <h6 class="title"><?php echo $db->getCommentNo($_SESSION['article_id']);?> Comment(s)</h6>
 
 <?php if(isset($_SESSION['login'])){?>
  <form action="transact.php" method="post">
    <div class="row">
        <div class="col-md-4">       </div>
        
        <div class="col-md-4"> 
            <a name="status"></a>
        <?php 
             if(isset($_SESSION['a'])){
                echo("<div class='alert alert-danger center' role='alert'>
                        <strong>Oops!</strong>
                        <br/>Please Drop your Comment (it shouldn't be less that 3 characters)
                       </div>");
                unset($_SESSION['a']);
             }elseif(isset($_SESSION['c'])){
                    echo("<div class='alert alert-danger center' role='alert'>
                            <strong>Oops!</strong>
                            <br/>Error Submitting Comment
                           </div>");
                    unset($_SESSION['c']);
                 }elseif(isset($_SESSION['b'])){
                        echo("<div class='alert alert-success center' role='alert'>
                                <strong>Congratulations!</strong>
                                <br/>Comment Submitted Successfully
                               </div>");
                        unset($_SESSION['b']);
                    }                           
     ?>
            <span class="contact-left cont"> <textarea name="comment_text" required="">
              </textarea></span> <br />
              
             <span class="contact-left1"><input type="submit" name="action" value="Drop Comment" /></span>
             
        
        </div>
              
        <div class="col-md-4">       </div>
    
    
    </div>
  </form> 
  <?php } ?>
<br />

   
           
           
        <?php
          $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
          $db->connect();
          $result=$db->select('comments',array('article_id'=>$_SESSION['article_id']),array('comment_id'=>'DESC'),'8');
          if($db->numRow()==0){
            echo("<h6 class=title>No Existing Record</h6>");
          }else{
            
            
                while($row=mysqli_fetch_assoc($result)){ 
                    extract($row);
                
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
                         
                          <div class="row">
                            <div class="col-md-4">       </div>
                            
                            <div class="col-md-4 user-agileits justify"> 
                                 <img  src="image/<?php echo $src;?>" style="float: left; border-radius: 45%; width: 44px; margin-right: 10px; border: double #000066 2px;"/>
                                 <span style="width: 100%; background-color: #000066; color: white; font-family:font2;">By <?php echo $db->getUserName($reg_number);?> on <?php echo date('d-m-y @ h:ia',strtotime($comment_date));?></span><br />
                                <span> 
                                  <?php
                                       echo $comment_text;   
                                    ?>            
                                       
                                 </span> 
                           
                            </div>
                                  
                          <div class="col-md-4">       </div>
                        
                        
                        </div>
                    

               <?php     
                }
            }
        
        ?>


</div>
<br />
















