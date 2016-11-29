<?php //pr($courses); exit;?>
<style>
.btn-default {
    margin-left: 20px;
}
</style>
<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel')) ?>
            <div class="col-md-8">
                <div class="row seachfield-back-area">
                    <div class="col-md-12">
                        <h3>List Course</h3>
                    </div>
                </div>

                <div id="listing-part" class="listing-part">
                    <?php
                    if(!empty($courses)) {
                        foreach ($courses as $course) {

                            if (isset($course['User']['user_logo'])) {
                                $img = $this->webroot . 'user_logo/' . $course['User']['user_logo'];
                            } else {
                                $img = $this->webroot . 'images/no_image.png';
                            }

                            $is_feature=$course['Post']['featured'];

                            ?>
                            <div class="media listing-area">
                                <div class="media-left">
                                    <img src="<?php echo $img; ?>" width="80" height="80"  alt=""/>
                                </div>
                                <div class="media-body listing-mid-area">
                                    <h4 class="media-heading"><?php echo $course['Post']['post_title']; ?></h4>
                                    <p><?php echo substr(strip_tags($course['Post']['post_description']), 0, 100); ?></p>
                                    <div class="star">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <?php
                                    echo $this->Html->link(
                                        'View Details',
                                        array(
                                            'controller' => 'users',
                                            'action' => 'coursedetail',
                                            $course['Post']['slug']
                                        ),
                                        array('class' => 'btn btn-default pull-left')
                                    );
                                    
                                        echo "&nbsp;&nbsp;&nbsp;";
                                        if($is_feature==0)
                                        {
                                            echo $this->Html->link(
                                            'Feature Course',
                                            array(
                                                'controller' => 'posts',
                                                'action' => 'isfeature',
                                                 $course['Post']['id']
                                            ),
                                            array('class' => 'btn btn-default pull-left')
                                           );
                                        }


                                    ?>
                                </div>
                                <div class="media-right">
                                    <div class="listing-rt-area">
                                       <!--  <img src="<?php echo $this->webroot; ?>images/skin-health.jpg" width="60" height="60"  alt=""/> -->
                                        <p>$<?php echo $course['Post']['price']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                    ?>
                        <div class="media listing-area">
                            <h3>Not found</h3>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>