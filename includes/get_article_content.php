<?php

include 'db_connect.php';
include 'helper_functions.php';

function read_file_docx($filename) {
    $striped_content = '';
    $content = '';
    if (!$filename || !file_exists($filename)) {
        return false;
    }
    $zip = zip_open($filename);
    if (!$zip || is_numeric($zip)) {
        return false;
    }
    while ($zip_entry = zip_read($zip)) {
        if (zip_entry_open($zip, $zip_entry) == FALSE) {
            continue;
        }
        if (zip_entry_name($zip_entry) != "word/document.xml") {
            continue;
        }
        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
        zip_entry_close($zip_entry);
    }// end while
    zip_close($zip);
    
    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n\n", $content);
    $striped_content = strip_tags($content);
    return $striped_content;
}

function getUpvoteStatusForArticleForCurrentUser($mysqli,$user_id,$article_id) {
    
    $isArticleUpvotedByUser = "select * from article_upvoted where article_id=".$article_id." and id=".$user_id;
    $isArticleUpvotedByUserResult = mysqli_query($mysqli, $isArticleUpvotedByUser);
    if (!$isArticleUpvotedByUserResult) {
        error_log("[SQL] isArticleUpvotedByUserResult : " . mysqli_error($mysqli));
        return "false";
    }
    if (mysqli_num_rows($isArticleUpvotedByUserResult) == 0) {
        return "NO";
    } else {
        while($row= mysqli_fetch_array($isArticleUpvotedByUserResult)) {
            if($row['upvoted'] === "YES"){
                return "YES";
            } else if($row['upvoted'] === "NO") {
                return "NO";
            }
        }
    }
}

if (isset($_POST['article_path'])) {   
    $filename = $_POST['article_path'];
    $type = $_POST['article_type'];
    $filepath = "../".$type."/".$filename;
    $content = read_file_docx($filepath);
    $isArticleUpvoted = getUpvoteStatusForArticleForCurrentUser($mysqli,$_POST['user_id'],$_POST['article_id']);
    if($isArticleUpvoted === "false") {
        $result = array("status" => "error","ErrorField" => "isArticleUpvotedByUser");
        echo json_encode($result);
        return;
    }
    $result = array("status" => "success","content" => $content,"isArticleUpvoted" => $isArticleUpvoted);
    echo json_encode($result);
    return;
}
    
