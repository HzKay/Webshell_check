<?php
    include_once ("./class/clsApi.php");
    $api = new clsApi();

    if(isset($_REQUEST['idAccount']) && isset($_REQUEST['role']))
    {
        $id_account = $_REQUEST['idAccount'];
        $role = $_REQUEST['role'];
        
        switch ($role)
        {
            case 1:
                {
                    $filename = $_REQUEST['filename'];
                    $extension = $_REQUEST['ext'];
                    $filepath = $_REQUEST['filepath'];
                    $size = $_REQUEST['size'];
                    $idFile = $_REQUEST['idFile'];
                    
                    $sql = "UPDATE uploadfile 
                            SET id_account = '$id_account', 
                                tenfile = '$filename', 
                                loaifile = '$extension', 
                                uploadtime = NOW(),
                                filepath = '$filepath', 
                                sizeofFile = $size
                            WHERE id = {$idFile}
                            ";
                    $api->apiXuLyFile($sql);
                    break;
                }
            default:
                {
                    echo 'No permisson';
                    break;
                }
        }
    }
?>