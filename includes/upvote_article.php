<?php

include 'db_connect.php';
include 'helper_functions.php';

sec_session_start();

function getUpvoteCount($mysqli,$articleid) {
    $getUpvotesForArticle = "select upvotes from articles where article_id=" . $articleid;
    $getUpvoteResults = mysqli_query($mysqli, $getUpvotesForArticle);
    if (!$getUpvoteResults) {
        error_log("[SQL] getUpvoteCount : " . mysqli_error($mysqli));
        return "false";
    }
    while ($row = mysqli_fetch_array($getUpvoteResults)) {
        return $row['upvotes'];
    }
}

function updateUpvoteCount($mysqli,$articleid,$upvoteCount) {
    $setUpvotesForArticle = "update articles set upvotes=". $upvoteCount. " where article_id=" . $articleid;
    $setUpvoteResults = mysqli_query($mysqli, $setUpvotesForArticle);
    if (!$setUpvoteResults) {
        error_log("[SQL] updateUpvoteCount : " . mysqli_error($mysqli));
        return "false";
    }
    return "true";
}

function setUpvotedFlag($mysqli,$articleid,$userid,$upvoted) {
    $setUpvoteFlagQuery = "update article_upvoted set upvoted = '".$upvoted."'where article_id = ".$articleid." and id = " . $userid;
    $setUpvoteFlag = mysqli_query($mysqli,$setUpvoteFlagQuery);
    if (!$setUpvoteFlag) {
        error_log("[SQL] setUpvotedFlag : " . mysqli_error($mysqli));
        return "false";
    }
    return "true";
}

if (login_check($mysqli) == true) {
    $user_id = $_SESSION['user_id'];
    
    //get upvotes for the article
    if(!isset($_POST['articleid']) || !isset($_POST['userid'])) {
        $result = array("status" => "error","ErrorField" => "Error fetching articleid or userid");
        echo json_encode($result);
        return;
    }
    
    $upvoteCount = getUpvoteCount($mysqli,$_POST['articleid']);
    if($upvoteCount === "false") {
        $result = array("status" => "error","ErrorField"=>"getUpvoteCount","upvote"=>$upvoteCount);
        echo json_encode($result);
        return;
    }
    
    $isArticleUpvotedByUser = "select * from article_upvoted where article_id=".$_POST['articleid']." and id=".$_POST['userid'];
    
    $isArticleUpvotedByUserResult = mysqli_query($mysqli, $isArticleUpvotedByUser);
    if (!$isArticleUpvotedByUserResult) {
        error_log("[SQL] isArticleUpvotedByUserResult : " . mysqli_error($mysqli));
        $result = array("status" => "error","ErrorField" => "isArticleUpvotedByUser");
        echo json_encode($result);
        return;
    }
    //User upvoting it for the first time. Create the DB entry and mark upvoted field as YES
    if (mysqli_num_rows($isArticleUpvotedByUserResult) == 0) {
        $createEntryForUser = "insert into article_upvoted values(" . $_POST['userid'] . "," . $_POST['articleid'] . ",'YES')";
        $createEntryForUserResults = mysqli_query($mysqli, $createEntryForUser);
        if(!$createEntryForUserResults) {
            error_log("[SQL] createEntryForUserResults : " . mysqli_error($mysqli));
            $result = array("status" => "error", "ErrorField" => "createEntryForUserResults");
            echo json_encode($result);
            return;
        }
        $updateUpvoteCountResult = updateUpvoteCount($mysqli, $_POST['articleid'],  ++$upvoteCount);
        if($updateUpvoteCountResult === "false") { 
            $result = array("status" => "error", "ErrorField" => "updateUpvoteCountResult");
            echo json_encode($result);
            return;
        }
        
        $result = array("status" => "success","upvoted" => "YES");
        echo json_encode($result);
        return;
    }

    if(mysqli_num_rows($isArticleUpvotedByUserResult)!= 0) {
        //User entry already there in DB. Flip the upvoted entry to NO if YES ans vice vers
        $upvoted = "NO";
        while($row= mysqli_fetch_array($isArticleUpvotedByUserResult)) {
            if($row['upvoted'] === "YES"){
                $upvoted = "NO";
                $upvoteCount--;
            } else if($row['upvoted'] === "NO") {
                $upvoted = "YES";
                $upvoteCount++;
            }
        }
        //incease count and set the upvoted value
        $setUpvotedFlagResult    = setUpvotedFlag($mysqli,$_POST['articleid'],$_POST['userid'],$upvoted);
        if($setUpvotedFlagResult === "false") { 
            $result = array("status" => "error", "ErrorField" => "setUpvotedFlagResult");
            echo json_encode($result);
            return;
        }
        $updateUpvoteCountResult = updateUpvoteCount($mysqli,$_POST['articleid'],$upvoteCount);
        if($updateUpvoteCountResult === "false") { 
            $result = array("status" => "error", "ErrorField" => "updateUpvoteCountResult");
            echo json_encode($result);
            return;
        }
        $result = array("status" => "success","upvoted" => $upvoted);
        echo json_encode($result);
        return;
    }
} else {
    //redirect to problem page with statement you are not authorized to see this page.
}
