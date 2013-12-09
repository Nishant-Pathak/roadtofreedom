<?php
include_once("../includes/header.php");
include_once("../includes/navbar.php");
?>
<!-- Begin page content -->
<style>
    body {
        background: url('../images/temple.png') no-repeat center center fixed;
    }

</style>
<?php
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
    array_push($most_recent_array, array($row['article_name'], $row['article_path'], $row['image_path']));
}
while ($row = mysqli_fetch_array($result_popular)) {
    array_push($most_popular_array, array($row['article_name'], $row['article_path'], $row['image_path']));
}
?>
<a href="#articles"><div id="temple_book" >
    </div></a>

<div id="articles" class="panel-articles panel-margin">
    <div class=" container-temple">  
        <div class="close-div">
            <button type="button" class="close" onclick="location.href = '#home'">&times;</button>
        </div> 
        <div class="search-div" >
            <input type="text" class="form-control" style="width:100%;" placeholder="Search"/>
        </div> 
        <div class="well">

            <a onclick="show_article('<?php echo $most_popular_array[0][0]; ?>', '<?php echo $most_popular_array[0][1]; ?>', '<?php echo $most_popular_array[0][2]; ?>');">
                <div class="postcardleft">
                    <div class="postcardleftimage">
                        <img src="<?php echo $most_popular_array[0][2]; ?>" style="width:100%;height:100%;"/>
                    </div>
                    <pre class="postcard_heading"><?php echo $most_popular_array[0][0]; ?></pre>
                </div>
            </a>   


            <div class="post-card-container" >
                <a onclick="show_article('<?php echo $most_popular_array[1][0]; ?>', '<?php echo $most_popular_array[1][1]; ?>', '<?php echo $most_popular_array[1][2]; ?>');">
                    <div class="postcard0">
                        <div class="postcard0image">
                            <img src="<?php echo $most_popular_array[1][2]; ?>" style="width:100%;height:100%;"/>                       
                        </div>
                        <pre class="postcard_heading"><?php echo $most_popular_array[1][0]; ?></pre>
                    </div>
                </a>
                <a onclick="show_article('<?php echo $most_popular_array[2][0]; ?>', '<?php echo $most_popular_array[2][1]; ?>', '<?php echo $most_popular_array[2][2]; ?>');">
                    <div class="postcard1">
                        <div class="postcard1image">
                            <img src="<?php echo $most_popular_array[2][2]; ?>" style="width:100%;height:100%;"/>
                        </div>                   
                        <pre class="postcard_heading"><?php echo $most_popular_array[2][0]; ?></pre>
                    </div>
                </a>

                <a onclick="show_article('<?php echo $most_popular_array[3][0]; ?>', '<?php echo $most_popular_array[3][1]; ?>', '<?php echo $most_popular_array[3][2]; ?>');">
                    <div class="postcard3">
                        <div class="postcard3image">
                            <img src="<?php echo $most_popular_array[3][2]; ?>" style="width:100%;height:100%;"/>
                        </div>                  
                        <pre class="postcard_heading"><?php echo $most_popular_array[3][0]; ?></pre>
                    </div>
                </a>
            </div>
            <a onclick="show_article('<?php echo $most_popular_array[4][0]; ?>', '<?php echo $most_popular_array[4][1]; ?>', '<?php echo $most_popular_array[4][2]; ?>');">
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
                                <a onclick="show_article('<?php echo $key[0]; ?>', '<?php echo $key[1]; ?>', '<?php echo $key[2]; ?>');">
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
                                <a onclick="show_article('<?php echo $key[0]; ?>', '<?php echo $key[1]; ?>', '<?php echo $key[2]; ?>');">
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

    function show_article(name, path, image) {
        console.log(name);
        $.post("../includes/get_article_content.php",
                {
                    article_path: path,
                    article_image: image,
                    article_type: "temple"
                },
        function(data, status) {
            if (status === "success") {
                $(".well").empty();
                $(".well").append('<div id="article_content">');
                $("#article_content").append('<div id="article_heading">' + name + '</div>');
                $("#article_content").append('<pre>' + data + '</pre>');
                $(".well").append('</div>');
            } else {

            }
        });
    }
    
    var resizeEnd;
    $(window).bind('resize', function(e) {
        clearTimeout(resizeEnd);
        var wh = $(window).width();
        var ht = $(window).height();
        resizeEnd = setTimeout(function() {
            resizeAndPosition(wh, ht);
        }, 200);
    });
    $(document).ready(function() {
        var wh = $(window).width();
        var ht = $(window).height();
        resizeAndPosition(wh, ht);
        $(".flex").flex();
    });
</script>
<?php
include_once("../includes/footer.php");
?>