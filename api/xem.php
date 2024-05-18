<?php
    include_once ('./class/classApi.php');
    $api = new clsApi();

    $idAccount = 2;
    // $idAccount = $_SESSION['id'];
    
    if(isset($_REQUEST['idFile']))
    {
        $id = $_REQUEST['idFile'];
        $api->apiXemFile("SELECT * FROM uploadfile WHERE id = {$id} AND id_account = {$idAccount} LIMIT 1");
    } else {
        $api->apiXemFile("SELECT * FROM uploadfile WHERE id_account = {$idAccount} ORDER BY uploadtime DESC");
    }
?>