<?php


$zip = new ZipArchive; // creating object of ZipArchive class.
$sUploadedFile = 'publisher.docx';
$zip->open("word_document/$sUploadedFile");
$aFileName = explode('.',$sUploadedFile);
$sDirectoryName =  current($aFileName);

if (!is_dir("word_document/$sDirectoryName")){
    mkdir("word_document/$sDirectoryName");
    $zip->extractTo("word_document/$sDirectoryName"); 
    copy("word_document/$sDirectoryName/word/document.xml", "xml_document/$sDirectoryName.xml");

    $xml = simplexml_load_file("xml_document/$sDirectoryName.xml");
    $xml->registerXPathNamespace('w',"http://schemas.openxmlformats.org/wordprocessingml/2006/main");
    $text = $xml->xpath('//w:t');

    echo '<pre>'; print_r($text); echo '</pre>';

    rrmdir("word_document/$sDirectoryName");
}

function rrmdir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") 
           rrmdir($dir."/".$object); 
        else unlink   ($dir."/".$object);
      }
    }
    reset($objects);
    rmdir($dir);
  }
 }

?>