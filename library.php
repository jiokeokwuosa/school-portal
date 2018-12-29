<?php
require_once'header.php';
?>

<div class="banner-w3agile" style="background: url(images/img12.jpg) no-repeat 0px 0px; background-size: cover;">
	<div class="container clearlink">
		<h3><a href="index.php">Home</a> / <span>E-Library</span></h3>
	</div>
</div>
<br /><br />

<div class="container">
    <h4 class="title">E-Library</h4>
           
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
    				<input type="text" name="keyword" placeholder="Search by title, subject etc" required=""/><br />
                    <input type="submit" value="Go" name="action"/>
    				</div>
                    <div class="col-md-3"></div>
    				
           
    	</div>
     </form>
    
    <?php 
    
    
    $db=new Database(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    $db->connect();
    $result=$db->select('library',array(),array('book_id'=>'DESC'));
    $num_record=$db->numRow();
    
    if($num_record>0){         
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
       echo("<h6 class=title>No Existing Record</h6>"); 
    }   
    
        
    
    ?>
       
    
</div>

<?php
require_once'footer.php';
?>