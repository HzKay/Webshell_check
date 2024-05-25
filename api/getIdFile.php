<?php
    include_once("./class/clsApi.php");
    $api = new clsApi();

    if(isset($_REQUEST['name']) && isset($_REQUEST['idAccount']))
    {
        $search = $_REQUEST['name'];
        $id_account = $_REQUEST['idAccount'];
        
        $sql = "SELECT id AS result FROM uploadfile WHERE tenfile = '{$search}' AND id_account = {$id_account}";
        $api->apiDataCol($sql);
    }
?>