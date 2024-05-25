<?php
    include_once("./class/clsApi.php");
    $api = new clsApi();

    if(isset($_REQUEST['search']) && isset($_REQUEST['idAccount']) && isset($_REQUEST['role']))
    {
        $search = strtolower($_REQUEST['search']);
        $id_account = $_REQUEST['idAccount'];
        $role = $_REQUEST['role'];
        
        switch ($role)
        {
            case 1:
                {
                    $sql = "SELECT * FROM 
                    (
                        SELECT up.*, acc.ten 
                        FROM uploadfile up LEFT JOIN account acc 
                        ON up.id_account = acc.id
                        WHERE up.id_account={$id_account}
                    ) AS subquery
                    WHERE LOWER(tenfile) LIKE '%{$search}%'";
                    $api->apiTimKiem($sql);
                    break;
                }
            case 2:
                {
                    $sql = "SELECT * FROM uploadfile up LEFT JOIN account acc ON up.id_account = acc.id WHERE LOWER(tenfile) LIKE '%{$search}%'";
                    $api->apiTimKiem($sql);
                    break;
                }
        }
    }
?>