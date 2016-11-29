<section class="listing_result">
    <div class="container">
      <div class="row training-list-area">
      
       
       <h4>All Featured Providers</h4>
        <div class="category_new" id="posts-list">
        <?php 
        if(!empty($provider))
    {
foreach ($provider as $user_provider) :
  $user_id=$user_provider['User']['id'];
  ?>
                <div class="col-md-3" style="cursor:pointer; width: 25%;
    float: left;
    text-align: center;" onclick="javascript:window.location.href='<?php echo $this->webroot; ?>               users/profile/<?php echo base64_encode($user_id) ?>'">
                        <div class="featr-phto">
                            <?php
                        $uploadImgPath = WWW_ROOT.'user_images';    
                        $per_profile_img=isset($user_provider['UserImage']['0']['originalpath'])?$user_provider['UserImage']['0']['originalpath']:'';
                        if($per_profile_img!='' && file_exists($uploadImgPath . '/' . $per_profile_img)){
                            $ImgLink=$this->webroot.'user_images/'.$per_profile_img;
                        }else{
                            $ImgLink=$this->webroot.'user_images/default.png';
                        } 
                        echo '<img src="'.$ImgLink.'" alt="" height="100px" width="100px"/>';
                             ?>
                            
                        </div>
                        
                        <div>
                            <h4 class="title"><?php echo $user_provider['User']['first_name'].' '.$user_provider['User']['last_name']; ?></h4>
                            <p class="descr">
                                <!--<?php
                                if(strlen(strip_tags($featuredVenue['Post']['post_description'])) > 100) {
                                    echo substr(strip_tags($featuredVenue['Post']['post_description']), 0, 100) . '...';
                                } else {
                                    echo strip_tags($featuredVenue['Post']['post_description']);
                                }
                                ?>-->
                            </p>
                            <p class="location"><span><i class="fa fa-map-marker"></i></span> <?php echo $user_provider['User']['address'] . ', ' . $user_provider['User']['state']; ?></p>
                        </div>
                    </div>
                    
                    <?php endforeach; 

                    }
                    else
                    {
                        echo "There Is No Featured Providers";
                    }
                    ?>
  <?php
echo $this->Paginator->next();
?>
 </section> 

 <script>
  $(function(){
    $('.next').hide();
    var $container = $('#posts-list');
    $container.infinitescroll({
      navSelector  : '.next',    // selector for the paged navigation 
      nextSelector : '.next a',  // selector for the NEXT link (to page 2)
      itemSelector : '.col-md-3',     // selector for all items you'll retrieve
      debug         : true,
      dataType      : 'html',
      loading: {
          finishedMsg: 'There Is No More Featured Providers',
          img: '<?php echo $this->webroot; ?>img/ajax-loader.gif'
        }
      }

    );

  });
</script>   