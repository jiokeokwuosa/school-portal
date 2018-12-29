<?php
require_once'header1.php';


if($_SESSION['access_level']<4){
   header('Location:login.php');
}
  
?>
<form action="transact.php" method="post" name="session" onsubmit="return checkSession();">
<div class="row">
    <h6 class="title">Session/Term</h6>
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
                <br/>The Session already Exists
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
                        <strong>Oops!</strong>
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
                              
            
            $session='';
            $button='Add Session';
            $id='';
            
            if(isset($_SESSION['session'])){
                $session=$_SESSION['session'];
                $id=$_SESSION['id'];
                $button='Modify Session';
               
            }
            
    
    ?>
        <div class="col-md-2"></div>
        <div class="col-md-4 contact-left cont" ><input type="text" name="session" placeholder="Enter Session eg 2013/2014" style="margin-bottom: 20px;" value="<?php echo $session;?>"/>    </div>
            <?php if(isset($_SESSION['session'])){?>
            <input type="hidden" name="session_id" value="<?php echo $id;?>"/> 
            <?php }?> 
        <div class="col-md-4 contact-left1 cont"><input type="submit" name="action" value="<?php echo $button;?>" style="margin-bottom: 20px;"/></div>
        <div class="col-md-2"></div>
</div>
</form>
<div class="row">
    <div class="col-md-12">
   <?php
   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
   $db->connect();
   $result=$db->select('session',array(),array('session_id'=>'desc'));
   $numrow=$db->numRow();
   if($numrow==0){
    echo("<h6 class=title>No Existing Record</h6>");
    
   } else{
   
   ?> 
    <table class="table table-striped table-hover">
    <thead style="background-color: #000066; color: white;">
        <tr>
            <th>Session</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>    
    </thead>    
    <tbody>
    
        <?php
        while($row=mysqli_fetch_assoc($result)){ 
            extract($row);
        ?>
        <tr>
            <td><?php echo $session;?></td>
            <td><?php  echo"<a onclick='return checkDelete();' href=transact.php?key=$session_id&action=deleteSession>";?><i class="glyphicon glyphicon-remove" style="color: red;"></i></a> </td>
            <td><?php  echo"<a onclick='return checkEdit();' href=transact.php?key=$session_id&action=editSession>";?><i class="glyphicon glyphicon-pencil" style="color: black;"></i></a> </td>          
        </tr> 
        <?php
        }
        ?>              
    </tbody> 
    <tfoot style="background-color: #000066; color: white; text-align: center;">
    <tr>
    <td colspan="3">We have <?php echo $numrow;?> Record(s)</td>
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
