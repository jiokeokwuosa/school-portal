<?php
require_once'header.php';
?>
<div class="container">

 <h4 class="title">Welcome to our Chatroom</h4>
   <?php if(isset($_SESSION['login'])){  ?>
    <form action="transact.php" method="post">
        <div class="row">
             <div class="col-md-3"> </div>
             <div class="col-md-6">
             <?php 
                 if(isset($_SESSION['a'])){
                    echo("<div class='alert alert-danger center' role='alert'>
                            <strong>Oops!</strong>
                            <br/>Please Drop your Opinion (it shouldn't be less that 10 characters)
                           </div>");
                    unset($_SESSION['a']);
                 }elseif(isset($_SESSION['c'])){
                        echo("<div class='alert alert-danger center' role='alert'>
                                <strong>Oops!</strong>
                                <br/>Error Submitting Article
                               </div>");
                        unset($_SESSION['c']);
                     }elseif(isset($_SESSION['b'])){
                            echo("<div class='alert alert-success center' role='alert'>
                                    <strong>Congratulations!</strong>
                                    <br/>Article Submitted Successfully
                                   </div>");
                            unset($_SESSION['b']);
                        }                           
             ?>
             <span class="contact-left cont"> <textarea name="article_text" required="">
              </textarea></span> <br />
              
             <span class="contact-left1"><input type="submit" name="action" value="Drop View" /></span>
             
             
             </div>
             <div class="col-md-3"> </div>
        </div>
    </form>  <?php } ?> 
    <br /><br />
    <?php
      $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
      $db->connect();
      $result=$db->select('articles',array(),array('article_id'=>'DESC'),'20');
      if($db->numRow()==0){
        echo("<h6 class=title>No Existing Record</h6>");
      }else{
        
        
            while($row=mysqli_fetch_assoc($result)){ 
                extract($row);
             ?>  
               
             <div class="row">
                     <div class="col-md-3"> </div>
                     <div class="col-md-6 user-agileits justify">
                     <?php
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
                          $article=new database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                          $article->connect();
                          echo $article->trim_body($article_text,'200');   
                        ?>            
                           </a> 
                     </span> <br />
                        <span style="width: 100%; background-color: #000066; color: white; font-family: font1,font2;" class="clearlink">
                        <a href="viewnews.php?id=<?php echo $article_id;?>"><?php echo $db->getCommentNo($article_id);?> Comment(s)</a></span>
                     </div>
                     <div class="col-md-3"> </div>
             </div>
   <br /> 
               
            
            
            
               
           <?php     
            }
        }
    
    ?>
    
    
    











</div> 

