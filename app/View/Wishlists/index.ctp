<?php
//pr($wishlist); exit;
?>
<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel'))?>
            <div class="col-md-8">
                <div class="right_bar">
                    <?php
                        if(!empty($wishlist)){


                    ?>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                        <th style="width:16%;" >Sl.No.</th>
                        <th style="width:26%;" ><?php echo COURSE_NAME; ?></th>
                        <th style="width: 18%;"><?php echo IMAGE; ?></th>
                        <th style="width:49%;"><?php echo DESCRIPTION; ?></th>
                        <th style="width:100%;"><?php echo ACTION;?></th>

                        </tr>
                        <?php $count=1; 
                        foreach ($wishlist as $item){
                                if($item['Post']['User']['user_logo']!=''){
                                  $img = $this->webroot.'user_logo/'.$item['Post']['User']['user_logo'];
                                }
                                else{
                                  $img = $this->webroot.'images/no_image.png';   
                                }
                         ?>

                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $item['Post']['post_title']; ?></td>
                            <td><img src="<?php echo $img; ?>" style="width:80px;"> </td>
                            <td><?php echo $item['Post']['post_description']; ?></td>
                            <td>
                                <button class="btn btn-success btn-success-green remove_wishlist" id="<?php echo $item['Wishlist']['id']; ?>"  style="width:80px;"><?php echo "Remove"?></button>
                            </td>
                            <input type="hidden" id="wishlist_id" value="<?php echo $item['Wishlist']['id']; ?>" >
                        </tr>
                        <?php
                            $count=$count+1;
                          } ?>
                    </table>
                    <?php
                     }
                    else
                    {
                        echo "There is no wishlist";
                    }

                    ?>


                </div>
            </div>
        </div>
    </div>
    <div id="div1"></div>
</section>
<script>
$(document).ready(function(){
    $(".remove_wishlist").click(function(){
        var wish_id = $(this).attr('id');

        $.ajax({
            url: "<?php echo $this->webroot; ?>wishlists/ajaxremoveWishlist",
            type: 'post',
            dataType: 'json',
            data: {
                id:wish_id
            },
            success: function(result){
                console.log(result);
                if(result=='1')
                {
                    location.reload();
                }
                else
                {
                    location.reload();
                }

            }
        });
    });
});
</script>