<?php
    include_once("./class/clsApi.php");
    $api = new clsApi();

    if(isset($_REQUEST['idFile']) && isset($_REQUEST['idAccount']) && isset($_REQUEST['role']))
    {
        $idFile = $_REQUEST['idFile'];
        $idAccount = $_REQUEST['idAccount'];
        $role = $_REQUEST['role'];

        switch ($role)
        {
            case 1:
                {
                    $sql = "DELETE FROM uploadfile WHERE id={$idFile} AND id_account={$idAccount}";

                    $api->apiXuLyFile($sql);
                    break;
                }

            case 2: 
                {
                    $sql = "DELETE FROM uploadfile WHERE id={$idFile}";
                    $api->apiXuLyFile($sql);
                    break;
                }    
        }
    }
?>