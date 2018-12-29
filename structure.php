<?php
require_once'header1.php';

if(!isset($_SESSION['access_level']) or $_SESSION['access_level']<4){
  header('location:index.php');   
}

$db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
$db->connect();


 if(isset($_POST['action']) and $_POST['action']=='Submit'){
    
     $values=array();
        for($i=1; $i<count($_POST['member'])+1;  $i++){            
           $result=$db->update('structure',array('value'=>$_POST['member'][$i]['value']),array('id'=>$_POST['member'][$i]['id']));           
        }       
        
           echo("<div class='row alert alert-success center' role='alert'>
            <strong>Congratulations</strong>
            <br/>Structure Changed Successfully
           </div>");
        
 }
 
 
 if(isset($_SESSION['a'])){
  echo("<div class='alert alert-danger center' role='alert'>
        <strong>Oops!</strong>
        <br/>Please select image of type: .gif, .png, .jpg, .jpeg
       </div>");
  unset($_SESSION['a']);
}elseif(isset($_SESSION['b'])){
      echo("<div class='alert alert-success center' role='alert'>
            <strong>Congratulations!</strong>
            <br/>Your Picture has been Saved Successfully.
           </div>");
      unset($_SESSION['b']);
    }elseif(isset($_SESSION['c'])){
          echo("<div class='alert alert-danger center' role='alert'>
                <strong>Oops!</strong>
                <br/>Error Saving Image
               </div>");
          unset($_SESSION['c']);
        }elseif(isset($_SESSION['d'])){
             $error=$_SESSION['d'];
             echo("<div class='alert alert-danger center' role='alert'>
                    <strong>Oops!</strong>
                    <br/>$error
                 </div>");
             unset($_SESSION['d']);
          }
?>

<br /><br />
<h6 class="title">Site Structure</h6>

<div class="row clearlink">
    <div class="col-md-12">
   <?php  
   $result=$db->select('structure');
   $numrow=$db->numRow();
   if($numrow==0){
    echo("<h6 class=title>No Existing Record</h6>");
    
   } else{
   
   ?> 
<form action="structure.php" method="post" enctype="multipart/form-data">
    <table class="table table-striped table-hover">
    <thead style="background-color: #000066; color: white;">
        <tr>
            <th>Title</th>
            <th>Value</th>
            <th>Parameter</th>           
        </tr>    
    </thead>    
    <tbody>
    
        <?php
        $value='';
        $counter=0;
        while($row=mysqli_fetch_assoc($result)){ 
            extract($row);           
           ++$counter;
        ?>
        <tr>
            <td><?php echo $title;?></td>
            <td class="contact-left cont"><textarea name="member[<?php echo $counter;?>][value]"><?php echo $value;?></textarea></td>
            <input type="hidden" name="member[<?php echo $counter;?>][id]"  value="<?php echo $id;?>"/> 
            <td><?php echo $constant;?></td>    
        </tr>  
    <?php 
     
    }?>          
    </tbody> 
    <tfoot style="background-color: #000066; color: white; text-align: center;">
    <tr>
    <td colspan="3">We have <?php echo $numrow;?> Record(s)</td>
    </tr>
    </tfoot>
    
    </table>
    <input type="submit" name="action" value="Submit" style="font-weight: bolder; background-color: #000066; color: white;"/>

     <?php 
   }
   
   ?> 
    
    </div> 

</div>

</form>
<br />


<div class="row">

    <form action="transact.php" method="post" enctype="multipart/form-data">
        <div class="col-md-2 contact-left cont">
            
            <input type="file" id="titleImage" name="titleImage" style="display: none;"  required="" />
            <label for="titleImage" class="button center">Select Banner</label><br />
         
        </div>
        
        
         <div class="col-md-2 contact-left cont">
            
            <input type="submit" id="action" name="action" style="display: none;" value="Submit Banner"/>
            <label for="action" class="button center">Submit Banner</label><br />
             
         </div>
     </form>
     
     
     <form action="transact.php" method="post" enctype="multipart/form-data">
        <div class="col-md-2 contact-left cont">
            
            <input type="file" id="logo" name="logo" style="display: none;"  required="" />
            <label for="logo" class="button center">Select Logo</label><br />
         
        </div>
        
        
         <div class="col-md-2 contact-left cont">
            
            <input type="submit" id="action2" name="action" style="display: none;" value="Submit Logo"/>
            <label for="action2" class="button center">Submit Logo</label><br />
             
         </div>
     </form>  
         

     <form action="transact.php" method="post" enctype="multipart/form-data">     
         <div class="col-md-2 contact-left cont">
            
            <input type="file" id="principal" name="principal" style="display: none;"  />
            <label for="principal" class="button center">Select Principal</label><br />
         
        </div>
        
        
         <div class="col-md-2 contact-left cont">
            
           <input type="submit" id="action1" name="action" style="display: none;" value="Submit Principal"/>
           <label for="action1" class="button center">Submit Principal</label><br />
             
         </div>
    
     </form>     
   
     
</div>










<?php
require_once'footer1.php';
?>