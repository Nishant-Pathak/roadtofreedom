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

<a href="#articles"><div id="temple_book" >
</div></a>

<div id="articles" class="panel-articles panel-margin">
    <div class=" container-temple">  
        <div class="close-div">
            <button type="button" class="close" onclick="location.href='#home'">&times;</button>
        </div> 
        <div class="search-div" >
            <input type="text" class="form-control" style="width:100%;" placeholder="Search"/>
        </div> 
        <div class="well"></div> 
        <div class="selection-div" >
            <div class="panel-group" id="accordion">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" onclick="collapseDiv('One','Two','Three');">
                                <b> Most Recent </b>
                            </a>
                        </h4>
                    </div>
                    <div id="One" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <a><b>1. Attacks <b></a><br/>
                           2. sports  <br/>
                           3. news    <br/>
                         </div>
                    </div>
                </div>
                <br/>
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" onclick="collapseDiv('Two','One','Three');">
                                <b>Most Popular</b>
                            </a>
                        </h4>
                    </div>
                    <div id="Two" class="panel-collapse collapse">
                        <div class="panel-body">
                           1. Attacks   <br/>
                           2. sports    <br/>
                           3. news      <br/>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" onclick="collapseDiv('Three','One','Two');">
                                <b>Trending</b>
                            </a>
                        </h4>
                    </div>
                    <div id="Three" class="panel-collapse collapse">
                        <div class="panel-body">
                           1. Attacks   <br/>
                           2. sports    <br/>
                           3. news      <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<script>
    function collapseDiv(showDiv,hideDiv1,hideDiv2) {
        $('#'+showDiv).collapse('show');
        $('#'+hideDiv1).collapse('hide');
        $('#'+hideDiv2).collapse('hide');
        
    }
var resizeEnd;
$(window).bind('resize', function(e) {
    clearTimeout(resizeEnd);
    var wh = $(window).width();
    var ht = $(window).height();
    resizeEnd = setTimeout(function() {
        resizeAndPosition(wh,ht);
    }, 200);
});
$(document).ready( function(){
    var wh = $(window).width();
    var ht = $(window).height();
    resizeAndPosition(wh,ht);
});
</script>
<?php
include_once("../includes/footer.php");
