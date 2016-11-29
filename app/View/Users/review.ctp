
<?php echo $this->element('user_menu'); ?>
<section class="main_body">
    <div class="container">
        <div class="row">
                <div class="col-md-3">
                    <?php echo $this->element('user_sidebar'); ?>
                </div>
                <div class="col-md-9">
                    <div class="whit_bg">
                    <div class="right_dash_board1">
                        <h1>Reviews</h1>
                        <div class="search_box">
                            <form name="searchreview" method="post" action="">
                                <div class="row" style="margin:0 auto;">
                                    <div class="form-group col-md-4 pad_0">
                                        <label for="Keywords">Search By Keywords</label>
                                        <input type="text" class="form-control" name="Keywords" id="Keywords" placeholder="Keywords" value="<?php echo isset($Keywords)?$Keywords:'';?>">
                                    </div>
                                    <div class="form-group col-md-2 pad_0">
                                        <label for="EndDate">Date Post</label>
                                        <input type="text" class="form-control" name="EndDate" id="EndDate" placeholder="2016-12-25" value="<?php echo isset($EndDate)?$EndDate:'';?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="submit">SEARCH</button>
                                    </div>
                                    <div style=" clear:both;"></div>
                                </div>
                            </form>
                        </div>
                        <div id="cp_validation_err_msg"></div>
                        
                            <div class="row">
                                <?php  
                                $ReviewCnt=0;
                                if(count($Reviews)>0){
                                    foreach($Reviews as $review){
                                        $ReviewCnt++;
                                        $UserProfile_img=isset($review['TaskBy']['profile_img'])?$review['TaskBy']['profile_img']:'';
                                        $tot_rating=$review['Rating']['rating'];
                                        $uploadImgPath = WWW_ROOT.'user_images';

                                ?>
                                <div class="form-group col-md-12" style="padding:10px 0;">
                                    <div class="col-md-3">
                                      <a href="#">
                                            <?php
                                            if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                                               echo '<img src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" class="media-object" height="150" width="200" />';
                                            }else{
                                                   echo '<img src="'.$this->webroot.'user_images/default.png" alt="" class="media-object" />';
                                            }
                                            ?>
                                      </a>
                                    </div>
                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-8">
                                        <h5 style="font-weight:bold;"><?php echo $review['TaskBy']['first_name'];?> <span><?php echo date('M d',strtotime($review['Rating']['date_time']))?> at <?php echo date('h:i a',strtotime($review['Rating']['date_time']))?> on "<?php echo $review['Task']['title'];?>"</span></h5>
                                        <!--<p style="font-weight:bold;">Errand name: <?php echo $review['Task']['title'];?></p>-->
                                        <strong id="rateStar_<?php echo $ReviewCnt;?>"></strong>

                                        <p><?php echo $review['Rating']['review'];?></p>
                                    </div>
                                </div>    
                                <?php

                        echo '<script>
$(document).ready(function(){
$("#rateStar_'.$ReviewCnt.'").raty({score:'.$tot_rating.',readOnly:true, halfShow : true});
});</script>';
                                    }
                                }else{
                                    echo '<div class="form-group col-md-12"><p>No Record found.</p></div>';
                                }
                                ?> 
                                <div class="col-md-12">   
                             <p>
                            <?php
                            echo $this->Paginator->counter(array(
                            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                            ));
                            ?>	
                            </p>
                        </div>

                         <div class="col-md-12">  
                            <div class="paging">
                            <?php
                                    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                    echo $this->Paginator->numbers(array('separator' => ''));
                                    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                            ?>
                            </div>  
                            </div>  
                                
                            </div>
                        
                    </div> 
                </div>
                </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){       
        $('#EndDate').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>