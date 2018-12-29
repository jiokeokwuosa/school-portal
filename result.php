<?php
require_once'header1.php';


if($_SESSION['access_level']<2){
   header('Location:login.php');
 }
?>

<h6 class="title">Result(s)</h6>
<div class="row">
     
     <div class="statistics-grids">
                
                <div class="col-md-4 statistics-grid">
                  <a href="result1.php">
					<div class="statistic">
						<h4>85%</h4>
						<h5>Add Batch Result</h5>
						<p>You can add batch result from here, results here are added subject by subject, Click to continue.</p>
					</div>
                  </a>
		      	</div>
    
                <div class="col-md-4 statistics-grid">
                  <a href="result2.php">
					<div class="statistic">
						<h4>100%</h4>
						<h5>View Result Sheet</h5>
						<p>View your result sheet from here.<br /> Do that after uploading the results!<br />Thanks.</p>
					</div>
                  </a>
				</div>
                
                <div class="col-md-4 statistics-grid">
                  <a href="result3.php">
					<div class="statistic">
						<h4>100%</h4>
						<h5>Add Single Result</h5>
						<p>You can add single result from here, results here are added student by student, Click to continue.</p>
					</div>
                  </a>
				</div>
				
				<div class="clearfix"></div>
                
    </div>
    
</div>


<?php
require_once'footer1.php';
?>