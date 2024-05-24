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
                    
                    $sql = "INSERT INTO uploadfile (id_account, tenfile, loaifile, filepath, sizeofFile) values ($id_account,'$filename','$extension', '$filepath', $size)";
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