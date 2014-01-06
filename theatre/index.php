<?php
include_once("../includes/header.php");
include_once("../includes/navbar.php");
include_once("../google-api-php-client/src/Google_Client.php");
include_once("../google-api-php-client/src/Google_Client.php");
include_once("../google-api-php-client/src/contrib/Google_YouTubeService.php");


$API_KEY = "AIzaSyB2csnwuzifKTQj9acc3jiK0Edro177acw";
$client = new Google_Client();
$client->setDeveloperKey($API_KEY);
$youtube = new Google_YoutubeService($client);
  try {
    // grap channel resource from channel id
    $channelResponse = $youtube->channels->listChannels('contentDetails', array(
        'id' => 'UCNJcSUSzUeFm8W9P7UUlSeQ'
    ));
    $channelItems     = $channelResponse['items'][0];
    $contentDetails   = $channelItems['contentDetails'];
    $relatedPlaylists = $contentDetails['relatedPlaylists'];
    $uploads          = $relatedPlaylists['uploads'];
    $likes            = $relatedPlaylists['likes'];	
	
    $PlayListItems = $youtube->playlistItems->listPlaylistItems('contentDetails,snippet', array(
      'playlistId' => $uploads,'maxResults' =>50
    ));

  } catch (Google_ServiceException $e) {
    error_log('[Theatre] : <p>A service error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    error_log('[Theatre] : <p>An client error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
  }
?>
<!-- Begin page content -->
<style>
    body {
        background: url('../images/theatre.png') no-repeat ;
    }
</style>

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
    <div class="item videos_nav">
        <img src="../images/bg_home_green.png" alt="" width="199" height="199" class="circle"/>
        <a href="#" class="icon"></a>
        <ul>
            <li><a href="#sidePanel">Videos</a></li>
        </ul>
    </div>
</div>

<div id="sidePanel" class="panel-articles panel-margin">
    <div class=" container-panel">  
        <div class="close-div">
            <button type="button" class="close" onclick="hidePanelAndShowLabel();">&times;</button>
        </div> 
        <div class="search-div" >
            <input type="text" class="form-control" style="width:100%;" placeholder="Search"/>
        </div> 
        <div class="well">
            <?php 
                $videoItemList = "";
                $currentVId = isset($_GET["vId"]) ? $_GET["vId"] : "iamhIpas210";
            ?>
            <div id="article_heading"> Road to Freedom Official Channel</div>
            <br/>
            <div style="text-align: center;">
            <embed
            accesskey="" width="500" height="350"
            class="" src="http://www.youtube.com/v/<?php echo $currentVId; ?>"
            contenteditable="" type="application/x-shockwave-flash"  allowfullscreen="true" >
            </embed>
            </div>
        </div> 
        <div class="selection-div" >
            <div class="panel-group" id="accordion">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">                           
                            <a data-toggle="collapse" data-parent="#accordion" onclick="collapseDiv('One');">
                                <b>Videos</b>
                            </a>
                        </h4>
                    </div>
                    <div id="One" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?php
                             $i =0;      
                             if(isset($PlayListItems)) {
                             foreach ($PlayListItems['items'] as $searchResult) {
                                if ($i++ === 10) { break; }
                                 $vName = $searchResult['snippet']['title'];   
                                 $vId = $searchResult['contentDetails']['videoId'];
                            ?>
                                <a href="?vId=<?php echo $vId; ?>#sidePanel">
                                    <b><?php echo $i . ". " . $vName; ?></b>
                                </a>
                                <br/>
                            <?php
                            }
                             }
                            ?>
                        </div>
                    </div>
                </div>
                <br/>

            </div>
        </div>
        <br/>
    </div>
</div> 
<script>
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


