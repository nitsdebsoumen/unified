<?php //pr($venueDetails); ?>
<div class="container">
	<div class="row" style="padding:15px 5px;">
		<div class="col-md-4">
			<h3><?php echo $venueDetails['Venue']['venue_name']; ?></h3>
			<p><?php echo $venueDetails['Venue']['sort_of_details']; ?><br/>
				Address : <?php echo $venueDetails['Venue']['address']; ?><br/>
				Email : <?php echo $venueDetails['User']['email_address']; ?><br/>
				Phone No. : <?php echo $venueDetails['User']['Phone_number']; ?></p>
				<p> <button class="btn btn-default"  style="padding: 5px;margin: 0;font-size: 14px;" ><?php echo 'Book Now';?></button> </p>
		</div>
		<div class="col-md-8">
					 <script src="<?php echo $this->webroot ?>js/jssor.slider-21.1.6.min.js" type="text/javascript"></script>
				<script type="text/javascript">
					jssor_1_slider_init = function() {
						
						var jssor_1_SlideshowTransitions = [
						  {$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
						  {$Duration:1200,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
						];
						
						var jssor_1_options = {
						  $AutoPlay: true,
						  $SlideshowOptions: {
						    $Class: $JssorSlideshowRunner$,
						    $Transitions: jssor_1_SlideshowTransitions,
						    $TransitionsOrder: 1
						  },
						  $ArrowNavigatorOptions: {
						    $Class: $JssorArrowNavigator$
						  },
						  $ThumbnailNavigatorOptions: {
						    $Class: $JssorThumbnailNavigator$,
						    $Cols: 10,
						    $SpacingX: 8,
						    $SpacingY: 8,
						    $Align: 360
						  }
						};
						
						var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
						
						//responsive code begin
						//you can remove responsive code if you don't want the slider scales while window resizing
						function ScaleSlider() {
						    var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
						    if (refSize) {
						        refSize = Math.min(refSize, 800);
						        jssor_1_slider.$ScaleWidth(refSize);
						    }
						    else {
						        window.setTimeout(ScaleSlider, 30);
						    }
						}
						ScaleSlider();
						$Jssor$.$AddEvent(window, "load", ScaleSlider);
						$Jssor$.$AddEvent(window, "resize", ScaleSlider);
						$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
						//responsive code end
					};
				
				</script>
				<style>
					/* jssor slider arrow navigator skin 05 css */
					/*
					.jssora05l                  (normal)
					.jssora05r                  (normal)
					.jssora05l:hover            (normal mouseover)
					.jssora05r:hover            (normal mouseover)
					.jssora05l.jssora05ldn      (mousedown)
					.jssora05r.jssora05rdn      (mousedown)
					*/
					.jssora05l, .jssora05r {
						display: block;
						position: absolute;
						/* size of arrow element */
						width: 40px;
						height: 40px;
						cursor: pointer;
						background: url('<?php echo $this->webroot ?>images/a17.png') no-repeat;
						overflow: hidden;
					}
					.jssora05l { background-position: -10px -40px; }
					.jssora05r { background-position: -70px -40px; }
					.jssora05l:hover { background-position: -130px -40px; }
					.jssora05r:hover { background-position: -190px -40px; }
					.jssora05l.jssora05ldn { background-position: -250px -40px; }
					.jssora05r.jssora05rdn { background-position: -310px -40px; }
				
					/* jssor slider thumbnail navigator skin 01 css */
					/*
					.jssort01 .p            (normal)
					.jssort01 .p:hover      (normal mouseover)
					.jssort01 .p.pav        (active)
					.jssort01 .p.pdn        (mousedown)
					*/
					.jssort01 .p {
						position: absolute;
						top: 0;
						left: 0;
						width: 72px;
						height: 72px;
					}
				
					.jssort01 .t {
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						border: none;
					}
				
					.jssort01 .w {
						position: absolute;
						top: 0px;
						left: 0px;
						width: 100%;
						height: 100%;
					}
				
					.jssort01 .c {
						position: absolute;
						top: 0px;
						left: 0px;
						width: 68px;
						height: 68px;
						border: #000 2px solid;
						box-sizing: content-box;
						background: url('<?php echo $this->webroot ?>images/t01.png') -800px -800px no-repeat;
						_background: none;
					}
				
					.jssort01 .pav .c {
						top: 2px;
						_top: 0px;
						left: 2px;
						_left: 0px;
						width: 68px;
						height: 68px;
						border: #000 0px solid;
						_border: #fff 2px solid;
						background-position: 50% 50%;
					}
				
					.jssort01 .p:hover .c {
						top: 0px;
						left: 0px;
						width: 70px;
						height: 70px;
						border: #fff 1px solid;
						background-position: 50% 50%;
					}
				
					.jssort01 .p.pdn .c {
						background-position: 50% 50%;
						width: 68px;
						height: 68px;
						border: #000 2px solid;
					}
				
					* html .jssort01 .c, * html .jssort01 .pdn .c, * html .jssort01 .pav .c {
						/* ie quirks mode adjust */
						width /**/: 72px;
						height /**/: 72px;
					}
				
				</style>
				<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 456px; overflow: hidden; visibility: hidden; background-color: #24262e;">
					<!-- Loading Screen -->
					<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
						<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
						<div style="position:absolute;display:block;background:url('images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
					</div>
					<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 356px; overflow: hidden;">
						<!-- <div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/01.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-01.jpg" />
						</div> -->
						<!-- <a data-u="any" href="http://www.jssor.com" style="display:none">Image Gallery</a> -->
						<?php 
						foreach ($venueDetails['VenueImage'] as $key => $value) { ?>
											
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>venue_image/<?php echo $value['image'];?>" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>venue_image/<?php echo $value['image'];?>" />
						</div>
						<?php } ?>
						<!-- <div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/03.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-03.jpg" />
						</div>
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/04.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-04.jpg" />
						</div>
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/05.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-05.jpg" />
						</div>
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/06.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-06.jpg" />
						</div>
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/07.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-07.jpg" />
						</div>
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/08.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-08.jpg" />
						</div>
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/09.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-09.jpg" />
						</div>
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/10.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-10.jpg" />
						</div>
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/11.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-11.jpg" />
						</div>
						<div data-p="144.50" style="display: none;">
						    <img data-u="image" src="<?php echo $this->webroot ?>images/12.jpg" />
						    <img data-u="thumb" src="<?php echo $this->webroot ?>images/thumb-12.jpg" />
						</div> -->
					</div>
					<!-- Thumbnail Navigator -->
					<div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;" data-autocenter="1">
						<!-- Thumbnail Item Skin Begin -->
						<div data-u="slides" style="cursor: default;">
						    <div data-u="prototype" class="p">
						        <div class="w">
						            <div data-u="thumbnailtemplate" class="t"></div>
						        </div>
						        <div class="c"></div>
						    </div>
						</div>
						<!-- Thumbnail Item Skin End -->
					</div>
					<!-- Arrow Navigator -->
					<span data-u="arrowleft" class="jssora05l" style="top:158px;left:8px;width:40px;height:40px;"></span>
					<span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;"></span>
				</div>
				<script type="text/javascript">jssor_1_slider_init();</script>
		</div>
	</div>
	
	
	<p> </p>
	
	<div class="row" style="padding:15px 0;">
		<div class="col-md-12">
			 <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
				<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
				
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="home">
					<p>
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
					</p>
				</div>
				<div role="tabpanel" class="tab-pane" id="profile">
					<p>
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
					</p>
				</div>
				
			  </div>
		</div>
	</div>
	
	
	
</div>



<style>
.nav-tabs > li > a {
    font-size: 18px;
    color: #000;
    border: 1px solid #888888;
    border-radius: 8px 8px 0 0;
    line-height: 1.42857;
    margin-right: 2px;
    padding: 5px 50px;
}

.tab-content > .tab-pane {padding: 25px 5px;}
</style>
