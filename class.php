<?php
require_once'header1.php';


if($_SESSION['access_level']<3){
   header('Location:login.php');
 }
  
?>
<form action="transact.php" method="post" name="classForm" onsubmit="return checkClass();">
<div class="row">
    <h6 class="title">Class(es)</h6>
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
                $name='';
                $teacher='';
                $population='';
                $button='Add Class';
            
            
            if(isset($_SESSION['class_id'])){
                $id=$_SESSION['class_id'];
                $name=$_SESSION['name'];
                $teacher=$_SESSION['teacher'];
                $population=$_SESSION['population'];
                $button='Modify Class';
               
            }
            
    
    ?>
   
        <div class="col-md-4 contact-left cont"><input type="text" name="name" placeholder="Enter Class eg. Jss1" style="margin-bottom: 20px;" value="<?php echo $name;?>"/>    </div>
        <div class="col-md-4 contact-left cont"><input type="text" name="teacher" placeholder="Teacher's Name" style="margin-bottom: 20px;" value="<?php echo $teacher;?>"/>    </div>
        <div class="col-md-2 contact-left cont"><input type="text" name="population" placeholder="No. of Students" style="margin-bottom: 20px;" value="<?php echo $population;?>"/>       </div>
        <?php if(isset($_SESSION['class_id'])){?>
        <input type="hidden" name="class_id" value="<?php echo $id;?>"/> 
        <?php }?> 
        <div class="col-md-2 contact-left1 cont"><input type="submit" name="action" value="<?php echo $button;?>" style="margin-bottom: 20px;"/></div>
    
</div>
</form>
<div class="row">
    <div class="col-md-12">
   <?php
   $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
   $db->connect();
   $result=$db->select('classes',array(),array('class_id'=>'desc'));
   $numrow=$db->numRow();
   if($numrow==0){
    echo("<h6 class=title>No Existing Record</h6>");
    
   } else{
   
   ?> 
    <table class="table table-striped table-hover">
    <thead style="background-color: #000066; color: white;">
        <tr>
            
            <th>Class</th>
            <th>Teacher</th>
            <th>Students No</th>
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
            <td><?php echo ucwords($name);?></td>
            <td><?php echo ucwords($teacher);?></td>
            <td><?php echo $population;?></td>
            <td><?php  echo"<a onclick='return checkDelete();' href=transact.php?key=$class_id&action=deleteClass>";?><i class="glyphicon glyphicon-remove" style="color: red;"></i></a> </td>
            <td><?php  echo"<a onclick='return checkEdit();' href=transact.php?key=$class_id&action=editClass>";?><i class="glyphicon glyphicon-pencil" style="color: black;"></i></a> </td>          
        </tr> 
        <?php
        
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
