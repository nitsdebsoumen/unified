<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,100' rel='stylesheet' type='text/css'>
<script src="https://d10cq78zmnjvsx.cloudfront.net/js/jquery-1.9.1.gz.min.js"></script>
<script src="https://d10cq78zmnjvsx.cloudfront.net/js/bootstrap-3.1.1/bootstrap.gz.min.js" type="text/javascript"></script>
     <section class="faq-banner-section" style="height: auto">
    	<div class="container" style="width:100%; padding:0;">
            <div class="row" style="margin:0;padding:0;">
            	<!--<div class="col-md-7">
                <div class="intro"><div class="heading"><h1>Frequently Asked Questions</h1></div><div class="sub-heading"><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4></div></div>
                </div>-->
                <div class="col-md-12" style="margin:0;padding:0;">
                	<img style="width:100%;" src="<?php echo $this->webroot;?>images/faq-new.jpg" alt="" class="img-responsive">
                </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <div class="container">
        <!--<div class="row"><div class="col-md-12"><h3>Browse FAQ</h3></div></div>-->
    	<div class="row">
    	
    		
            <?php if(isset($FaqCat) && count($FaqCat)>0){ ?>
                            
            <div class="col-md-3">
                <div class="faq-left">
                    <div id="js-faq-sidebar" class="display-none-smo col-3-md" style="position: static;">
                        <ul class="nav nav-vertical delta-lg">
                            <li class="active"><a href="javascript:void(0)">Browse FAQ</a></li>
                            <?php
                            if(isset($FaqCat) && count($FaqCat)>0){
                                $LeftMenuCnt=0;
                                foreach($FaqCat as $FCatVal){
                                    $LeftMenuCnt++;
                                    if($LeftMenuCnt==1){
                                        //$ActvCls='class="active"';
                                        $ActvCls='';
                                    }else{
                                        $ActvCls='';
                                    }
                                    
                                    echo '<li '.$ActvCls.'><a href="#Category_'.$FCatVal['FaqCategory']['id'].'">'.$FCatVal['FaqCategory']['name'].'</a></li>';
                                }
                            }
                            ?>
                            <!--<li><a href="#investors">Investors</a></li>
                            <li><a href="#fundrise_notes">Fundrise Notes</a></li>
                            <li><a href="#real_estate_companies">Real Estate Companies</a></li>
                            <li><a href="#security">Security</a></li>-->

                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
            <!---------Search----------->
            <form class="form-inline search_form" action="" method="GET">
              <div class="form-group search_input" style="margin-top: 50px;width: 96%;">
                <input type="text" class="form-control" id="inputString" name="searchName" placeholder="Search" style="width: 85% !important; padding: 10px;height: 48px; background: rgba(255, 255, 255, 0.8);">
                <!--<button type="submit" class="btn btn-default btn_blue" style="padding: 13px 0;width: 14%;background-color:#f36800 !important; color: #fff !important;" value="search">Search</button>-->
              </div>              
              <!--<button type="submit" class="btn btn-default btn_blue search_btn">Search</button>-->
			
            </form>
            <!---------Search End----------->
                <div class="panel-group" id="accordion">
                    
                    <?php
                    if(isset($FaqCat) && count($FaqCat)>0){
                        $QCnt=0;$ind=0;
                        foreach($FaqCat as $FCatVal){
                            $FCatPID=$FCatVal['FaqCategory']['id'];
                            if($FCatPID!=''){
                                $FaqQuestion = $this->requestAction('contents/faq_category_wise/'.$FCatPID);
                            }
                            echo '<div id="Category_'.$FCatPID.'" class="faqHeader Category'.$ind.'">'.$FCatVal['FaqCategory']['name'].'</div>';
                            if(isset($FaqQuestion) && count($FaqQuestion)>0){
                                foreach($FaqQuestion as $FaqQues){
                                    $QCnt++;
                                    if($QCnt==1){
                                        $ActiveClass='in';
                                    }else{
                                        $ActiveClass='';
                                    }
                    ?>
                    
                    <div class="panel panel-default Category<?php echo $ind?>_div">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#QuestionAns_<?php echo $FaqQues['Faq']['id'];?>"><?php echo $FaqQues['Faq']['questions'];?></a>
                            </h4>
                        </div>
                        <div id="QuestionAns_<?php echo $FaqQues['Faq']['id'];?>" class="panel-collapse collapse <?php echo $ActiveClass;?>">
                            <div class="panel-body"><?php echo $FaqQues['Faq']['answer'];?></div>
                        </div>
                    </div>
                   
                    <?php
                                }
                            }
                            $ind++;
                        }
                    }
                    ?>
                    
                </div>
            </div>
            <?php }else{
                    echo '<div class="col-md-3"><h2>No Questions Found.</h2></div>';
                }
            ?>

        </div>
    </div>   

<script type="text/javascript">
$(function() {
        if (window.mixpanel) {
                mixpanel.track('FAQ viewed');
        }

        var hashSlug = window.location.hash;
        if (hashSlug && hashSlug.indexOf("#item") == 0) {
                var selectedQuestion = $(hashSlug + '-def');

                selectedQuestion.addClass("in");
                selectedQuestion.prev().removeClass("collapsed");

                if (window.mixpanel) {
                        mixpanel.track('FAQ Opened', { 'Question' : hashSlug });
                }
        }

        $('[data-toggle="collapse"]').on("click", function(e) {
                var hash = '#' + $(e.currentTarget).parent().attr('id');
                window.history.pushState(null, null, hash);

                if (window.mixpanel) {
                        if ($(this).next().hasClass('in')) {
                                mixpanel.track('FAQ Closed', { 'Question' : hash });	
                        } else {
                                mixpanel.track('FAQ Opened', { 'Question' : hash });
                        }
                }
        });

        // Scrollspy
        // ---------

        $("body").scrollspy({
                offset: 111,
                target: "#js-faq-sidebar"
        });

        // Sticky side nav
        // ---------------

        function affixSidebar() {		
                var sidebar = $('#js-faq-sidebar');
                var sidebarInner = sidebar.children().first();
                var content = sidebar.parent();
                var contentIsTallEnough = content.height() > sidebar.height();		

                if(contentIsTallEnough) {
                        var $window = $(window);
                        var width = sidebar.width();

                        sidebarInner.css({width: width});

                        $window.scroll(function() {				
                                var fixedOffset = 126;
                                var offset = content.offset().top;					
                                var offsetBottom = content.height() + content.offset().top - sidebarInner.height();
                                var affixBottom = $window.scrollTop() > offsetBottom - fixedOffset;
                                var affix = $window.scrollTop() > offset - fixedOffset;

                                if(affixBottom) {
                                        sidebarInner.css({
                                                position: 'absolute',
                                                top: '',
                                                bottom: 0
                                        })
                                } else if(affix) {
                                        sidebarInner.css({
                                                position: 'fixed',
                                                top: fixedOffset,
                                                bottom: ''
                                        })
                                } else {
                                        sidebarInner.css({
                                                position: 'relative',
                                                top: '',
                                                bottom: ''
                                        })
                                }
                        });
                }
        }

        function resizeSidebar() {
                var sidebar = $('#js-faq-sidebar');
                var sidebarInner = sidebar.children().first();
                var width = sidebar.width();
                sidebarInner.css({width: width});
        }

        $(function() {
                affixSidebar();

                var timeout;

                $(window).resize(function() {
                        clearTimeout(timeout);
                        timeout = setTimeout(resizeSidebar, 100);
                });
        });


        // Smooth scrolling of side nav links
        // ----------------------------------

        $(".nav-vertical a").click(function(e) {
                e.preventDefault();
                var goto = $(this).attr("href");
                $("html, body").animate({
                        scrollTop: $(goto).offset().top - 110
                }, 350);
        });
        
        $("#inputString").keyup(function () {
		    var filter = $(this).val();
		    
		    $(".panel").each(function () {
			   if ($(this).find('strong').text().search(new RegExp(filter, "i")) < 0 && $(this).find('.panel-body').text().search(new RegExp(filter, "i")) < 0) {
				  $(this).closest('.panel').hide();
				  //$(this).closest('.panel-group').hide();
			   } else {
				  $(this).closest('.panel').show();
				  //$(this).closest('.panel-group').show();
			   }
		    });
		    //console.log($('.faqHeader').length);
		    $('.faqHeader').each(function(){
		    		//console.log($(this).attr("class"));
		    		var value1 = $(this).attr("class").split(' ');
		    		//console.log($('.'+value1['1']+'_div:visible').length);
		    		if($('.'+value1['1']+'_div:visible').length==0)
		    		{
		    			$('.'+value1['1']+'').hide();
		    		}else{
		    			$('.'+value1['1']+'').show();
		    		}
		    });
		});
});


</script>

<style>
    .faqHeader {
        font-size: 27px;
        margin: 20px 0;
    }

    .panel-heading [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        content: "\e072"; /* "play" icon */
        float: right;
        color: #F58723;
        font-size: 12px;
        line-height: 22px;
        /* rotate "play" icon from > (right arrow) to down arrow */
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-heading [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
</style>
