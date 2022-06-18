<?php
 include('Api.php');

 $api_object = new API();

 if($_GET["action"] == 'fetch_all'){
     $data = $api_object->fetch_all();
 }


 if($_GET["action"] == 'fetch_all_currencies'){
    $data = $api_object->fetch_all_currencies();
}

if($_GET["action"] == 'fetch_page'){
    $data = $api_object->fetch_page($_GET["id"]);
}

if($_GET["action"] == 'search_items'){
    $data = $api_object->search_items($_GET["wheresql"]);
}

 echo json_encode($data);
?>