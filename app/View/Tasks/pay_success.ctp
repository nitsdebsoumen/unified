<?php ?>     
<section class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php echo $this->element('user_sidebar'); ?>
            </div>
            <div class="col-md-9 whit_bg">
            
            <div class="right_dash_board" >
            	
            	<h4><?php echo $task['Task']['title'];?></h4>
            	
            	<div class="row">
            	     <div class="form-group col-md-12">
					<div class="col-md-10 mainDiv" >
						<h1>You have accepted the Offer</h1>
						<br>“Your amount is safe in the Errand Champion. Once your errand is done then you can release the fund.”
					</div>
				</div>
			</div>		
            	
            </div>
            
                
            </div>
        </div>
    </div>
</section>

<script>  
$('.right_dash_board').enscroll({
    showOnHover: false,
    verticalTrackClass: 'track3',
    verticalHandleClass: 'handle3'
});


</script>
<style>
.mainDiv{
padding: 10px 20px;
border: 1px solid #ddd;
border-radius: 5px;
margin: 20px;
}
.float_right{
float:right
}
</style>

                
                
