<?php 
require_once'header1.php';?>


     <form action="transact.php" method="post" enctype="multipart/form-data" name="library" onsubmit="return checkLibrary();">    
        <div class="row">
                    <div class="col-md-1"></div>
    				<div class="col-md-10 contact-left cont center"> 
                    <?php 
                        if(isset($_SESSION['a'])){
                            echo("<div class='alert alert-danger center' role='alert'>
                                <strong>Oops!</strong>
                                <br/>Please Upload File.
                                </div>");
                            unset($_SESSION['a']);
                        }elseif(isset($_SESSION['d'])){
                                $error=$_SESSION['d'];
                                echo("<div class='alert alert-danger center' role='alert'>
                                   <strong>Oops!</strong>
                                   <br/>$error
                                    </div>");
                                unset($_SESSION['d']);
                            }elseif(isset($_SESSION['c'])){
                                    echo("<div class='alert alert-danger center' role='alert'>
                                        <strong>Oops!</strong>
                                        <br/>Error Sending to Database.
                                        </div>");
                                    unset($_SESSION['c']);
                                }elseif(isset($_SESSION['b'])){
                                        echo("<div class='alert alert-success center' role='alert'>
                                            <strong>Congratulation</strong>
                                            <br/>File Uploaded Successfully.
                                            </div>");
                                        unset($_SESSION['b']);
                                    }elseif(isset($_SESSION['e'])){
                                            echo("<div class='alert alert-success center' role='alert'>
                                                 <strong>Congratulation</strong>
                                                 <br/>File Deleted Successfully.
                                                </div>");
                                            unset($_SESSION['e']);
                                       }elseif(isset($_SESSION['f'])){
                                                echo("<div class='alert alert-danger center' role='alert'>
                                                     <strong>Oops!</strong>
                                                     <br/>Error Deleting File.
                                                    </div>");
                                                unset($_SESSION['f']);
                                           }
                            $id='';
                            $title='';
                            $description='';
                            $subject=''; 
                            $submit='Submit File';             
                        if(isset($_SESSION['login']) and isset($_SESSION['book_id'])){
                            
                            $id=$_SESSION['book_id'];
                            $title=$_SESSION['title'];
                            $description=$_SESSION['description'];
                            $subject=$_SESSION['subject'];
                            $submit='Modify File'; 
                            
                        }
                    
                    ?> 
                    <fieldset> 
                    <legend>Upload Book</legend>            
    				<input type="text" name="title" placeholder="Book Title" style="margin-bottom: 20px;" value="<?php echo $title;?>"/><br />
       	            <select name="subject">
                       <option value="">Select Subject</option>
                       <option value="english" <?php if($subject=='english'){ echo"selected=selected";}?>>English</option>
                       <option value="maths" <?php if($subject=='maths'){ echo"selected=selected";}?>>Maths</option>
                       <option value="igbo" <?php if($subject=='igbo'){ echo"selected=selected";}?>>Igbo</option>
                       <option value="crk" <?php if($subject=='crk'){ echo"selected=selected";}?>>CRK</option>
                       <option value="intergrated science" <?php if($subject=='intergrated science'){ echo"selected=selected";}?>>Intergrated Science</option>
                       <option value="novel" <?php if($subject=='novel'){ echo"selected=selected";}?>>Novel</option>
                       <option value="others" <?php if($subject=='others'){ echo"selected=selected";}?>>Others</option>
                       </select><br />
                    </fieldset>
                    
                    <fieldset>
                    <legend>Write Brief Descritpion of the Book</legend>
                    <textarea name="description" title="120 characters Max">
                          <?php echo $description;?>             
                    </textarea>
                   </fieldset>
                    <div class="row">                        
                        <div class="col-md-6" style="margin-top: 14px;">
                            <input type="file" id="upload" name="file" style="display: none;" />
                            <label for="upload" class="button">Browse</label>
                        </div> 
                        <input type="hidden" name="uploader" value="<?php if(isset($_SESSION['reg_number'])){echo $_SESSION['reg_number'];}?>"/>
                         <?php if(isset($_SESSION['book_id'])){?>
                        <input type="hidden" name="book_id" value="<?php echo $id;?>"/> 
                        <?php }?>
                        <div class="col-md-6" style="margin-top: 14px;">
                             <input type="submit" id="submit" name="action" style="display: none;" value="<?php echo $submit;?>" />
                             <label for="submit" class="button"><?php echo $submit;?></label>
                        </div>                                           
                        
                    </div>
                        
                    
    				</div>
                    <div class="col-md-1"></div>
        
        
        </div>
         <br /><br /><br />
    </form>
    
    
<div class="row">
        <div class="col-md-12">
               <?php
               $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
               $db->connect();
               $result=$db->select('library',array(),array('book_id'=>'desc'));
               $numrow=$db->numRow();
               if($numrow==0){
                echo("<h6 class=title>No Existing Record</h6>");
                
               } else{
               
               ?> 
                <table class="table table-striped table-hover">
                <thead style="background-color: #000066; color: white;">
                    <tr>
                        
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Uploader</th>
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
                        <td><?php echo ucwords($title);?></td>
                        <td><?php echo ucwords($subject);?></td>
                        <td><?php echo $uploader;?></td>
                        <td><?php  echo"<a onclick='return checkDelete();' href=transact.php?key=$book_id&action=deleteBook&ext=$extension>";?><i class="glyphicon glyphicon-remove" style="color: red;"></i></a> </td>
                        <td><?php  echo"<a onclick='return checkEdit();' href=transact.php?key=$book_id&action=editBook>";?><i class="glyphicon glyphicon-pencil" style="color: black;"></i></a> </td>          
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
    
   