<?php
    include_once("./class/clsApi.php");
    $api = new clsApi();

    if(isset($_REQUEST['idAccount']) && isset($_REQUEST['role'])) 
    {
        $idAccount = $_REQUEST['idAccount'];
        $role = $_REQUEST['role'];
        
        $sqlauthent = "SELECT phanquyen AS result FROM account WHERE id={$idAccount} AND phanquyen={$role}";
        $roleAccount = $api->authenRole($sqlauthent);
        
        if ($roleAccount == 2)
        {
            $action = $_REQUEST['action'];
            switch($action)
            {
                case 'user':
                {
                    $api->apiDataCol("SELECT COUNT(id) AS result FROM account WHERE phanquyen = 1");
                    break;
                }
                case 'file':
                {
                    $api->apiDataCol('SELECT COUNT(id) AS result FROM uploadfile');
                    break;
                }
                case 'size':
                {
                    $api->apiDataCol("SELECT SUM(sizeofFile) AS result FROM uploadfile");
                    break;
                }
                default:
                {
                    break;
                }
            }
        }
    }
?>