<?php
    include_once ('./class/clsApi.php');
    $api = new clsApi();
    
    if (isset($_REQUEST['idAccount']))
    {
        $idAccount = $_REQUEST['idAccount'];
        if(isset($_REQUEST['idFile']))
        {
            $id = $_REQUEST['idFile'];
            $api->apiXemFile("SELECT up.*, acc.ten FROM uploadfile up INNER JOIN account acc ON up.id_account = acc.id WHERE up.id = {$id} AND up.id_account = {$idAccount} LIMIT 1");
        } else {
            $api->apiXemFile("SELECT up.*, acc.ten FROM uploadfile up INNER JOIN account acc ON up.id_account = acc.id WHERE up.id_account = {$idAccount} ORDER BY uploadtime DESC");
        }
    }    
?>