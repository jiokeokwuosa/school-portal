<?php
require_once'header1.php';
?>
<h6 class="title">Subject(s)</h6>
    
   <form action="transact.php" method="post">
        <div class="row">
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
                     }elseif(isset($_SESSION['y'])){
                            echo("<div class='alert alert-success center' role='alert'>
                                    <strong>Congratulations</strong>
                                    <br/>Data Updated Successfully
                                   </div>");
                            unset($_SESSION['y']);
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
                                 }    
                     
                     
                     
                     
                 
                    $id='';
                    $name='';
                    $short_name='';
                    $class_id='';
                    $button='Add Subject';
            
            
                if(isset($_SESSION['subject_id'])){
                    $id=$_SESSION['subject_id'];
                    $name=$_SESSION['name'];
                    $short_name=$_SESSION['short_name'];
                    $class_id=$_SESSION['class_id'];
                    $button='Modify Subject';
                   
                }
               
            
        ?>
            <div class="col-md-3 contact-left cont"> <input type="text" name="name" placeholder="Subject Name"  value="<?php echo $name;?>"required="" style="margin-bottom: 20px;"/> </div>
            <div class="col-md-3 contact-left cont"> <input type="text" name="short_name" placeholder="Short Name" value="<?php echo $short_name;?>" required="" style="margin-bottom: 20px;"/>  </div>
            <div class="col-md-3 contact-left cont"> <select name="class_id" required="" style="margin-bottom: 20px;">
            <?php
            $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
            $db->connect();
            echo  $db->listClasses($class_id);     
            ?>        
            </select> </div>
            <?php if(isset($_SESSION['subject_id'])){?>
            <input type="hidden" name="subject_id" value="<?php echo $id;?>"/> 
            <?php }?> 
            <div class="col-md-3 contact-left1 cont"><input type="submit" name="action"  value="<?php echo $button;?>"/>  </div>    
        
        </div>
  </form>


 <?php 
    
    
    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    $db->connect();
    $result=$db->select('Classes');
    if($db->numRow()==0){
        header('location:index.php');
    }else{        
            $num_record=$db->numRow();                   
            $threshold=1;
            $max_columns=3;
            $num_columns=min($max_columns,ceil($num_record/$threshold));
            $count_per_column=ceil($num_record/$num_columns);
            $i=0;
           echo"<div class='row'><div class='col-md-4 user-agileits justify'>";   
                 
             while($row=mysqli_fetch_assoc($result)){
             extract($row);  
                
                if(($i>0) and ($i%$count_per_column==0)){
        		   echo"</div><div class='col-md-4 user-agileits justify'>";
        		}
                $db1=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
                $db1->connect();
                $result1=$db1->select('subjects',array('class_id'=>$class_id),array('subject_id'=>'DESC'));
                    if($db1->numRow()==0){
                      echo("<h6 class=title>No Existing Record</h6>");                        
                    }else{
                        $number=$db1->numRow();
                        ?>
                    
                      <table class="table table-striped table-hover">
                        <thead style="background-color: #000066; color: white;">
                        <tr><th colspan="3" class="center"><?php echo $db1->getClassName($class_id);?></th></tr>
                            <tr>
                                
                                <th>Subject</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                                            
                            </tr>    
                          </thead>    
                          <tbody>
                     
                    
                        
                    <?php     while($row1=mysqli_fetch_assoc($result1)){
                                extract($row1);
                                ?>
                                
                                   <tr>
                                        <td><?php echo ucwords($name);?></td>
                                        <td><?php  echo"<a onclick='return checkDelete();' href=transact.php?key=$subject_id&action=deleteSubject1>";?><i class="glyphicon glyphicon-remove" style="color: red;"></i></a> </td>
                                        <td><?php  echo"<a onclick='return checkEdit();' href=transact.php?key=$subject_id&action=editSubject>";?><i class="glyphicon glyphicon-pencil" style="color: black;"></i></a> </td>          
                                    </tr>
                         <?php
                                }
                            ?>    
                          </tbody> 
                            <tfoot style="background-color: #000066; color: white; text-align: center;">
                            <tr>
                            <td colspan="3">We have <?php echo $number;?> Record(s)</td>
                            </tr>
                            </tfoot>
                            
                            </table>      
                                
                     <?php   
                       }
                    
                
                ?> 
                   
                
              
              
              
              
              
                
             <?php   
               $i++;               
               
             }            
             
     echo"</div></div>";
     
     
      }
        
require_once'footer1.php';
?>