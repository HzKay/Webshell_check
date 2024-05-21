<?php
    include_once ('./class/classApi.php');
    $api = new clsApi();
    
    if (isset($_REQUEST['id']))
    {
        $idAccount = $_REQUEST['id'];
        if(isset($_REQUEST['idFile']))
        {
            $id = $_REQUEST['idFile'];
            $api->apiXemFile("SELECT up.*, acc.ten FROM uploadfile up INNER JOIN account acc ON up.id_account = acc.id WHERE id = {$id} AND id_account = {$idAccount} LIMIT 1");
        } else {
            $api->apiXemFile("SELECT up.*, acc.ten FROM uploadfile up INNER JOIN account acc ON up.id_account = acc.id WHERE id_account = {$idAccount} ORDER BY uploadtime DESC");
        }
    }    
?>