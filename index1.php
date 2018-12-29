<?php
require_once'header1.php';

if(isset($_SESSION['status'])){
    unset($_SESSION['status']);
}
?>
<div class="row">

<!--Start of student--->
<?php if($access_level==1){?>	
    <div class="statistics-grids">
                <div class="col-md-4 statistics-grid">
                  <a href="taketest.php">
					<div class="statistic">
						<h4>80%</h4>
						<h5>Ready for Test?</h5>
						<p>You are one click away from writing a mock test, dont be afraid, you will do well.</p>
					</div>
                  </a>
                </div>
   	
                <div class="col-md-4 statistics-grid">
                  <a href="myresult.php">
					<div class="statistic">
						<h4>85%</h4>
						<h5>Check Result</h5>
						<p>You can check your result from here, make sure you have gotten your secret pin before proceding.</p>
					</div>
                  </a>
		      	</div>
    
                <div class="col-md-4 statistics-grid">
                  <a href="classmates.php">
					<div class="statistic">
						<h4>100%</h4>
						<h5>Classmates</h5>
						<p>Do you know all your classmates by name? i dont think so.<br /> check it out!.</p>
					</div>
                  </a>
				</div>
				
				<div class="clearfix"></div>
    </div>
<?php }?>		

<!--End of student--->


<!--Start of teacher--->
<?php if($access_level==2){?>	
    <div class="statistics-grids">
                <div class="col-md-4 statistics-grid">
                  <a href="result.php">
					<div class="statistic">
						<h4>80%</h4>
						<h5>Results?</h5>
						<p>You can view and upload your students results from here and equally treat other result matters from here</p>
					</div>
                  </a>
                </div>
   	
                <div class="col-md-4 statistics-grid">
                  <a href="text.php">
					<div class="statistic">
						<h4>85%</h4>
						<h5>Upload Test</h5>
						<p>Want to test your student's knoweldge? you can set a mock test for them.<br />Click?</p>
					</div>
                  </a>
		      	</div>
    
                <div class="col-md-4 statistics-grid">
                  <a href="classmates.php">
					<div class="statistic">
						<h4>100%</h4>
						<h5>My Students</h5>
						<p>Do you know all your students by name? i dont think so.<br /> check it out!.</p>
					</div>
                  </a>
				</div>
				
				<div class="clearfix"></div>
    </div>
<?php }?>		

<!--End of teacher--->



<!--Start of admin--->
<?php if($access_level>=3){?>	
    <div class="statistics-grids">
                <div class="col-md-4 statistics-grid">
                  <a href="approve.php">
					<div class="statistic">
						<h4>80%</h4>
						<h5>Approve Account?</h5>
						<p>You can approve the accounts of teachers and students from here, but do that after verifying.</p>
					</div>
                  </a>
                </div>
   	
                <div class="col-md-4 statistics-grid">
                  <a href="class.php">
					<div class="statistic">
						<h4>85%</h4>
						<h5>Classes</h5>
						<p>View Classes and their teachers. You can equally add new classes and their respective teachers</p>
					</div>
                  </a>
		      	</div>
    
                <div class="col-md-4 statistics-grid">
                  <a href="teachers.php">
					<div class="statistic">
						<h4>100%</h4>
						<h5>My Teachers</h5>
						<p>Do you know all your teachers by name? i dont think so.<br /> check it out!.</p>
					</div>
                  </a>
				</div>
				
				<div class="clearfix"></div>
    </div>
<?php }?>		

<!--End of admin--->

</div>




<?php
require_once'footer1.php';
?>
