<?php
//Get data
include('Api.php');

$api_object = new Api();
//$data= "";

if ($_GET["action"] === 'fetch_all') {
    $data = $api_object->fetch_all();
}

//Add data
if ($_GET["action"] === 'insert') {
    $data = $api_object->insert();
}
//Edit data
if ($_GET["action"] === 'fetch_single') {
    $data = $api_object->fetch_single($_GET["Id"]);

}

if ($_GET["action"] == 'update') {
    $data = $api_object->update();
}
//delete
if ($_GET["action"] == 'delete') {
    $data = $api_object->delete($_GET["Id"]);
}
echo json_encode($data);
