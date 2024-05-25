<?php
    include_once ('./class/clsApi.php');
    $api = new clsApi();
    
    if (isset($_REQUEST['idAccount']) && isset($_REQUEST['role']))
    {
        $idAccount = $_REQUEST['idAccount'];
        $role = $_REQUEST['role'];

        $sqlauthent = "SELECT phanquyen AS result FROM account WHERE id={$idAccount} AND phanquyen={$role}";
        $roleAccount = $api->authenRole($sqlauthent);
        
        if ($roleAccount == 2) 
        {
            $api->getUserList("SELECT id, ten, sdt, email FROM account WHERE phanquyen = 1");
        }
    }    
?>