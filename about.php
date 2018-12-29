<?php
require_once'header.php';
?>
<div class="banner-w3agile" style="background: url(images/img11.jpg) no-repeat 0px 0px; background-size: cover;">
	<div class="container clearlink">
		<h3><a href="index.php">Home</a> / <span>About</span></h3>
	</div>
</div>
<br /><br />
<div class="container">
<h4 class="title">About Us</h4>
    <div class="row user-agileits">
        <div class="col-md-6 justify">
            <h6 class="title"><?php echo $admin['name']['value'];?></h6>
             <?php echo $db->trim_body($admin['about_us']['value'],550);?>
        
        </div>
        
        <div class="col-md-6 mask">
        <img  src="images/a.jpg" class="img-responsive zoom-img"/>
        </div>
    
    </div><br />
    
    <div class="row user-agileits">

        <div class="col-md-4">
            <img src="images/v.jpg" class="img-responsive zoom-img" />
        </div>

        <div class="col-md-8">
            <h6 class="title justify">Our Vision</h6>
            <h3><?php echo $admin['vision']['value'];?></h3>
        </div>  
      
    </div><br />
    
    <div class="row user-agileits">

        <div class="col-md-8">
            <h6 class="title justify">Our Mission</h6>
            <h3><?php echo $admin['mission']['value'];?></h3>
        </div> 
        
        <div class="col-md-4">
            <img src="images/m.jpg" style="height: 200px;" class="img-responsive zoom-img" />
        </div> 
      
    </div><br />
    
</div>

<a name="programme"></a>
<div class="container">

 <h4 class="title">Our Programmes</h4> 
 
    <div class="row user-agileits">
        <div class="col-md-6 justify mask">
            <img src="images/5.jpg" class="img-responsive zoom-img" width="99%"/><br />
            <h6 class="title">Primary Programme</h6>
            We run a primary school program than runs from Primary 1 to Primary 6. Education is central to development. It is one of the most powerful instruments for reducing poverty and inequality 
            and lays a foundation for sustained economic growth. With this aim currently our government has given special emphasis 
            to ...
        
        </div>
        
        <div class="col-md-6 justify mask">
            
            <h6 class="title">Secondary Programme</h6>
            Our Secondary program runs from  Juniour secondary to Seniour Secondary. Learning is one of the most powerful instruments for reducing poverty and inequality 
            and lays a foundation for sustained economic growth. With this aim currently our government has given special emphasis 
            to ...<br />
            <img src="images/3.jpg" class="img-responsive zoom-img" width="99%"/>
        
        </div>
    
    
    </div>
</div>
<a name="staff"></a>
<br />
    
 <h4 class="title">Our Staff</h4> 
   
<div class="container-fluid staff ">
  <div class="container user-agileits1">
    <div class="row staff-grids">
		<div class="col-md-6 staff-grid">
			<div class="staff-left mask">
				<img src="images/cc.png" class="img-responsive zoom-img" alt=""/>
			</div>
			<div class="staff-right">
				<h4>Esthi Ogbobe</h4>
				<ul style="padding-left: 0px;">
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> Office : 0041-456-3692</li>
					<li><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Mobile : 0200-123-4567</li>
					<li><i class="glyphicon glyphicon-print" aria-hidden="true"></i> Fax : 0091-789-456100</li>
				</ul>
				<div class="social-icons">
					<a href="#"><i class="icon1"></i></a>
					<a href="#"><i class="icon2"></i></a>
					<a href="#"><i class="icon3"></i></a>
					<a href="#"><i class="icon4"></i></a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-6 staff-grid">
			<div class="staff-left mask">
				<img src="images/ee.png" class="img-responsive zoom-img" alt=""/>
			</div>
			<div class="staff-right">
				<h4>Okwuosa Max</h4>
				<ul style="padding-left: 0px;">
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> Office : 0041-456-3692</li>
					<li><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Mobile : 0200-123-4567</li>
					<li><i class="glyphicon glyphicon-print" aria-hidden="true"></i> Fax : 0091-789-456100</li>
				</ul>
				<div class="social-icons">
					<a href="#"><i class="icon1"></i></a>
					<a href="#"><i class="icon2"></i></a>
					<a href="#"><i class="icon3"></i></a>
					<a href="#"><i class="icon4"></i></a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
    
    
    <div class="row staff-grids">
		<div class="col-md-6 staff-grid">
			<div class="staff-left mask">
				<img src="images/dd.png" class="img-responsive zoom-img" alt=""/>
			</div>
			<div class="staff-right">
				<h4>Micheal Oko</h4>
				<ul style="padding-left: 0px;">
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> Office : 0041-456-3692</li>
					<li><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Mobile : 0200-123-4567</li>
					<li><i class="glyphicon glyphicon-print" aria-hidden="true"></i> Fax : 0091-789-456100</li>
				</ul>
				<div class="social-icons">
					<a href="#"><i class="icon1"></i></a>
					<a href="#"><i class="icon2"></i></a>
					<a href="#"><i class="icon3"></i></a>
					<a href="#"><i class="icon4"></i></a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-6 staff-grid">
			<div class="staff-left mask">
				<img src="images/aa.png" class="img-responsive zoom-img" alt=""/>
			</div>
			<div class="staff-right">
				<h4>Amuche Ugochi</h4>
				<ul style="padding-left: 0px;">
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> Office : 0041-456-3692</li>
					<li><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Mobile : 0200-123-4567</li>
					<li><i class="glyphicon glyphicon-print" aria-hidden="true"></i> Fax : 0091-789-456100</li>
				</ul>
				<div class="social-icons">
					<a href="#"><i class="icon1"></i></a>
					<a href="#"><i class="icon2"></i></a>
					<a href="#"><i class="icon3"></i></a>
					<a href="#"><i class="icon4"></i></a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	 </div>
    
   </div> 
</div><br />

<?php
require_once'footer.php';

?>