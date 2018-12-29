<?php
require_once'header1.php';


if($_SESSION['access_level']<2){
   header('Location:login.php');
 }
  
?>
<form action="transact.php" method="post" name="notify" onsubmit="return checkNotify();">
<div class="row">
    <h6 class="title">Notification</h6>
    <?php  
    if(isset($_SESSION['c'])){
      $error=$_SESSION['c'];
      echo("<div class='alert alert-danger center' role='alert'>
            <strong>Oops!</strong>
            <br/>$error
         </div>");
     unset($_SESSION['c']);
    }elseif(isset($_SESSION['b'])){
          echo("<div class='alert alert-danger center' role='alert'>
                <strong>Oops!</strong>
                <br/>Data already Exist
               </div>");
          unset($_SESSION['b']);
        }elseif(isset($_SESSION['a'])){
              echo("<div class='alert alert-success center' role='alert'>
                    <strong>Congratulations</strong>
                    <br/>Data Inserted Successfully
                   </div>");
              unset($_SESSION['a']);
           }elseif(isset($_SESSION['d'])){
                echo("<div class='alert alert-danger center' role='alert'>
                        <strong>Cops!</strong>
                        <br/>Error Inserting Data
                       </div>");
                unset($_SESSION['d']);
              }elseif(isset($_SESSION['e'])){
                    echo("<div class='alert alert-success center' role='alert'>
                            <strong>Congratulations</strong>
                            <br/>Data Deleted Successfully
                           </div>");
                    unset($_SESSION['e']);
                  }elseif(isset($_SESSION['f'])){
                        echo("<div class='alert alert-danger center' role='alert'>
                                <strong>Oops!</strong>
                                <br/>Error Deleting Data
                               </div>");
                        unset($_SESSION['f']);
                      }elseif(isset($_SESSION['y'])){
                            echo("<div class='alert alert-success center' role='alert'>
                                    <strong>Congratulations</strong>
                                    <br/>Data Updated Successfully
                                   </div>");
                            unset($_SESSION['y']);
                          }elseif(isset($_SESSION['z'])){
                                echo("<div class='alert alert-danger center' role='alert'>
                                        <strong>Oops!</strong>
                                        <br/>Error Updating Data
                                       </div>");
                                unset($_SESSION['z']);
                              }
                              
            
                $id='';
                $message='';
                $button='Add Message';
            
            
            if(isset($_SESSION['notify_id'])){
                $id=$_SESSION['notify_id'];
                $message=$_SESSION['message'];
                $button='Modify Message';
               
            }
            
    
    ?>
   
        <div class="col-md-8 contact-left cont"><input type="text" name="message" placeholder="Drop Message (28 Characters Max)" style="margin-bottom: 20px;" value="<?php echo $message;?>"/>    </div>
        <?php if(isset($_SESSION['notify_id'])){?>
        <input type="hidden" name="notify_id" value="<?php echo $id;?>"/> 
        <?php }?> 
        <input type="hidden" name="sender" value="<?php echo $_SESSION['reg_number'];?>"/>
        <div class="col-md-4 contact-left1 cont"><input type="submit" name="action" value="<?php echo $button;?>" style="margin-bottom: 20px;"/></div>
    
</div>
</form>
<div class="row">
    <div class="col-md-12">
   <?php
   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
   $db->connect();
   $result=$db->select('notification',array(),array('notify_id'=>'desc'));
   $numrow=$db->numRow();
   if($numrow==0){
    echo("<h6 class=title>No Existing Record</h6>");
    
   } else{
   
   ?> 
    <table class="table table-striped table-hover">
    <thead style="background-color: #000066; color: white;">
        <tr>
            
            <th>S/No</th>
            <th>Notification</th>
            <th>Sender</th>
            <th>Delete</th>
            <th>Edit</th>
                       
        </tr>    
    </thead>    
    <tbody>
    
        <?php
        $counter=1;
        while($row=mysqli_fetch_assoc($result)){ 
            extract($row);
        ?>
        <tr>
            <td><?php echo $counter;?></td>
            <td><?php echo ucwords($message);?></td>
            <td><?php echo $sender;?></td>
            <td><?php  echo"<a onclick='return checkDelete();' href=transact.php?key=$notify_id&action=deleteNotify>";?><i class="glyphicon glyphicon-remove" style="color: red;"></i></a> </td>
            <td><?php  echo"<a onclick='return checkEdit();' href=transact.php?key=$notify_id&action=editNotify>";?><i class="glyphicon glyphicon-pencil" style="color: black;"></i></a> </td>          
        </tr> 
        <?php
        $counter++;
        }
        ?>              
    </tbody> 
    <tfoot style="background-color: #000066; color: white; text-align: center;">
    <tr>
    <td colspan="5">We have <?php echo $numrow;?> Record(s)</td>
    </tr>
    </tfoot>
    
    </table>
    
     <?php 
   }
   
   ?> 
    
    </div>
</div>


<?php
require_once'footer1.php';
?>
