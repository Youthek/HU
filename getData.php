<?php

// configuration
include 'config.php';

$data = json_decode(file_get_contents("php://input"));

$row = $data->row;
$rowperpage = $data->rowperpage;

// selecting posts
$query = 'SELECT * FROM posts limit '.$row.','.$rowperpage;
$result = mysqli_query($con,$query);

$response_arr = array();

while($datarow = mysqli_fetch_assoc($result)){
 
    $id = $datarow['id'];
    $title = $datarow['title'];
    $content = $datarow['content'];
    $shortcontent = substr($content, 0, 160)."...";
    $link = $datarow['link'];
 
    $response_arr[] = array('id'=>$id,'title'=>$title,'shortcontent'=>$shortcontent,'content'=>$content,'link'=>$link);
 
}

if(count($response_arr) > 0)
echo json_encode($response_arr);
exit;