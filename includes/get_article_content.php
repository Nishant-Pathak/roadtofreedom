<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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

if (isset($_POST['article_path'])) {
    $filename = $_POST['article_path'];
    $type = $_POST['article_type'];
    $filepath = "../".$type."/".$filename;
    $content = read_file_docx($filepath);
    error_log($content);
    echo $content;
}
    


//echo 'hello';
