<section class="section-one" style="background: url('<?php echo $this->webroot;?>images/back.jpg'); background-size:cover; background-position:center center;">
    <div class="container" style="padding:0; margin:0 auto;" > 
      <div class="row">
        <div class="col-md-12">
          <div class="images-back" >
            <div class="col-md-12 text-center;" style="padding: 30px 0 10px 0;">
              <img src="<?php echo $this->webroot;?>images/tr.png" class="img-responsive" style="margin:0 auto;">
            </div>
            <div class="col-md-12 text-center;" style="padding: 20px 0 50px 0;">
              <h1 style="text-align:center;color:#fff;">CHAMPIONS</h1>
              <p style="text-align:center;color:#fff;">Meet the top 1% of all Errand Champion. The best of the best. The elite.</p>
              <p style="text-align:center;color:#fff;">Complete errands, get positive feedback and provide helpful comments to increase your score.</p>

            </div>

          </div>
        </div>
      </div>
      </div>
   </section>
<div class="container-fluid">
        <div class="row"><div class="col-md-12">&nbsp;</div></div>  
      <div class="row">
            <div class="search_box">
                    <!--<h2>SEARCH ERRANDS</h2>-->
                    <form name="searchTask" method="post" action="">
                    <div class="row" style="background:#fff; padding: 10px 0 0 0;">
                        <div class="form-group col-md-1">&nbsp;</div>
                            <div class="form-group col-md-2 pad_0">
                                <label for="Keywords">Search By Errand Champion</label>
                                <input type="text" class="form-control" name="Keywords" id="Keywords" placeholder="Keywords" value="<?php echo isset($Keywords)?$Keywords:'';?>">
                            </div>
                            
                            <div class="form-group col-md-2 pad_0">
                                <label for="rating">Rating</label>
                                <select name="rating" class="form-control" id="rating">
                                    <option value="">Select Option</option>
                                    <option value="1" <?php echo ($rating=='1')?'selected="selected"':'';?>>1</option>
                                    <option value="2" <?php echo ($rating=='2')?'selected="selected"':'';?>>2</option>
                                    <option value="3" <?php echo ($rating=='3')?'selected="selected"':'';?>>3</option>
                                    <option value="4" <?php echo ($rating=='4')?'selected="selected"':'';?>>4</option>
                                    <option value="5" <?php echo ($rating=='5')?'selected="selected"':'';?>>5</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2 pad_0">
                                <label for="user_verified">Verified</label>
                                <select name="user_verified" class="form-control" id="user_verified">
                                    <option value="">Select Option</option>
                                    <option value="1" <?php echo ($user_verified=='1')?'selected="selected"':'';?>>Yes</option>
                                    <option value="0" <?php echo ($user_verified=='0')?'selected="selected"':'';?>>No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 pad_0">
                                <label for="Search_user_location">Person Location</label>
                                <input type="text" class="form-control" name="user_location" value="<?php echo isset($user_location)?$user_location:'';?>" id="Search_user_location">
                            </div>
                            
                            <div class="form-group col-md-1">
                                <button type="submit">SEARCH</button>
                            </div>
                    </div>
                    </form>
            </div>
        </div>  
      <div class="row">
        <div class="table-responsive" style="background:#fff;">          
        <table class="table table-one">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Errand Champion</th>
              <th>Rating</th>
              <th>Reviews</th>
              <th>Completed</th>
              <th>Posted</th>
              <th>Person Location</th>
              <!--<th>
                <div class="form-group" style="margin-bottom:0px;">
                <select class="form-control" id="sel1">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
               </div>
              </th>-->
            </tr>
          </thead>

        </table>
        </div>
      </div>
    
</div>

<section class="section-two">
    <div class="container-fluid">
    <div class="row" style="width:100%; margin:0 auto;">
        <div class="table-responsive">          
        <table class="table table-two">

            <tbody>
                <?php
                if(count($user_list)>0){
                    $UserCnt=0;
                    foreach($user_list as $val){
                        $UserCnt++;
                        $UserID=$val['User']['id'];
                        $tot_rating=$val['User']['tot_rating'];
                        $tot_review=$val['User']['tot_review'];
                        $Userlocation=$val['User']['location'];
                        //$UserID=$val['User']['id'];
                ?>
                    <tr>
                        <td><?php echo $UserCnt;?></td>

                        <td>
                            <?php
                            $UserProfile_img=isset($val['User']['profile_img'])?$val['User']['profile_img']:'';
                            $uploadImgPath = WWW_ROOT.'user_images';
                            if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                                echo '<img style="float:left; width:18%" src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" class="media-object" height="25" width="25" />';
                            }else{
                                echo '<img style="float:left; width:18%" src="'.$this->webroot.'user_images/default.png" alt="" class="media-object" style="width: 25px; height: 25px;" />';
                            }
                            ?> &nbsp; &nbsp; <a style="float:left; display:inline-block;padding:0 2px;" href="<?php echo $this->webroot;?>users/profile/<?php echo base64_encode($UserID);?>" data-toggle="tooltip" data-placement="right" title=""><?php echo $val['User']['first_name'].' '.$val['User']['last_name'];?> </a></td>
                        <td>
                            <div id="stars">
                                <strong id="rateStar_<?php echo $UserID;?>"></strong>
                            </div>
                        <?php

                        echo '<script>
$(document).ready(function(){
$("#rateStar_'.$UserID.'").raty({score:'.$tot_rating.',readOnly:true, halfShow : true});
});</script>';
                        ?>
                        </td>
                        <td><?php echo $tot_review;?></td>
                        <td><?php echo $this->requestAction('users/get_tot_completed_task/'.$UserID); ?></td>
                        <td><?php echo $this->requestAction('users/get_tot_posted_task/'.$UserID); ?></td>
                        <td><?php echo $Userlocation;?></td>
                    </tr>
                <?php
                    }
                }else{
                    echo '<tr><td colspan="7"><p>No result found.</p></td></tr>';
                }
                ?>
          </tbody>
        </table>
            <p>
            <?php
            echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>	
            </p>
            <div class="paging" style="margin-bottom: 20px;">
            <?php
                echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
            </div>     
        </div>
</div>
       
    </div>
    </section>

<style type="text/css">
th {width: 12.5%}
td{width: 12.5%}
/*.section-one {position: fixed; width:100%;}*/
.section-one {width:100%;}
.section-two {/*height:400px; overflow-y: scroll;*/ width:100%; overflow: hidden;}
table.table.table-two tr td {
border-top: 1px solid white;
}

table.table.table-one tr th {
background: rgba(252, 249, 249, 0.760784);
}
</style>
<script type="text/javascript">
    
    function initialize2() {
        var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(7.623887, 68.994141),
        new google.maps.LatLng(37.020098, 97.470703));

        var input1 = document.getElementById('Search_user_location');
        var options = {
            bounds: defaultBounds,
            types: ['geocode'],
        };
        autocomplete1 = new google.maps.places.Autocomplete(input1, options);
    }
    
</script>
<script>
$(document).ready(function(){
    initialize2();
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
