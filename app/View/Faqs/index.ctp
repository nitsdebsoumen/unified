<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1442184732718233&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="track">
		<div class="container">
			<h1>FAQ</h1>
			<p>THOUgHTFUL CROWDFUNDING </p>
			<div class="track_holder" style="min-height:400px;padding: 40px;">
				

				<?php if(isset($blogs) && !empty($blogs)){
					$a=1;$cnt=count($blogs);?>
				<div class="profile_post" style="width:100%">
					<ul>
					<?php 
					foreach($blogs as $blog)
				   {
						$a++;?>
				   <li>
				   <h3 style="color:#38bcff">Q #<?php echo($a)?></h3>
				   <p style="font-weight:bold;color:#999;font-size: 12px;float:right;letter-spacing:0px;">Posted On : <?php echo(date('M d,Y',strtotime($blog['Faq']['post_date'])))?></p>
				   <h3><?php echo($blog['Faq']['questions'])?></h3>
					<div style="padding: 14px 0px;border-bottom: 1px dashed #ccc;margin: 24px 0px;float: left;width: 100%;">
						

						
						<span style="font-size:12px;">
							<?php echo(nl2br($blog['Faq']['answer']))?>
						<span>
						
					</div>
				   </li>
				   <?php $a++;}?>
					</ul>
				</div>
				<?php 
			   }?>
					
				<div style="width:75%;margin:30px;">
				<div class="fb-comments" data-href="http://thoughtful.org/faqs/index/" data-order-by="reverse_time" data-width="100%" data-numposts="10" data-colorscheme="light"></div>
				</div>
			</div>
		</div>
</div>

<style>
	
/** Paging **/
.paging {
	background:#fff;
	color: #ccc;
	margin-top: 1em;
	clear:both;
	text-align: center;
}
.paging .current,
.paging .disabled,
.paging a {
	text-decoration: none;
	padding: 5px 8px;
	display: inline-block;letter-spacing:0px;
}
.paging p{letter-spacing:0px;}
.paging > span {
	display: inline-block;
	border: 1px solid #ccc;
	border-left: 0;
}
.paging > span:hover {
	background: #efefef;
}
.paging .prev {
	border-left: 1px solid #ccc;
	-moz-border-radius: 4px 0 0 4px;
	-webkit-border-radius: 4px 0 0 4px;
	border-radius: 4px 0 0 4px;
}
.paging .next {
	-moz-border-radius: 0 4px 4px 0;
	-webkit-border-radius: 0 4px 4px 0;
	border-radius: 0 4px 4px 0;
}
.paging .disabled {
	color: #ddd;
}
.paging .disabled:hover {
	background: transparent;
}
.paging .current {
	background: #efefef;
	color: #c73e14;
}
.testibox p{letter-spacing:0px;text-align:left;}
	</style>