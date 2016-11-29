<?php
if (!isset($_REQUEST["aid"])) {
    header("location: index.php");
}

include("config/connect.php");
include_once 'data/auction.php';
include_once 'data/avatar.php';
include_once 'common/sitesetting.php';
include_once 'common/seosupport.php';
include("functions.php");

//print_r($_SESSION);

$prid = isset($_REQUEST["pid"]) ? chkInput($_REQUEST["pid"], 'i') : 0; // never to use

if (isset($_REQUEST["aid"])) {
    $aucid = chkInput($_REQUEST["aid"], 'i');
    $aucid = $aucid == 0 ? 1 : $aucid;
} else {
    $aucid = 1;
    header("location: index.php");
}

$uid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : 0;

$qrysel = "select shippingcharge,auc_plus_price, username,avatar,adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,

        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,am.picture as auctypepic,

        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,lockauction,locktype,lockprice,locktime,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,picture2,picture3,picture4,short_desc,long_desc,

        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
        "from auction a left join products p on p.productID=a.productID left join bidpack b on b.id=a.productID " .
        "left join auc_due_table adt on a.auctionID=adt.auction_id left join registration r on a.buy_user=r.id " .
        "left join shipping sp on a.shipping_id=sp.id " .
        "left join avatar av on av.id=r.avatarid " .
        "left join auction_management am on am.auc_manage=a.time_duration where a.auctionID=$aucid";



$ressel = mysql_query($qrysel);

if (mysql_num_rows($ressel) <= 0) {
    header("location:{$SITE_URL}index.php");
}

$obj = mysql_fetch_array($ressel);

mysql_free_result($ressel);

$categoryname = mysql_fetch_array(mysql_query("select `name` from `categories` where `categoryID`='" . $obj['categoryID'] . "'"));

$pname = $obj['bidpack'] ? $obj['bidpack_name'] : $obj['name'];
$picture = $obj['bidpack'] ? $obj['bidpack_banner'] : $obj['picture1'];
$picture2 = $obj['bidpack'] ? $obj['bidpack_banner2'] : $obj['picture2'];
$picture3 = $obj['bidpack'] ? $obj['bidpack_banner3'] : $obj['picture3'];
$picture4 = $obj['bidpack'] ? $obj['bidpack_banner4'] : $obj['picture4'];
$price = $obj['bidpack'] ? $obj['bidpack_price'] : $obj['price'];
$short_desc = $obj['bidpack'] ? "{$obj['bid_size']} Bids and {$obj['freebids']} Freebids" : $obj['short_desc'];
$long_desc = $obj['bidpack'] ? $short_desc : $obj['long_desc'];


if ($obj['uniqueauction'] == 1) {
    $dynamicClass = 'orange_box';
    $bottomClass = 'orange_bg';
    $cornerImag = 'images/orange_right.png';
    $auctionType = 'Lowest Unique Bid';
} else if ($obj['reverseauction'] == 1) {
    $dynamicClass = 'sky_box';
    $bottomClass = 'sky_bg';
    $cornerImag = 'images/sky_right.png';
    $auctionType = 'Reverse Auction';
} else if ($obj['pennyauction'] == 1) {
    $dynamicClass = 'green_box';
    $bottomClass = 'green_bg';
    $cornerImag = 'images/green_right.png';
    $auctionType = 'Penny Auction';
} else {
    $dynamicClass = 'green_box';
    $bottomClass = 'green_bg';
    $cornerImag = 'images/green_right.png';
    $auctionType = 'XXX';
}


$onlineperbidvalue = Sitesetting::getBidPrice();

//the price - bid times
$aucdb = new Auction(null);
$buynowprice = $aucdb->getBuynowPrice($uid, $aucid);


if ($uid <> 0) {
    $reswatch = mysql_query("select count(*) from watchlist where auc_id=$aucid and user_id=$uid");

    if (mysql_num_rows($reswatch) > 0) {
        $totalwatch = mysql_result($reswatch, 0);
        //$totalwatch = $totalwatch !== FALSE ? 0 : $totalwatch;
    } else {
        $totalwatch = 0;
    }
    mysql_free_result($reswatch);
} else {
    $totalwatch = 0;
}

$resregmsg = mysql_query("select reg_message from general_setting where id=4");
$regmsg = mysql_num_rows($resregmsg) > 0 ? mysql_result($resregmsg, 0) : FALSE;
mysql_free_result($resregmsg);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $AllPageTitle; ?></title>

        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
        
        <script src="js/jquery.js"></script>


        <script src="js/function.js"></script>
        <script src="js/flashauction.js"></script>
        <script src="js/default.js"></script>

        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

        <script language="javascript" type="text/javascript">

            var onlineperbidvalue = <?= $onlineperbidvalue; ?>;
            function hideDisplayBids(id) {
                if (id == 1) {
                    $('#producthistory1_hidden').css('display', 'none');
                    $('#producthistory1').css('display', 'block');
                }

                if (id == 2) {
                    $('#producthistory1_hidden').css('display', 'block');
                    $('#producthistory1').css('display', 'none');
                }
            }

            function ShowMyButler(id) {
                if (id == 1) {
                    $('#bidbutler_show_main').css('display', 'block');
                    $('#bidbutler_hide').css('display', 'none');
                }

                if (id == 2) {
                    $('#bidbutler_show_main').css('display', 'none');
                    $('#bidbutler_hide').css('display', 'block');
                }
            }

            function addWatchlist(auc_id, uid) {
                var url2 = "addwatchauction.php";//?aid="+auc_id+"&uid="+uid;
                $.ajax({
                    type: "POST",
                    url: url2,
                    data: {aid: auc_id, uid: uid},
                    success: function () {
                        alert("<?php echo AUCTION_SUCCESSFULLY_ADDED_TO_YOUR_WATCHLIST; ?>");
                        $('#added_watchlist').css('display', 'block');
                        $('#notadded_watchlist').css('display', 'none');
                    }
                });
            }

            function addautobid() {
                if (jQuery('#bookbidbutlerbutton1').attr('name') != "") {
                    var bidbutstartprice = parseFloat(jQuery('#bid_form').val());
                    var bidbutendprice = parseFloat(jQuery('#bid_to').val());
                    var totalbids = jQuery('#bid_bids').val();

                    if (bidbutstartprice == "") {
                        alert("Please enter AutoBidder start price!");
                        return false;
                    }

                    if (bidbutendprice == "") {
                        alert("Please enter AutoBidder end price!");
                        return false;
                    }

                    if (totalbids == "") {
                        alert("Please enter AutoBidder bids!");
                        return false;
                    }

                    if (totalbids <= 1) {
                        alert("You palce AutoBidder for more than one bid!");
                        return false;
                    }

                    if (jQuery('#isreverseauction').val() == '0' || jQuery('#isreverseauction').val() == '') {
                        if (bidbutstartprice <= bidbutendprice) {
                        }
                        else
                        {
                            alert("AutoBidder start price must greater than end price!");
                            return false;
                        }
                    } else {
//                        if (bidbutstartprice <= bidbutendprice) {
//                        }
//                        else
//                        {
//                            alert("AutoBidder start price must greater than end price for reverse auction!");
//                            return false;
//                        }
                    }

                    if (jQuery('#uniquebid').val() == 1) {

                        jQuery.ajax({
                            url: "addbidbutlerforunibid.php?aid=<?php echo $_GET['aid'] ?>" + "&bidsp=" + bidbutstartprice + "&bidep=" + bidbutendprice + "&totb=" + totalbids,
                            dataType: 'json',
                            success: function (data) {
                                //alert(data);

                                jQuery.each(data, function (i, item) {

                                    if (item.result) {

                                        result = item.result.split("|");

                                        if (result == "unsuccessprice") {

                                            alert("<?php echo LANG_REVERSE_AUCTION_ERROR;  ?>");

                                        } else if (result[0] == "unsuccess") {

                                            if (result[1] == 1) {

                                                alert("You don't have sufficient Bid  points in your account!");

                                            } else {

                                                alert(result[1]);

                                            }

                                        }

                                    } else {
                                        for (j = 0; j < data.butlerslength.length; j++) {
                                            if (data.butlerslength[j].bidbutler.startprice != "") {
                                                if (Number(j) < Number(data.butlerslength.length)) {
                                                    butlerstartprice = CurrencySymbol + data.butlerslength[j].bidbutler.startprice;
                                                    butlerendprice = CurrencySymbol + data.butlerslength[j].bidbutler.endprice;
                                                    butlerbid = data.butlerslength[j].bidbutler.bids;
                                                    but_id = data.butlerslength[j].bidbutler.id;
                                                    $.ajax({
                                                        url: "addbidbutlerforunibid1.php?aid=<?php echo $_GET['aid'] ?>" + "&bidsp=" + bidbutstartprice + "&bidep=" + bidbutendprice + "&totb=" + totalbids + "&uid=<?php echo $uid; ?>&bidbuttler=" + but_id,
                                                        success: function (data) {

                                                            $.ajax({
                                                                url: 'getbidhistrydetailsunique.php?aid=<?php echo $_GET['aid'] ?>&uid=<?php echo $uid; ?>',
                                                                success: function (data) {

                                                                    data1 = data.split("|");
                                                                    $('#tab_history').html('');
                                                                    $('#tab_mybid').html('');
                                                                    $('#tab_history').html(data1['0']);
                                                                    $('#tab_mybid').html(data1['1']);

                                                                }
                                                            });
                                                        }
                                                    });
                                                }
                                            }
                                        }
                                        jQuery('#bid_form').val('');

                                        jQuery('#bid_to').val('');

                                        jQuery('#bid_bids').val('');

                                        jQuery('#butlermessage').show();

                                        changeMessageTimer = setInterval("ChangeButlerImageSecond()", 5000);

                                        //changedatabutler(data,"abut",totalbids);

                                    }

                                });

                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                            }

                        });
                    }
                    else
                    {

                        jQuery.ajax({
                            url: "addbidbutler.php?aid=<?php echo $_GET['aid'] ?>" + "&bidsp=" + bidbutstartprice + "&bidep=" + bidbutendprice + "&totb=" + totalbids,
                            dataType: 'json',
                            success: function (data) {

                                jQuery.each(data, function (i, item) {

                                    if (item.result) {

                                        result = item.result.split("|");

                                        if (result == "unsuccessprice") {

                                            alert("BID FROM Value needs to be greater than the Current Auction Price!");

                                        } else if (result[0] == "unsuccess") {

                                            if (result[1] == 1) {

                                                alert("You don't have sufficient Bid  points in your account!");

                                            } else {

                                                alert(result[1]);

                                            }

                                        }

                                    } else {

                                        jQuery('#bid_form').val('');

                                        jQuery('#bid_to').val('');

                                        jQuery('#bid_bids').val('');

                                        jQuery('#butlermessage').show();

                                        changeMessageTimer = setInterval("ChangeButlerImageSecond()", 5000);

                                        changedatabutler(data, "abut", totalbids);

                                    }

                                });

                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                            }

                        });



                        return false;
                    }

                }

            }

            $(document).ready(function(){
//                $("#tab_history, #tab_mybid").mCustomScrollbar({
//                    setHeight: 300,
//                    scrollButtons:{
//                        enable:true,
//                        scrollType:"stepped"
//                    },
//                    keyboard:{
//                        scrollType:"stepped"
//                    },
//                    mouseWheel:{
//                        scrollAmount:188,
//                        normalizeDelta:true
//                    },
//                    theme:"rounded-dark",
//                    autoExpandScrollbar:true,
//                    snapAmount:188,
//                    snapOffset:65
//                });
            });

        </script>

    </head>
    <body onLoad="OnloadPage();">
        <header>
            <nav class="navbar navbar-default">
                <div class="container">

                    <?php
                    require_once 'header.php';
                    require_once 'include/topmenu.php';
                    ?>

                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <div class="placeholder">
            <div class="container">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="javascript:void(0);"><?php echo $categoryname['name']; ?></a></li>
                    <li><a href="javascript:void(0);"><?php echo $pname; ?></a></li>
                </ul>
            </div>
        </div>
        <input type="hidden" name="uniquebid" id="uniquebid" value="<?php
        if (isset($obj["uniqueauction"]) && $obj["uniqueauction"] == 1) {
            echo "1";
        } else {
            echo "0";
        }
        ?>"/>
        <div class="main_body">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="live_box details_body">
                            <div class="row details_box_top">
                                <div class="col-md-7">
                                    <h2><?php echo $pname; ?></h2>
                                    <p><?php echo Retail_Price; ?> <b>฿<?php echo $price; ?></b></p>
                                </div>
                                <div class="col-md-5">
                                    <span><?= SHARE_THE_EXCITEMENT; ?></span>
                                    <ul>
                                        <li><a href="javascript: void(0);" onClick="facebook_share()"><img src="images/fb_icon.png" alt="" /></a></li>
<!--                                        <li><a href="javascript: void(0);" onClick="lnShare()"><img src="images/google_icon.png" alt="" /></a></li>-->
                                        <li><a href="https://plus.google.com/share?url='<?php echo SITE_URL . '/viewproduct.php?aid=' . $aucid; ?>'" onClick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;" class="share_gplus"><img src="images/google_icon.png" alt="" /></a></li>
                                        <li><a href="javascript: void(0);" onClick="lnShare()"><img src="images/in.png" alt="" /></a></li>
                                        <li><a href="javascript: void(0);" onClick="twShare()"><img src="images/tweet-icon.png" alt="" /></a></li>
                                    </ul>
                                </div>

                                <script>
                                    function facebook_share() {

                                        $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
                                            FB.init({
                                                appId: '1755198294739537',
                                                cookie: true,
                                                status: true,
                                                xfbml: true,
                                                version: 'v2.7'
                                            });

                                            FB.ui({
                                                method: 'feed',
                                                name: '<?php echo $pname; ?>',
                                                link: '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>',
                                                picture: '<?= 'http://' . $_SERVER['HTTP_HOST'] . '/' . $UploadImagePath . 'products/' . $picture; ?>',
                                                caption: 'sanookbids.com',
                                                description: '<?php echo strip_tags($long_desc); ?>'
                                            },
                                            function (response) {
                                                if (response && response.post_id) {
                                                    inserIntoAuctionShare('fb');
                                                } else {
                                                    //alert('Post was not published.');
                                                }
                                            }
                                            );

                                        });

                                    }



                                    function twShare(url, title, descr, image, winWidth, winHeight) {
                                        var url = '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
                                        var title = '<?php echo $pname; ?>';
                                        var winWidth = '350px';
                                        var winHeight = '350px';

                                        var winTop = (screen.height / 2) - (winHeight / 2);
                                        var winLeft = (screen.width / 2) - (winWidth / 2);
                                        window.open('http://twitter.com/share?url=' + encodeURI(url) + '&text=' + encodeURI(title) + '', 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
                                        inserIntoAuctionShare('tw');

                                    }

                                    function lnShare() {
                                        var url = '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
                                        var title = '<?php echo $pname ?>';
                                        var descr = '<?php echo strip_tags ($long_desc); ?>';

                                        var articleUrl = encodeURIComponent(url);
                                        var articleTitle = encodeURIComponent(title);
                                        var articleSummary = encodeURIComponent(descr);
                                        var articleSource = encodeURIComponent('Sanookbids');
                                        var goto = 'http://www.linkedin.com/shareArticle?mini=true' +
                                                '&url=' + articleUrl +
                                                '&title=' + articleTitle +
                                                '&summary=' + articleSummary +
                                                '&source=' + articleSource;
                                        window.open(goto, "LinkedIn", "width=800,height=400,scrollbars=no;resizable=no");
                                        inserIntoAuctionShare('ln');
                                    }

                                    function inserIntoAuctionShare(type) {
                                        <?php
                                        if (!isset($_SESSION['userid']) || $_SESSION['userid'] == '') {
                                        ?>
                                            return false;
                                        <?php
                                        } else {
                                        ?>
                                        $.post(
                                                "<?php echo SITE_URL . '/functions/ajax-handle.php?action=inserIntoAuctionShare'; ?>",
                                                {
                                                    uid: "<?php echo $_SESSION['userid']; ?>",
                                                    aid: "<?php echo $aucid; ?>",
                                                    type: type
                                                }
                                        );
                                        <?php
                                        }
                                        ?>
                                    }
                                </script>

                            </div>
                            <?php
                            if ($obj['uniqueauction'] == 1) {
                                $dynamicClass = 'orange_details_box';
                                $bottomClass = 'orange_bg';
                                $cornerImag = 'images/orange_right.png';
                                $auctionType = 'Lowest Unique Bid';
                            } else if ($obj['reverseauction'] == 1) {
                                $dynamicClass = 'sky_details_box';
                                $bottomClass = 'sky_bg';
                                $cornerImag = 'images/sky_right.png';
                                $auctionType = 'Bonanza!';
                            } else if ($obj['pennyauction'] == 1) {
                                $dynamicClass = 'green_details_box';
                                $bottomClass = 'green_bg';
                                $cornerImag = 'images/green_right.png';
                                $auctionType = 'Penny Auction';
                            } else {
                                $dynamicClass = 'green_details_box';
                                $bottomClass = 'green_bg';
                                $cornerImag = 'images/green_right.png';
                                $auctionType = 'XXX';
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="<?php echo $dynamicClass; ?>" style="position:relative;">
                                        <h2 style="font-family: 'comicbd';font-size: 14px;
                                            font-weight: normal;line-height: 15px;position: absolute;text-align: left;text-transform: uppercase;top:-17px;width:70px;z-index: 999;right:11px;color:#fff;"><?php echo $auctionType; ?></h2>
                                        <img src="<?php echo $cornerImag; ?>" alt=""  class="panny" style="width:100px;"/>
                                        <div class="product_box">
                                            <?php
                                            if ($picture != "") {
                                                echo '<img src="' . $UploadImagePath . 'products/' . $picture . '" alt="" />';
                                            } else if ($picture2 != "") {
                                                echo '<img src="' . $UploadImagePath . 'products/' . $picture2 . '" alt="" />';
                                            } else if ($picture3 != "") {
                                                echo '<img src="' . $UploadImagePath . 'products/' . $picture3 . '" alt="" />';
                                            } else if ($picture4 != "") {
                                                echo '<img src="' . $UploadImagePath . 'products/' . $picture4 . '" alt="" />';
                                            }
                                            ?>

                                        </div>
                                        <div class="product_box_bottom">
                                            <ul class="bxslider2" style="visibility: hidden;">
                                                <?php
                                                if ($picture != "") {
                                                    echo '<li><img src="' . $UploadImagePath . 'products/' . $picture . '" alt="" /></li>';
                                                }
                                                if ($picture2 != "") {
                                                    echo '<li><img src="' . $UploadImagePath . 'products/' . $picture2 . '" alt="" /></li>';
                                                }
                                                if ($picture3 != "") {
                                                    echo '<li><img src="' . $UploadImagePath . 'products/' . $picture3 . '" alt="" /></li>';
                                                }
                                                if ($picture4 != "") {
                                                    echo '<li><img src="' . $UploadImagePath . 'products/' . $picture4 . '" alt="" /></li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="orange_by_box">
                                            <div class="media">
                                                <div class="media-left media-middle">
                                                    <?php
                                                    if ($obj['allowbuynow'] == 1) {
                                                        if ($obj['uniqueauction'] == 0) {
                                                            if ($uid == 0) {
                                                    ?>
                                                                <a href="login.php"><img alt="" src="images/cart_icon.png"></a>
                                                    <?php
                                                            } else {
                                                                $endtime = strtotime('+3 day', strtotime($obj["auc_end_date"]));
                                                                $now = strtotime(date('y-m-d h:i:s'));
                                                                ?>
                                                                <a href="javascript: void(0);" id="buynow_<?= $obj["auctionID"]; ?>" <?php if ($winner['userid'] == $uid) { ?>onclick="javascript:alert('<?php echo TOPBIDDERERRORMESSAGE; ?>')"<?php } if ($endtime < $now && $obj["auc_status"] == '3') { ?>onclick="javascript:alert('<?php echo DATEERRORMESSAGE; ?>')" <?php } else { ?> onClick="window.location.href = '<?php echo SITE_URL; ?>/buyitnow.php?auctionId=<?= $obj["auctionID"]; ?>&uid=<?= $uid; ?>'" <?php } ?>><img alt="" src="images/cart_icon.png"></a>
                                                    <?php
                                                            }
                                                        } else {
                                                            if ($uid == 0) {
                                                    ?>
                                                                <a href="login.php"><img alt="" src="images/cart_icon.png"></a>
                                                    <?php
                                                            } else {

                                                                $endtime = strtotime('+3 day', strtotime($obj["auc_end_date"]));
                                                                $now = strtotime(date('y-m-d h:i:s'));
                                                    ?>
                                                                <a href="javascript: void(0);" id="buynow_<?= $obj["auctionID"]; ?>" <?php if ($winner['userid'] == $uid) { ?>onclick="javascript:alert('<?php echo TOPBIDDERERRORMESSAGE; ?>')"<?php } if ($endtime < $now && $obj["auc_status"] == '3') { ?>onclick="javascript:alert('<?php echo DATEERRORMESSAGE; ?>')" <?php } else { ?> onClick="window.location.href = '<?php echo SITE_URL; ?>/buyitnow.php?auctionId=<?= $obj["auctionID"]; ?>&uid=<?= $uid; ?>'" <?php } ?>><img alt="" src="images/cart_icon.png"></a>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><?= Buy_Now; ?></h4>
                                                    <span><?php echo GET_UPTO_200_VALUE_BID; ?>, </span>
                                                    <a href="<?php echo SITE_URL . '/how-it-works.php#buy_now_work' ?>"><?php echo LEARN_MORE; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="<?php echo $dynamicClass; ?> detail_bid_now auction-item <?php echo ($obj['uniqueauction'] == 1) ? 'unic_bid_right' : ''; ?>" title="<?php echo $obj["auctionID"]; ?>" id="auction_<?= $obj["auctionID"]; ?>">
                                        <b class="time"><i class="fa fa-clock-o"></i> <span id="counter_index_page_<?= $obj["auctionID"]; ?>">TIME LEFT</span></b>
                                        <script language="javascript">document.getElementById('counter_index_page_<?= $obj["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?= $obj["auc_due_time"]; ?>');</script>
                                        
                                        <?php
                                        if ($obj['auc_status'] == 3) {
                                            echo '<span><strong>' . date('d/m/Y', strtotime($obj['auc_end_date'])) . ' ' . date('H:i:s', strtotime($obj['auc_end_time'])) . '</strong></span>';
                                        }
                                        ?>
                                        
                                        
                                            <?php if ($obj['uniqueauction'] == 0) { ?>
                                                <strong id="price_index_page_<?php echo $obj["auctionID"]; ?>"></strong>
                                            <?php } else {
                                                ?>
                                                <strong id="ubid_index_page_<?php echo $obj["auctionID"]; ?>">&nbsp;<b><?php echo BIDS; ?></b></strong>
                                            <?php } ?>
                                        

                                        <?php if ($obj['uniqueauction'] == 0) { ?>
                                            <span id="product_bidder_<?= $obj["auctionID"]; ?>">No Bidder</span>
                                        <?php } else { ?>
                                            <span id="product_bidder_<?= $obj["auctionID"]; ?>">No Bidder</span>

                                            <div class="custome_text_box" data-toggle="tooltip" data-placement="top" title="<?= Single_bid_in_Thai_baht_with_2_digits; ?>">
                                                <input id="lowestprice_<?php echo $obj["auctionID"]; ?>" <?php echo $uid == 0 ? 'disabled' : ''; ?> name="lowestprice_<?php echo $obj["auctionID"]; ?>" type="text" />
                                                <img alt="" src="images/arror_right.png">
                                            </div>
                                            
                                            

                                        <?php } ?>






                                        <?php
                                        if ($obj['uniqueauction'] == 0) {
                                            if ($uid == 0) {
                                                ?>
                                                <button id="image_main_<?= $obj["auctionID"]; ?>" class="hammer_button"  onclick="javascript:document.getElementById('emaillogin').focus();" onMouseOut="$(this).text('<?php echo PLACE_BID; ?>')" onMouseOver="$(this).text('<?php echo Login; ?>')"><?php echo PLACE_BID_NEW; ?></button>
                                            <? } else { ?>
                                                <button id="image_main_<?= $obj["auctionID"]; ?>" class="hammer_button bid-button-link" name="getbid.php?prid=<?= $obj["productID"]; ?>&aid=<?= $obj["auctionID"]; ?>&uid=<?= $uid; ?>"><?php echo PLACE_BID_NEW; ?></button>
                                                <?php
                                            }
                                        } else {
                                            if ($uid == 0) {
                                                ?>
                                                <button id="image_main_<?php echo $obj["auctionID"]; ?>" class="hammer_button"  onclick="javascript:document.getElementById('emaillogin').focus();" onMouseOut="$(this).text('<?php echo PLACE_BID_NEW; ?>')" onMouseOver="$(this).text('<?php echo Login; ?>')"><?php echo PLACE_BID_NEW; ?></button>
                                            <?php } else { ?>
                                                <button id="image_main_<?php echo $obj["auctionID"]; ?>" class="hammer_button ubid-button-link" rel="<?php echo $obj["auctionID"]; ?>" name="getuniquebid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID_NEW; ?></button>
                                                <?php
                                            }
                                        }
                                        ?>

                                        <ul>
                                            <?php
                                            if($uid != 0) {
                                                if ($obj["uniqueauction"] == "1") {
                                                    $qrybid = "select count(id) from `unique_bid` where auctionid=$aucid and userid=" . $uid . " group by auctionid";
                                                } else {                                                
                                                    $qrybid = "select sum(bid_count) from " . ($obj["use_free"] == 1 ? "free" : "bid") . "_account " . "where bid_flag='d' and auction_id=$aucid and user_id=" . $uid . " group by auction_id";
                                                }
                                            } else {
                                                $mySql = "SELECT * FROM auction_run_status WHERE auctionid=".$obj["auctionID"];
                                                $myQuery = mysql_query($mySql);
                                                $myObj = mysql_fetch_object($myQuery);
                                                
                                                $mySql1 = "SELECT * FROM registration WHERE username='".str_replace(array('["', '"]'), array('', ''), $myObj->heighuser)."'";
                                                $myQuery1 = mysql_query($mySql1);
                                                $myObj1 = mysql_fetch_object($myQuery1);
                                                $uid1 = $myObj1->id;
                                                if ($obj["uniqueauction"] == "1") {
                                                    $qrybid = "select count(id) from `unique_bid` where auctionid=$aucid and userid=" . $uid1 . " group by auctionid";
                                                } else {                                                
                                                    $qrybid = "select sum(bid_count) from " . ($obj["use_free"] == 1 ? "free" : "bid") . "_account " . "where bid_flag='d' and auction_id=$aucid and user_id=" . $uid1 . " group by auction_id";
                                                }
                                                
                                            }
                                            $resbid = mysql_query($qrybid);
                                            $totbid = mysql_num_rows($resbid) > 0 ? mysql_result($resbid, 0) : 0;
                                            mysql_free_result($resbid);
                                            $totbidprice = $totbid * 10;
                                            if ($obj["fixedpriceauction"] == "1") {
                                                $fprice = $obj["auc_fixed_price"];
                                            } elseif ($obj["offauction"] == "1") {
                                                $fprice = "0.00";
                                            } else {
                                                $fprice = $obj["auc_final_price"];
                                            }
                                            $saving_price = $price - $totbidprice - $fprice;
                                            $saving_percent = $price == 0 ? '100' : ($saving_price * 100 / $price);
                                            ?>
                                            <li>
                                                <b><?php echo Retail_Price; ?></b><span>฿<?php echo $price; ?></span>
                                            </li>
                                            <li>
                                                <b><?php echo Used_bids; ?> <?= Value; ?>(<?= ($totbid != "" ? $totbid : "0"); ?>):</b><span><?= $Currency . number_format($totbidprice, 2); ?></span>
                                            </li>
                                            <li>
                                                <b><?php echo Closed_price; ?></b><span><?= $Currency . $fprice; ?></span>
                                            </li>
                                            <li>
                                                <b><?php echo Saving; ?></b><span><?= $Currency . number_format($saving_price, 2); ?></span>
                                            </li>
                                            <li>
                                                <b>You <?= Save; ?></b><span><?= floor($saving_percent) . '%'; ?></span>
                                            </li>
                                        </ul>
                                        <span class="note_green">*<?= Used_bid_value_is_based_on_bid; ?></span>
                                        <div class="buy_new_price <?php echo $bottomClass; ?>">
                                            <div class="left_price">
                                                <?php
                                                    $winner = mysql_fetch_array(mysql_query("select * from `won_auctions` where `auction_id`='" . $obj["auctionID"] . "'"));
                                                    if ($obj['allowbuynow'] == 1) {
                                                        if ($obj["uniqueauction"] == "1") {
                                                            $qrybid = "select count(id) from `unique_bid` where auctionid=$aucid and userid=" . $uid . " group by auctionid";
                                                        } else {
                                                            $qrybid = "select sum(bid_count) from " . ($obj["use_free"] == 1 ? "free" : "bid") . "_account " . "where bid_flag='d' and auction_id=$aucid and user_id=" . $uid . " group by auction_id";
                                                        }
                                                        $resbid = mysql_query($qrybid);
                                                        $totbid = mysql_num_rows($resbid) > 0 ? mysql_result($resbid, 0) : 0;
                                                        mysql_free_result($resbid);
                                                        $totbidprice = $totbid * 10;
                                                        $taxamount = 0;
                                                        if (Sitesetting::isEnableTax() == true) {
                                                            if ($obj->tax1 != 0) {
                                                                $taxamount +=$buynowprice * $obj->tax1 / 100;
                                                            }
                                                            if ($obj->tax2 != 0) {
                                                                $taxamount +=$buynowprice * $obj->tax2 / 100;
                                                            }
                                                        }
                                                        $shippingprice = $obj['shippingcharge'];
                                                        $saving_price_buys = (($buynowprice - $totbidprice) + ($shippingprice + $taxamount));
                                                        echo '<p>' . Buy_Now_Price . '</p>';
                                                        echo '<b>฿' . number_format($saving_price_buys, 2) . '</b>';
                                                    } else {
                                                        echo '<p>'.Buy_Now_is_not_available.'</p>';
                                                    }
                                                    ?>
                                            </div>
                                            <div class="right_price">
                                                <?php
                                                if ($obj['allowbuynow'] == 1) {
                                                    if ($obj['uniqueauction'] == 0) {
                                                        if ($uid == 0) {
                                                ?>
                                                            <a href="login.php"><img alt="" src="images/cart_icon.png"></a>
                                                <?php
                                                        } else {
                                                            $endtime = strtotime('+3 day', strtotime($obj["auc_end_date"]));
                                                            $now = strtotime(date('y-m-d h:i:s'));
                                                            ?>
                                                            <a href="javascript: void(0);" id="buynow_<?= $obj["auctionID"]; ?>" <?php if ($winner['userid'] == $uid) { ?>onclick="javascript:alert('<?php echo TOPBIDDERERRORMESSAGE; ?>')"<?php } if ($endtime < $now && $obj["auc_status"] == '3') { ?>onclick="javascript:alert('<?php echo DATEERRORMESSAGE; ?>')" <?php } else { ?> onClick="window.location.href = '<?php echo SITE_URL; ?>/buyitnow.php?auctionId=<?= $obj["auctionID"]; ?>&uid=<?= $uid; ?>'" <?php } ?>><img alt="" src="images/cart_icon.png"></a>
                                                <?php
                                                        }
                                                    } else {
                                                        if ($uid == 0) {
                                                ?>
                                                            <a href="login.php"><img alt="" src="images/cart_icon.png"></a>
                                                <?php
                                                        } else {

                                                            $endtime = strtotime('+3 day', strtotime($obj["auc_end_date"]));
                                                            $now = strtotime(date('y-m-d h:i:s'));
                                                ?>
                                                            <a href="javascript: void(0);" id="buynow_<?= $obj["auctionID"]; ?>" <?php if ($winner['userid'] == $uid) { ?>onclick="javascript:alert('<?php echo TOPBIDDERERRORMESSAGE; ?>')"<?php } if ($endtime < $now && $obj["auc_status"] == '3') { ?>onclick="javascript:alert('<?php echo DATEERRORMESSAGE; ?>')" <?php } else { ?> onClick="window.location.href = '<?php echo SITE_URL; ?>/buyitnow.php?auctionId=<?= $obj["auctionID"]; ?>&uid=<?= $uid; ?>'" <?php } ?>><img alt="" src="images/cart_icon.png"></a>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
<!--                                                <a href=""><img alt="" src="images/cart_icon.png"></a>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="listing_description">
                                        <h1><?php echo Listing_Description; ?></h1>
                                        <div class="des_list_box">
                                            <?php echo $long_desc; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <span class="usefreebids" id="useonlyfree" style="display: none;"><?= $obj["use_free"]; ?></span>

                    </div>
                    <div class="col-md-3 padding-left-0">
                        <div class="right_bid_box garay_sky_boder">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_history" aria-controls="bid_history" role="tab" data-toggle="tab"><?php echo BID_HISTORY_NEW; ?></a></li>
                                <li role="presentation"><a href="#tab_mybid" aria-controls="my_bids" role="tab" data-toggle="tab"><?php echo MY_BIDS_NEW; ?></a></li> 
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_history" role="tabpanel" style="height: 300px; overflow: hidden; overflow-y: scroll;">
                                    <table class="bid_table">
                                        <tr>
                                            <th><?php echo BID_NEW; ?></th>
                                            <th><?php echo BIDDER_NEW; ?></th>
                                            <th><?php echo TYPE_NEW; ?></th>
                                        </tr>

                                        <?
                                        if ($obj["uniqueauction"] == 0) {
                                            $qryhis = "select bidding_price, username, bidding_type,email from " . ($obj["use_free"] == 1 ? "free" : "bid") . "_account ba " . "left join registration r on ba.user_id=r.id where ba.auction_id=$aucid and ba.bid_flag='d' order by ba.id desc limit 0, 5";
                                        } else {
                                            $qryhis = "select ub.bidprice, r.username,r.email, ub.bidding_type, "
                                                    . "if( "
                                                    . "ub.bidprice > ( SELECT MIN( bidprice ) FROM unique_bid WHERE auctionid = $aucid), 
                                                            if( 
                                                            (SELECT count(*) FROM unique_bid WHERE auctionid = $aucid AND bidprice = ub.bidprice) > 1, 
                                                                'Not Unique',
                                                                if(
                                                                (SELECT MIN(AA.bidprice) FROM (SELECT bidprice, count(bidprice) cnt FROM `unique_bid` WHERE auctionid=$aucid GROUP BY bidprice HAVING cnt=1) AA) = ub.bidprice,
                                                                'Lowest Unique',
                                                                'Unique but too high'
                                                                )
                                                            ), 
                                                            if( 
                                                            (SELECT count(*) FROM unique_bid WHERE auctionid = $aucid AND bidprice = (SELECT MIN( bidprice ) FROM unique_bid WHERE auctionid = $aucid)) > 1, 
                                                            'Not Unique', 
                                                            'Lowest Unique' 
                                                            )
                                                        ) AS type "
                                                    . "from unique_bid ub "
                                                    . "left join registration r "
                                                    . "on ub.userid = r.id "
                                                    . "where ub.auctionid = $aucid "
                                                    . "order by ub.id DESC";

                                            $auc_detailsQ = mysql_query("SELECT auc_status FROM auction WHERE auctionID = $aucid");
                                            $auc_detailsR = mysql_fetch_object($auc_detailsQ);
											$auctionduetable=mysql_fetch_object(mysql_query("select * from `auc_due_table` where `auction_id`='".$aucid."'"));
                                            $check_auc_end = ($auctionduetable->auc_due_time ==0) ? true : false;
                                        }

                                        $reshis = mysql_query($qryhis);

                                        $totalhis = mysql_num_rows($reshis);

                                        $q = 0;

                                        for ($j = 1, $q = 0; $j <= $totalhis; $j++, $q++) {


                                            $objhis = mysql_fetch_object($reshis);
                                            if ($obj["uniqueauction"] == 0) {
                                                ?>

                                                <tr>

                                                    <td id="bid_price_<?= $q; ?>"><?= ($objhis->bidding_price != "" ? $Currency . number_format($objhis->bidding_price, 2) : "&nbsp;"); ?></td>

                                                    <td id="bid_user_name_<?= $q; ?>">

                                                        <?
                                                        if ($objhis->email != "")
                                                            $topbidder=explode('@',$objhis->email);
                                                            echo $topbidder['0'];

                                                        if ($objhis->bidding_price != "" && $objhis->email == "")
                                                            echo USER_REMOVED;
                                                        ?>

                                                    </td>

                                                    <td id="bid_type_<?= $q; ?>">

                                                        <?
                                                        if ($objhis->bidding_type == 's')
                                                            echo SINGLE_BID;

                                                        if ($objhis->bidding_type == 'b')
                                                            echo AUTOBIDDER;

                                                        if ($objhis->bidding_type == 'm')
                                                            echo SMS_BID;
                                                        ?>

                                                    </td>

                                                </tr>

                                                <?
                                            } else {
                                                ?>
                                                <tr>

                                                    <td id="bid_price_<?php echo $q; ?>">
                                                        <?php
                                                        if ($check_auc_end) {
                                                            if ($objhis->type == 'Lowest Unique') {
                                                                echo '<span style="color:green !important;">' . $Currency . $objhis->bidprice . '</span>';
                                                            } else {
                                                                echo '<span>' . $Currency . $objhis->bidprice . '</span>';
                                                            }
                                                        }
                                                        ?>
                                                    </td>

                                                    <td id="bid_user_name_<?php echo $q; ?>">

                                                        <?php
                                                        if ($objhis->username != "")
                                                            if ($check_auc_end) {
                                                                if ($objhis->type == 'Lowest Unique') {
                                                                    $topbidder=explode('@',$objhis->email);
                                                                    echo '<span style="color:green !important;">' .$topbidder['0'] . '</span>';
                                                                } else {
                                                                    $topbidder=explode('@',$objhis->email);
                                                                    echo $topbidder['0'];
                                                                }
                                                            } else {
                                                               $topbidder=explode('@',$objhis->email);
                                                                    echo $topbidder['0'];
                                                            }


                                                        if ($objhis->bidding_price != "" && $objhis->email == "")
                                                            if ($check_auc_end) {
                                                                if ($objhis->type == 'Lowest Unique') {
                                                                    echo '<span style="color:green !important;">' . USER_REMOVED . '</span>';
                                                                } else {
                                                                    echo USER_REMOVED;
                                                                }
                                                            } else {
                                                                echo USER_REMOVED;
                                                            }
                                                        ?>

                                                    </td>

                                                    <td id="bid_type_<?= $q; ?>">
                                                        <?php
                                                        if ($check_auc_end) {
                                                            if ($objhis->type == 'Lowest Unique') {
                                                                echo '<span style="color:green !important;">' . $objhis->type . '</span>';
                                                            } else {
                                                                echo $objhis->type;
                                                            }
                                                        } else {
                                                            echo $objhis->type;
                                                        }
                                                        ?>

                                                    </td>

                                                </tr>
                                                <?php
                                            }
                                        }

                                        mysql_free_result($reshis);
                                        ?>

                                    </table>
                                </div>
                                <div class="tab-pane" id="tab_mybid" role="tabpanel" style="height: 300px; overflow: hidden; overflow-y: scroll;">
                                    <?
                                    if ($uid <> 0) {
                                        //echo "i am here";
                                        ?>

                                        <table class="bid_table">

                                            <thead>

                                                <tr>

                                                    <th><?php echo BID_NEW; ?></th>

                                                    <th><?php echo BIDDER_NEW; ?></th>

                                                    <th><?php echo TYPE_NEW; ?></th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?
                                                if ($obj["uniqueauction"] == 0) {
                                                    $qryhis1 = "select bidding_price, username,email, bidding_type from " . ($obj["use_free"] == 1 ? "free" : "bid") . "_account ba " . "left join registration r on ba.user_id=r.id " . "where ba.auction_id=$aucid and ba.bid_flag='d' and ba.user_id=$uid order by ba.id desc";
                                                } else {
                                                    //$qryhis1 = "select bidprice, username,bidding_type from unique_bid ba " . "left join registration r on ba.userid=r.id " . "where ba.auctionid=$aucid  and ba.userid=$uid order by ba.bidprice asc";
                                                    $qryhis1 = "select ub.bidprice, r.username,r.email, ub.bidding_type, "
                                                            . "if( "
                                                            . "ub.bidprice > ( SELECT MIN( bidprice ) FROM unique_bid WHERE auctionid = $aucid ), 
                                                            if(
                                                            (SELECT count(*) FROM unique_bid WHERE auctionid = $aucid AND bidprice = ub.bidprice) > 1, 
                                                                'Not Unique', 
                                                                if(
                                                                    (SELECT MIN(AA.bidprice) FROM (SELECT bidprice, count(bidprice) cnt FROM `unique_bid` WHERE auctionid=$aucid GROUP BY bidprice HAVING cnt=1) AA) = ub.bidprice,
                                                                    'Lowest Unique',
                                                                    'Unique but too high'
                                                                )
                                                            ), 
                                                            if( 
                                                            (SELECT count(*) FROM unique_bid WHERE auctionid = $aucid AND bidprice = (SELECT MIN( bidprice ) FROM unique_bid WHERE auctionid = $aucid )) > 1, 
                                                                'Not Unique', 
                                                                'Lowest Unique' 
                                                            )
                                                            ) AS type "
                                                            . "from unique_bid ub "
                                                            . "left join registration r "
                                                            . "on ub.userid = r.id "
                                                            . "where ub.auctionid = $aucid "
                                                            . "AND ub.userid = $uid "
                                                            . "order by ub.id DESC";
                                                }
                                                $reshis1 = mysql_query($qryhis1);

                                                $totalhisl = mysql_num_rows($reshis1);

                                                for ($k = 1, $r = 0; $k <= $totalhisl; $k++, $r++) {

                                                    $objhis1 = mysql_fetch_object($reshis1);
                                                    if ($obj["uniqueauction"] == 0) {
                                                        ?>

                                                        <tr>

                                                            <td id="my_bid_price_<?= $r; ?>"><?= ($objhis1->bidding_price != "" ? $Currency . number_format($objhis1->bidding_price, 2) : "&nbsp;"); ?></td>

                                                            <td id="my_bid_time_<?= $r; ?>">

                                                                <?

                                                                if ($objhis1->email != "")
                                                                    $topbidder=explode('@',$objhis1->email);
                                                                    echo $topbidder['0'];

                                                                if ($objhis1->bidding_price != "" && $objhis1->email == "")
                                                                    echo USER_REMOVED;
                                                                ?>

                                                            </td>

                                                            <td id="my_bid_type_<?= $r;
                                                                ?>">

                                                                <?
                                                                if ($objhis1->bidding_type == 's')
                                                                    echo SINGLE_BID;

                                                                if ($objhis1->bidding_type == 'b')
                                                                    echo AUTOBIDDER;

                                                                if ($objhis1->bidding_type == 'm')
                                                                    echo SMS_BID;
                                                                ?>

                                                            </td>

                                                        </tr>

                                                        <?
                                                    }
                                                    else {
                                                        ?>

                                                        <tr>

                                                            <td id="my_bid_price_<?= $r; ?>"><?= ($objhis1->bidprice != "" ? $Currency . number_format($objhis1->bidprice, 2) : "&nbsp;"); ?></td>

                                                            <td id="my_bid_time_<?= $r; ?>">

                                                                <?php
                                                                if ($objhis1->email != "")
                                                                    $topbidder=explode('@',$objhis1->email);
                                                                    echo $topbidder['0'];

                                                                if ($objhis1->bidprice != "" && $objhis1->email == "")
                                                                    echo USER_REMOVED;
                                                                ?>

                                                            </td>

                                                            <td id="my_bid_type_<?php echo $r; ?>">

                                                                <?php
                                                                echo $objhis1->type;
                                                                ?>

                                                            </td>

                                                        </tr>
                                                        <?php
                                                    }
                                                }

                                                mysql_free_result($reshis1);
                                                ?>

                                            </tbody>

                                        </table>

                                    <?php } ?>
                                </div>
                            </div>

                        </div>

                        <?php
                        if ($uid != 0) {
                            if ($obj["auc_status"] == 2 || $obj["auc_status"] == 1 ) {
                                ?>

                                <div class="right_bid_box garay_sky_boder">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#bookautobidder" aria-controls="bookautobidder" role="tab" data-toggle="tab"><?php echo BOOK_AUTOBIDDER_NEW; ?></a>
                                        </li>
                                        <? if ($obj["nailbiterauction"] == 0) { ?>
                                            <li role="presentation">
                                                <a href="#myautobidder" aria-controls="myautobidder" role="tab" data-toggle="tab"><?php echo MY_AUTOBIDDER_NEW; ?></a>
                                            </li>
                                        <? } ?>
                                    </ul>
                                    <div class="tab-content">

                                        <div id="bookautobidder" class="tab-pane active">
                                            <form name="bidbutler"  method="post">

                                                <table class="bid_table">

                                                    <thead>

                                                        <tr>

                                                            <th><?php echo BID_FROM_NEW; ?></th>

                                                            <th><?php echo BID_TO_NEW; ?></th>

                                                            <th><?php echo BIDS_NEW; ?></th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <? if ($obj["nailbiterauction"] == 0) { ?>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                if ($obj["uniqueauction"] == 0) {
                                                                    $myToolTip = Autobidder_Set_in_thai_baht_items_floor_price_Bid_from_ceiling_price_Bid_to_within;
                                                                } else {
                                                                    $myToolTip = Autobidder_range_of_bids_Set_in_thai_Baht_your_minimum_bid_Bid_From_and_your_maximum_bid;
                                                                }
                                                                
                                                                ?>
                                                                <div class="bid_box_small" data-toggle="tooltip" data-placement="top" title="<?= $myToolTip; ?>">
                                                                    <img src="images/arror_right.png" alt="" />
                                                                    <input type="text" name="bidbutstartprice" value="" id="bid_form" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="bid_box_small" >
                                                                    <img src="images/arror_right.png" alt="" />
                                                                    <input type="text" name="bidbutendprice" value="" id="bid_to" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="bid_box_small" data-toggle="tooltip" data-placement="top" title="<?= Set_the_maximum_number_of_bids_that_you_are_willing_to_place_for_this_auction; ?>">
                                                                    
                                                                    <input type="text" name="totalbids" value="" id="bid_bids" style="padding-left: 0;" />
                                                                    <input type="hidden" name="isreverseauction" id="isreverseauction" value="<?php echo $obj['reverseauction']; ?>" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                            

                                                        <? } else {
                                                            ?>

                                                            <tr>

                                                                <td colspan="3" align="center"><?php echo THIS_AUCTION_IS_NAILBITER_AUCTION; ?><br /><?php echo YOU_CANT_PLACE_AUTOBIDDER; ?></td>

                                                            </tr>

                                                        <? } ?>

                                                    </tbody>

                                                </table>

                                                <p class="book_now">

                                                    <!--                                        <a id="bookbidbutlerbutton1" name="<?= $aucid; ?>" title="Book" class="btn btn-primary bid-button-link" onclick="return addautobid()" href="javascript:void(0);"  style="float:right;"><?php echo BOOK_NEW; ?></a>-->
                                                    <button id="bookbidbutlerbutton1" name="<?= $aucid; ?>" title="Book" class="bid_box_button" onClick="return addautobid()" type="button"><?php echo BOOK_NEW; ?></button>

                                                    <span id="butlermessage" style="display: none;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo AUTOBIDDER_ADDED; ?></strong></span>

                                                </p>

                                            </form>
                                        </div>

                                        <div id="myautobidder" class="tab-pane">

                                            <?php if ($obj["nailbiterauction"] == 0) { ?>

                                                <table class="bid_table">

                                                    <thead>

                                                        <tr>

                                                            <th><?php echo BID_FROM_NEW; ?></th>

                                                            <th><?php echo BID_TO_NEW; ?></th>

                                                            <th><?php echo BIDS_NEW; ?></th>

                                                            <th></th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <?
                                                        $qrbutler = "select butler_start_price, butler_end_price, butler_bid,used_bids, id from bidbutler " . "where auc_id=$aucid and user_id=$uid and butler_status=0 order by id desc";

                                                        $rsbutler = mysql_query($qrbutler);

                                                        $totalbutler = mysql_num_rows($rsbutler);

                                                        if ($totalbutler > 0) {

                                                            for ($i = 1, $q = 1; $i <= 20; $i++, $q++) {

                                                                $objbutler = mysql_fetch_object($rsbutler);

                                                                $bids = $objbutler->butler_bid - $objbutler->used_bids;
                                                                ?>

                                                                <tr id="mainbutlerbody_<?= $i; ?>" <?= ($i > $totalbutler ? "style=\"display: none;\"" : ""); ?>>

                                                                    <td id="butlerstartprice_<?= $q; ?>"><?= ($objbutler->butler_start_price != "" ? $Currency . number_format($objbutler->butler_start_price, 2) : ""); ?></td>

                                                                    <td id="butlerendprice_<?= $q ?>"><?= ($objbutler->butler_end_price != "" ? $Currency . number_format($objbutler->butler_end_price, 2) : ""); ?></td>

                                                                    <td id="butlerbids_<?= $q; ?>"><?= $bids; ?></td>

                                                                    <td align="center">

                                                                        <? if ($objbutler->butler_start_price != "") {
                                                                            ?>

                                                                            <span id="deletebidbutler_<?= $q; ?>">

                                                                                <img src="img/buttons/btn_closezoom.png" style="cursor: pointer;" onClick="DeleteBidButler('<?= $objbutler->id ?>', '<?= $q ?>');" id="butler_image_<?= $q; ?>" />

                                                                            </span>

                                                                        <? } else {
                                                                            ?>

                                                                            <span id="deletebidbutler_<?= $q; ?>" style="display: none;"><img src="img/buttons/btn_closezoom.png" style="cursor: pointer;" onClick="DeleteBidButler('<?= $objbutler->id ?>', '<?= $q ?>');" id="butler_image_<?= $q; ?>"  />

                                                                            </span>

                                                                        <? } ?>

                                                                    </td>

                                                                </tr>

                                                            <? } ?>

                                                            <tr style="display:none;" id="live_no_bidbutler">

                                                                <td colspan="4"><strong><?php echo NO_ACTIVE_AUTOBIDDERS; ?></strong></td>

                                                            </tr>

                                                            <?
                                                        } else {

                                                            for ($i = 1; $i <= 20; $i++) {
                                                                ?>

                                                                <tr id="mainbutlerbody_<?= $i;
                                                                ?>" <?= ($i > 3 ? "style=\"display: none;\"" : ""); ?>>

                                                                    <td id="butlerstartprice_<?= $i; ?>"></td>

                                                                    <td id="butlerendprice_<?= $i ?>"></td>

                                                                    <td id="butlerbids_<?= $i;
                                                                ?>"></td>

                                                                    <td><span id="deletebidbutler_<?= $i;
                                                                ?>" style="display: none;"><img src="images/btn_closezoom.png" style="cursor: pointer;" onClick="" id="butler_image_<?= $i;
                                                                ?>" /></span></td>

                                                                </tr>

                                                            <? } ?><!--end for-->

                                                            <tr style="display:table-row;" id="live_no_bidbutler">

                                                                <td colspan="4"><strong><?php echo NO_ACTIVE_AUTOBIDDERS; ?></strong></td>

                                                            </tr>

                                                            <?
                                                        }

                                                        mysql_free_result($rsbutler);
                                                        ?>

                                                    </tbody>

                                                </table>

                                            <? } ?>

                                        </div>
                                    </div>




                                                <!--                            <table class="bid_table">
                                                    <tr>
                                                        <th>Bid From</th>
                                                        <th>Bid To</th>
                                                        <th>Bids</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="bid_box_small">
                                                                <img src="images/arror_right.png" alt="" />
                                                                <input type="text" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="bid_box_small">
                                                                <img src="images/arror_right.png" alt="" />
                                                                <input type="text" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="bid_box_small">
                                                                <img src="images/arror_right.png" alt="" />
                                                                <input type="text" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>-->

                                </div>
                                <?php
                            }
                        }
                        ?>
                        <br/>
                        <?php
                        $qrysel = "select * from bidpack where 1 order by bid_size";
                        $ressel = mysql_query($qrysel);
                        $totalrow = mysql_affected_rows();

                        if ($totalrow > 0) {
                            ?>
                            <div class="right_bid_box orange_boder">
                                <div class="right_head">
                                    <h3><img src="images/cash.png" alt="" /><span><?php echo BUY_BIDS_CAP; ?></span></h3>
                                </div>
                                <table class="bid_table">
                                    <tr>
                                        <th><?php echo Bids; ?></th>
                                        <th><?php echo Price; ?></th>
                                        <th><?php echo Saving; ?></th>
                                    </tr>
                                    <?php
                                    while ($row = mysql_fetch_array($ressel)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['bid_size']; ?> <?php echo Bids; ?></td>
                                            <td>฿<?php echo round($row['bid_price']); ?></td>
                                            <td><?php echo round($row['bidpackpricesavepercentage']); ?>%</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                                <?php
                                if (!isset($_SESSION["userid"])) {
                                    $uid = 0;
                                } else {
                                    $uid = $_SESSION["userid"];
                                }
                                if ($uid == 0) {
                                    ?>
                                    <button type="button" onClick="window.location.href = 'login.php'"><?php echo BUY_BIDS_CAP; ?></button>
                                    <?php
                                } else {
                                    ?>
                                    <button type="button" onClick="window.location.href = 'buybids.php'"><?php echo BUY_BIDS_CAP; ?></button>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once 'footer.php'; ?>

        <div id="bidder_count" style="display:none;">1</div>

        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
        <script>
            var _$ = jQuery.noConflict();
        </script>
        <script src="js/bootstrap.js"></script>

        <script src="js/jquery.bxslider.js"></script>
<!--        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>-->
        <script>
            _$(document).ready(function () {
                _$('.bxslider').bxSlider({
                    auto: true,
                    autoControls: true,
                    pager: false
                });
                _$('.bxslider2').bxSlider({
                    minSlides: 1,
                    maxSlides: 2,
                    slideWidth: 70,
                    slideMargin: 10,
                    pager: false,
                    onSliderLoad: function(){
                        $(".bxslider2").css("visibility", "visible");
                    }
                });
                
                _$('.bxslider2 li img').click(function() {
                    var bxSelf = _$(this);
                    _$('.product_box img').attr('src', bxSelf.attr('src'));
                });
                
//                _$("#tab_history, #tab_mybid").mCustomScrollbar({
//                    setHeight: 300,
//                    scrollButtons:{enable:true,scrollType:"stepped"},
//                    keyboard:{scrollType:"stepped"},
//                    mouseWheel:{scrollAmount:188,normalizeDelta:true},
//                    theme:"rounded-dark",
//                    autoExpandScrollbar:true,
//                    snapAmount:188,
//                    snapOffset:65
//                });
                
            });
            
            
         
        </script>

        <script>
            
            <?php
            if ($obj['uniqueauction'] == 0 && $obj['auc_status'] != 3) {
                ?>
            setInterval(function () {
                callautobidderupdate(<?php echo $_GET['aid']; ?>,<?php echo $uid; ?>);
            }, 3000);
                <?php
            } else if($obj['uniqueauction'] == 1 && $obj['auc_status'] != 3) {
                ?>
                     setInterval(function () {
                callautobidderupdate1(<?php echo $_GET['aid']; ?>,<?php echo $uid; ?>);
            }, 3000);
                    <?php
            }
            ?>

            function callautobidderupdate(aucid, username) {
                $.ajax({
                    url: 'getbidhistrydetails_newdetails.php?aid=' + aucid + '&uid=' + username,
                    success: function (data) {
                        data1 = data.split("|");
                        var neverDeclared = $('#tab_history').html();
                        var neverDeclared1 = $('#tab_mybid').html();
                        if (typeof neverDeclared == "undefined") {

                        } else {
                            $('#tab_history').html('');
                            $('#tab_history').html(data1['0']);
                        }
                        if (typeof neverDeclared1 == "undefined") {
                        } else {
                            $('#tab_mybid').html('');
                            $('#tab_mybid').html(data1['1']);
                        }
                    }
                });
            }
            
              function callautobidderupdate1(aucid, username) {
                $.ajax({
                    url:'getbidhistrydetailsunique1.php?aid=' + aucid + '&uid=' + username,
                    success: function (data) {
                        data1 = data.split("|");
                        var neverDeclared = $('#tab_history').html();
                        var neverDeclared1 = $('#tab_mybid').html();
                        if (typeof neverDeclared == "undefined") {

                        } else {
                            $('#tab_history').html('');
                            $('#tab_history').html(data1['0']);
                        }
                        if (typeof neverDeclared1 == "undefined") {
                        } else {
                            $('#tab_mybid').html('');
                            $('#tab_mybid').html(data1['1']);
                        }
                    }
                });
            }
        </script>
     <script>
		_$(document).ready(function(){
		    _$('[data-toggle="tooltip"]').tooltip();
		});
		</script>
        
    </body>
</html>