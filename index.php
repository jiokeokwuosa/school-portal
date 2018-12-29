<?php 
require_once"header.php";
?>
<div id="slide">
    <!-- banner -->
	<div class="banner">
		<div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">

            <!-- Wrapper-for-Slides -->
            <div class="carousel-inner" role="listbox">

                <!-- First-Slide -->
                <div class="item active">
                    <img src="images/img1.jpg" alt="" class="img-responsive" style="max-height:470px; width: 100%;" />
                    <div class="carousel-caption kb_caption">
                        <h3 data-animation="animated flipInX">Proverb 22:6</h3>
                        <h4 data-animation="animated flipInX">Train up a child in the way he should go; and when he is old, he will not depart from it.</h4>
                    </div>
                </div>

                <!-- Second-Slide -->
                <div class="item">
                    <img src="images/img2.jpg" alt="" class="img-responsive" style="max-height:470px; width: 100%;" />
                    <div class="carousel-caption kb_caption kb_caption_right">
                        <h3 data-animation="animated flipInX">Psalm 46:1-2</h3>
                        <h4 data-animation="animated flipInX">God is our Refuge and strenght, a very present help in trouble. Therefore we will not fear...</h4>
                    </div>
                </div>

                <!-- Third-Slide -->
                <div class="item">
                    <img src="images/img3.jpg" alt="" class="img-responsive" style="max-height:470px; width: 100%;" />
                    <div class="carousel-caption kb_caption kb_caption_center">
                        <h3 data-animation="animated flipInX">Job 5:12</h3>
                        <h4 data-animation="animated flipInX">He Frustrates the devices of the crafty, so that their hands achieve no success.</h4>
                    </div>
                </div>
                
                <div class="item">
                    <img src="images/img4.jpg" alt="" class="img-responsive" style="max-height:470px; width: 100%;" />
                    <div class="carousel-caption kb_caption kb_caption_center">
                        <h3 data-animation="animated flipInX">Isaiah 7:7</h3>
                        <h4 data-animation="animated flipInX">Thus saith the lord God, it shall not stand, neither shall it come to pass.</h4>
                    </div>
                </div>
                
                <div class="item">
                    <img src="images/img5.jpg" alt="" class="img-responsive" style="max-height:470px; width: 100%;" />
                    <div class="carousel-caption kb_caption kb_caption_center">
                        <h3 data-animation="animated flipInX">Isaiah 8:10</h3>
                        <h4 data-animation="animated flipInX">Take Couunsel together and it shall come to nought, speak the word and it shall not stand, for God is with us.</h4>
                    </div>
                </div>

            </div>
			
            <!-- Left-Button -->
            <a class="left carousel-control kb_control_left" href="#kb" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!-- Right-Button -->
            <a class="right carousel-control kb_control_right" href="#kb" role="button" data-slide="next">
                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
			
        </div>
	<script src="js/custom.js"></script>
	</div>
<!--banner-->
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 center"><h3 class="title">Principal's Remark</h3></div>
    </div>
    
    <div class="row">
        <div class="col-md-3 user-agileits" style="border-radius: 7px 0px 7px 0px;">
        <img  src="images/principal.png" class="img-responsive" style="width: 100%; max-height:200px;border-radius: 50%;"/>
        </div>
        
        <div class="col-md-9 justify user-agileits headmaster" style="border-radius: 0px 7px 7px 0px;">
       <?php echo $db->trim_body($admin['principal\'s_remark']['value'],760);?>
        </div>
    
    </div>

</div>
<br />
<article class="divide">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h3 style="font-family: font1, font2;"><?php echo $admin['name']['value'];?></h3>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8" style="font-size: 18px;">
            <?php echo $db->trim_body($admin['mission']['value'],270);?>
            </div>
            
            <div class="col-md-2 center clearlink" style="font-family: font1, font2; margin-top: 4px; margin-bottom: 20px;">
              <a href="about.php#programme">
                <div id="square">
                    <p style="padding-top: 6px;">
                       Programmes &gt;&gt;
                    </p>
                </div>
              </a>
            </div>
            
            <div class="col-md-2 center clearlink" style="font-family: font1, font2; margin-top: 4px;">
              <a href="about.php#staff">
                <div id="square">
                    <p style="padding-top: 6px;">
                    Staff &gt;&gt;
                    </p>
                </div>
              </a>
            </div>
        </div>
        <br /><br />
    </div>
</article>

<div class="container">
	<h3 class="title">Welcome To Our College </h3>
	<div class="wel-grids">
		<div class="col-md-4 wel-grid">
			<div class="port-7 effect-2">
				<div class="image-box">
					<img src="images/2.jpg" class="img-responsive" alt="Image-2">
				</div>
				<div class="text-desc">
					<h4>Studies</h4>
				</div>
			</div>
			<div class="port-7 effect-2">
				<div class="image-box">
					<img src="images/1.jpg" class="img-responsive" alt="Image-2">
				</div>
				<div class="text-desc">
					<h4>Studies</h4>
				</div>
			</div>
		</div>
		<div class="col-md-4 wel-grid">
			<img src="images/6.png"  class="img-responsive" alt="Image-2"/>
			<div class="text-grid">
				<h4>Studies</h4>
			</div>
		</div>
		<div class="col-md-4 wel-grid">
			<div class="port-7 effect-2">
				<div class="image-box">
					<img src="images/3.jpg" class="img-responsive" alt="Image-2">
				</div>
				<div class="text-desc">
					<h4>Studies</h4>
				</div>
			</div>
			<div class="port-7 effect-2">
				<div class="image-box">
					<img src="images/4.jpg" class="img-responsive" alt="Image-2">
				</div>
				<div class="text-desc">
					<h4>Studies</h4>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?php 
require_once"footer.php";
?>