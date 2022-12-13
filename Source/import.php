<?php


$sUploadedFile = $request->product_import;
echo "Upload File : $sUploadedFile";

//Check for extension
$arr = explode('.', $sUploadedFile);
$ext = $arr[1];

//if its docx file
if($ext == 'docx')
    $dataFile = "word/document.xml";
//else it must be odt file
else
    $dataFile = "content.xml";     

//Create a new ZIP archive object
$zip = new ZipArchive;

// Open the archive file
if (true === $zip->open("word/" . $sUploadedFile)) {
    // If successful, search for the data file in the archive
    if (($index = $zip->locateName($dataFile)) !== false) {
        // Index found! Now read it to a string
        $xml_datas = $zip->getFromIndex($index);

        $replace_newlines = preg_replace('/<w:p w[0-9-Za-z]+:[a-zA-Z0-9]+="[a-zA-z"0-9 :="]+">/',"\n\r",$xml_datas);
        $replace_tableRows = preg_replace('/<w:tr>/',"\n\r",$replace_newlines);
        $replace_tab = preg_replace('/<w:tab\/>/',"\t",$replace_tableRows);
        $replace_paragraphs = preg_replace('/<\/w:p>/',"\n\r",$replace_tab);
        $replace_other_Tags = strip_tags($replace_paragraphs);          
        $output_text = $replace_other_Tags;

        dd($output_text);
    }
    //Close the archive file
    $zip->close();
}
die();

    //Session::flash('product_upload_fail_message','Product Import file is not in the correct format. Expecting docx file & receved ' . $sUploadedFile);
    return back();












?>