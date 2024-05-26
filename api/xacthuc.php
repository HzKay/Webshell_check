<?php
    include_once("./class/clsApi.php");
    $api = new clsApi();

    if(isset($_REQUEST['role']) && isset($_REQUEST['idAccount']) && isset($_REQUEST['ten']))
    {
        $ten = $_REQUEST['ten'];
        $id_account = $_REQUEST['idAccount'];
        $role = $_REQUEST['role'];
        
        $sql = "SELECT phanquyen AS result FROM account WHERE ten = '{$ten}' AND id = {$id_account} AND phanquyen = {$role}";
        $api->apiDataCol($sql);
    }
?>