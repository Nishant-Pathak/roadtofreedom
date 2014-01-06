<?php
include_once("../includes/header.php");
include_once("../includes/navbar.php");
?>
<!-- Begin page content -->
<style>
    body {
        background: url('../images/library.png') no-repeat ;
    }
</style>
<?php
$user_id = $_SESSION['user_id'];

$most_recent = "select * from articles where article_type='temple' order by date_uploaded DESC limit 5 ";
$most_popular = "select * from articles where article_type='temple' order by upvotes DESC limit 5 ";

$result_recent = mysqli_query($mysqli, $most_recent);
$result_popular = mysqli_query($mysqli, $most_popular);

$most_recent_array = array();
$most_popular_array = array();

if($result_recent == false) {
    error_log("[Logging] Mysql query returned false. [Query] ". $most_recent);
    //change it to some problem page
    header('Location: ../index.php');
    exit();
}
if($result_popular == false) {
    error_log("[Logging] Mysql query returned false. [Query] ". $most_popular);
    //change it someproblem page
    header('Location: ../index.php');
    exit();
}

while ($row = mysqli_fetch_array($result_recent)) {
    array_push($most_recent_array, array($row['article_name'], $row['article_path'], $row['image_path'],$row['article_id']));
}
while ($row = mysqli_fetch_array($result_popular)) {
    array_push($most_popular_array, array($row['article_name'], $row['article_path'], $row['image_path'],$row['article_id']));
}
?>

<img id="transparentImage" src="../images/transparentImage.png" usemap="#transparentImageMap" style="position:relative;"/>
<map name="transparentImageMap">
    <area onfocus="blur();" shape="poly" Coords="799, 586, 768, 612, 788, 645, 770, 656, 742, 694, 847, 703, 811, 679, 816, 660, 807, 644, 831, 613, 801, 588" href="#sidePanel"/>  
</map>

<div class="navigation" id="nav">
    <div class="item home_nav">
        <img src="../images/bg_home.png" alt="" width="199" height="199" class="circle"/>
        <a href="#" class="icon"></a>
        <ul>
            <?php if ($username != 'notLogin') { ?>
            <li><a href="../arena/">Arena</a></li>
            <li><a href="../library/">Library</a></li>
            <li><a href="../temple/">Temple</a></li>
            <li><a href="../theatre/">Theater</a></li>
            <?php } else { ?>
            <li><a href="#signIn_modal" data-toggle="modal">SignIn</a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="item articles_nav">
        <img src="../images/bg_home_green.png" alt="" width="199" height="199" class="circle"/>
        <a href="#" class="icon"></a>
        <ul>
            <li><a href="#sidePanel">Articles</a></li>
        </ul>
    </div>
</div>

<!--
<div id="sidePanelLabel" >
    <a onclick="showPanelAndHideLabel();"><img src='../images/sliderArticles.png' style="width:100%;height: 100%"></a>
</div>
-->

<div id="sidePanel" class="panel-articles panel-margin">
    <div class=" container-panel">  
        <div class="close-div">
            <button type="button" class="close" onclick="hidePanelAndShowLabel();">&times;</button>
        </div> 
        <div class="search-div" >
            <input type="text" class="form-control" style="width:100%;" placeholder="Search"/>
        </div> 
        <div class="well">

            <a onclick="show_article('<?php echo $most_popular_array[0][0]; ?>', '<?php echo $most_popular_array[0][1]; ?>', '<?php echo $most_popular_array[0][2]; ?>','<?php echo $most_popular_array[0][3]; ?>','<?php echo $user_id; ?>');">
                <div class="postcardleft">
                    <div class="postcardleftimage">
                        <img src="<?php echo $most_popular_array[0][2]; ?>" style="width:100%;height:100%;"/>
                    </div>
                    <pre class="postcard_heading"><?php echo $most_popular_array[0][0]; ?></pre>
                </div>
            </a>   


            <div class="post-card-container" >
                <a onclick="show_article('<?php echo $most_popular_array[1][0]; ?>', '<?php echo $most_popular_array[1][1]; ?>', '<?php echo $most_popular_array[1][2]; ?>','<?php echo $most_popular_array[1][3]; ?>','<?php echo $user_id; ?>');">
                    <div class="postcard0">
                        <div class="postcard0image">
                            <img src="<?php echo $most_popular_array[1][2]; ?>" style="width:100%;height:100%;"/>                       
                        </div>
                        <pre class="postcard_heading"><?php echo $most_popular_array[1][0]; ?></pre>
                    </div>
                </a>
                <a onclick="show_article('<?php echo $most_popular_array[2][0]; ?>', '<?php echo $most_popular_array[2][1]; ?>', '<?php echo $most_popular_array[2][2]; ?>','<?php echo $most_popular_array[2][3]; ?>','<?php echo $user_id; ?>');">
                    <div class="postcard1">
                        <div class="postcard1image">
                            <img src="<?php echo $most_popular_array[2][2]; ?>" style="width:100%;height:100%;"/>
                        </div>                   
                        <pre class="postcard_heading"><?php echo $most_popular_array[2][0]; ?></pre>
                    </div>
                </a>

                <a onclick="show_article('<?php echo $most_popular_array[3][0]; ?>', '<?php echo $most_popular_array[3][1]; ?>', '<?php echo $most_popular_array[3][2]; ?>','<?php echo $most_popular_array[3][3]; ?>','<?php echo $user_id; ?>');">
                    <div class="postcard3">
                        <div class="postcard3image">
                            <img src="<?php echo $most_popular_array[3][2]; ?>" style="width:100%;height:100%;"/>
                        </div>                  
                        <pre class="postcard_heading"><?php echo $most_popular_array[3][0]; ?></pre>
                    </div>
                </a>
            </div>
            <a onclick="show_article('<?php echo $most_popular_array[4][0]; ?>', '<?php echo $most_popular_array[4][1]; ?>', '<?php echo $most_popular_array[4][2]; ?>','<?php echo $most_popular_array[4][3]; ?>','<?php echo $user_id; ?>');">
                <div class="postcardright">
                    <div class="postcardrightimage">
                        <img src="<?php echo $most_popular_array[4][2]; ?>" style="width:100%;height:100%;"/>
                    </div>
                    <pre class="postcard_heading"><?php echo $most_popular_array[4][0]; ?></pre>
                </div>
            </a>
        </div> 
        <div class="selection-div" >
            <div class="panel-group" id="accordion">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">                           
                            <a data-toggle="collapse" data-parent="#accordion" onclick="collapseDiv('One');">
                                <b> Most Recent </b>
                            </a>
                        </h4>
                    </div>
                    <div id="One" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?php
                            $i = 1;
                            foreach ($most_recent_array as $key) {
                                ?>
                                <a onclick="show_article('<?php echo $key[0]; ?>', '<?php echo $key[1]; ?>', '<?php echo $key[2]; ?>','<?php echo $key[3]; ?>','<?php echo $user_id; ?>');">
                                    <b><?php echo $i . ". " . $key[0]; ?></b>
                                </a>
                                <br/>
                                <?php
                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" onclick="collapseDiv('Two');">
                                <b>Most Popular</b>
                            </a>
                        </h4>
                    </div>
                    <div id="Two" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php
                            $i = 1;
                            foreach ($most_popular_array as $key) {
                                ?>
                                <a onclick="show_article('<?php echo $key[0]; ?>', '<?php echo $key[1]; ?>', '<?php echo $key[2]; ?>','<?php echo $key[3]; ?>','<?php echo $user_id; ?>');">
                                    <b><?php echo $i . ". " . $key[0]; ?></b>
                                </a>
                                <br/>
                                <?php
                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <br/>
            </div>
        </div> 
    </div>
</div>


<script>
    $(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange',removeScrollBarOnNonFullScreen);

function removeScrollBarOnNonFullScreen() {
    var element = document.getElementById("article_content");
    if (!document.fullscreenElement && // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
        element.style.overflowY='hidden';    
        $('#fScreenImage').attr("src","../images/fullScreen.png")
    }
}

function toggleFullScreen() {
    var element = document.getElementById("article_content");
    if (!document.fullscreenElement && // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) { // current working methods
        element.style.overflowY='scroll';
        $('#fScreenImage').attr("src","../images/exitFullScreen.png")
        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.msRequestFullscreen) {
            element.msRequestFullscreen();
        } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) {
            element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        element.style.overflowY='hidden';
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
}

     var resizeEnd;
    $(window).bind('resize', function(e) {
        clearTimeout(resizeEnd);
        var wh = $(window).width();
        var ht = $(window).height();
        resizeEnd = setTimeout(function() {
          resizeSlidePanel(wh,ht);
          resizeAndPositionTransparentImage(wh, ht);
            $('img[usemap]').rwdImageMaps();
        }, 100);
    });

    $(document).ready(function() {
        var wh = $(window).width();
        var ht = $(window).height();
        resizeSlidePanel(wh,ht);
        resizeAndPositionTransparentImage(wh, ht);
        $('img[usemap]').rwdImageMaps();
    });
    
    function show_article(name, path, image,articleid,userid) {
        $('html, body').css("cursor", "wait");
        $('a:hover').css("cursor","wait");
        $.post("../includes/get_article_content.php",
                {
                    article_path: path,
                    article_image: image,
                    article_type: "temple",
                    article_id: articleid,
                    user_id: userid
                },
        function(data, status) {
            $('html, body').css("cursor", "default");
            $('a:hover').css("cursor","pointer");
            if (status === "success") {
                var myData = jQuery.parseJSON(data);
                if(myData.status === "success") {
                    var isArticleUpvotedByUser = myData.isArticleUpvoted; 
                    var likeOrDislike = "Like";
                    var src="../images/noLike.png";
                    if(isArticleUpvotedByUser === "YES") {
                        likeOrDislike = "UnLike";
                        src = "../images/thumbsUp.png";
                    }                
                    $(".well").empty();
                    $(".well").append('<div id="article_content">');
                    $("#article_content").append('<div id="fScreen" style="float:right;">');
                    $("#fScreen").append('<a onclick="toggleFullScreen();">' + '<img id="fScreenImage" src="../images/fullScreen.png" />' +  '</a>');
                    $("#article_content").append('<div id="likeDislikeDiv"></div>');
                    $("#likeDislikeDiv").append('<img id="thumbsUpImage" data-toggle="tooltip" title="first tooltip" src=' + src + ' />');
                    $("#likeDislikeDiv").append('<br>');
                    $("#likeDislikeDiv").append('<a id="likeOrDislike" onclick="upvoteArticle(' + articleid + ',' + userid + ');">' + likeOrDislike + '</a>');
                    
                    $("#article_content").append('<div id="article_heading">' + name + '</div>');
                    $("#article_content").append('<pre>' + myData.content + '</pre>');
                    $(".well").append('</div>');
                } else {
                    $(".well").empty();
                    $(".well").append('<div id="article_content">');
                    $("#article_content").append('<pre>' + "There seems to be some problem with this article. The incident is reported and we are working on it. Please try after some time." + '</pre>');
                    $(".well").append('</div>');
                }
            } else {
                //take to the problem page
            }
        });
    }
  
    var globalLockForUpvoting = false;
    function upvoteArticle(article_id,user_id) {
        if (globalLockForUpvoting === false) {
            globalLockForUpvoting = true;
            var likeOrDislike = $('#likeOrDislike').text();
            if(likeOrDislike === "UnLike") {
                $('#thumbsUpImage').attr("src","../images/noLike.png")
                $('#likeOrDislike').text("Like");
            } else {
                $('#likeOrDislike').text("UnLike");
                $("#thumbsUpImage").attr("src","../images/thumbsUp.png");
            }
            $.post("../includes/upvote_article.php",
                {
                    userid: user_id,
                    articleid: article_id
                },
            function(data, status) {
                globalLockForUpvoting = false;
                if (status === "success") {
                    var myData = jQuery.parseJSON(data);
                    if(myData.status === "error") {
                        if(likeOrDislike === "UnLike") {
                            $('#likeOrDislike').text("UnLike");
                            $("#thumbsUpImage").attr("src","../images/thumbsUp.png");
                        } else {
                            $('#thumbsUpImage').attr("src","../images/noLike.png")
                            $('#likeOrDislike').text("Like");
                        } 
                    } 
                } else {
                //take it to error page
                }
            });
        }
    }
    
       //javascript for menu bubbles
    $(function() {
        $('#nav > div').hover(
        function () {
            var $this = $(this);
            $this.find('img').stop().animate({
                'width'     :'199px',
                'height'    :'199px',
                'top'       :'-25px',
                'left'      :'-25px',
                'opacity'   :'1.0'
            },500,'easeOutBack',function(){
                $(this).parent().find('ul').fadeIn(700);
            });

            $this.find('a:first,h2').addClass('active');
        },
        function () {
            var $this = $(this);
            $this.find('ul').fadeOut(500);
            $this.find('img').stop().animate({
                'width'     :'52px',
                'height'    :'52px',
                'top'       :'0px',
                'left'      :'0px',
                'opacity'   :'0.1'
            },5000,'easeOutBack');

            $this.find('a:first,h2').removeClass('active');
        }
        );
    });
</script>

<?php
include_once("../includes/footer.php");
?>
