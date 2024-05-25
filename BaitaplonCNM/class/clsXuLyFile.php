<?php
include_once("clsHandleApi.php");
class clsXuLyFile extends handleApi
{
    private $urlApi = "http://localhost/Webshell_check/api";
    private $host = "";

    public function xuLyLuuFile()
    {
        $resultCheck = $this->kiemTraFile();
        if ($resultCheck == 1) {
            $result = -1;
            $this->changeLocation('index.php', $result);
        } else {
            $this->luuFile();
        }
    }

    private function kiemTraFile()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
            // $url = "https://localhost:5000/predict";
            $url = "https://webshell-v7dmwwagqq-uc.a.run.app/predict";
            $tmpName = $_FILES["file"]["tmp_name"];
            $fileName = $_FILES["file"]["name"];
            $fileType = $_FILES["file"]["type"];

            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);

            $file = new CURLFile($tmpName, $fileType, $fileName);

            $postData = ["file" => $file];
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

            
            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                echo "Error: " . curl_error($curl);
            }

            curl_close($curl);
            return json_decode($response)->result;
        }
    }
    
    public function luuFile()
    {
        include_once("clsnotion.php");
        $notion = new notionStatus();

        if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
            // Lấy thông tin về tập tin
            $name = $_FILES["file"]["name"];
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $tmp_name = $_FILES["file"]["tmp_name"];
            $size = $_FILES['file']['size'];
            $temp = explode(".", $name);
            $extension = end($temp);
            $filepath = $_SESSION['accountFolder'] . '/' . $name;
            
            // Kiểm tra xem phiên đã được khởi động trước khi sử dụng biến $_SESSION
            if (isset($_SESSION["id"])) {
                $idaccount = $_SESSION["id"];
                $fileExist = false;
                if (file_exists($filepath) && is_file($filepath)) {
                    $fileExist = true;
                } 

                if ($this->handeUploadfile($tmp_name, $name) == 1) {
                    if($fileExist)
                    {
                        $idFile = $this->getIdFile($filename, $idaccount);
                        $url = "{$this->urlApi}/sua.php?filename={$filename}&ext={$extension}&filepath={$_SESSION['accountFolder']}&idAccount={$idaccount}&role={$_SESSION['phanquyen']}&size={$size}&idFile={$idFile}";
                    } else {
                        $url = "{$this->urlApi}/themFile.php?filename={$filename}&ext={$extension}&filepath={$_SESSION['accountFolder']}&idAccount={$idaccount}&role={$_SESSION['phanquyen']}&size={$size}";
                    }

                    $result = $this->excuteApi($url);

                    if ($result != 1) {
                        $result = 0;
                    }
                    
                    $this->changeLocation('index.php', $result);
                }
            } else {
                $this->changeLocation('index.php', 99);
            }
        } else {
            $this->changeLocation('index.php', 0);
        }
    }

    public function getIdFile($name, $idAccount)
    {
        $url = "http://localhost/Webshell_check/api/getIdFile.php?name={$name}&idAccount={$idAccount}";
        $result = $this->excuteApi($url);
        
        if (!is_null($result))
        {
            return $result;
        }
        return -1;
    }

    public function handeUploadfile ($tmp_name, $name)
    {
        $isCreate = $this->createFolder();

        if($isCreate != -1)
        {
            $resultUpdate = $this->upload_file($tmp_name, $name);
            return $resultUpdate;
        } 

        return $isCreate;
    }

    public function createFolder()
    {
        if(!file_exists($_SESSION['accountFolder']))
        {
            mkdir($_SESSION['accountFolder']);
            return 1;
        } else {
            return 0;
        }

        return -1;
    }

    public function upload_file($tmp_name, $name)
    {
        if ($tmp_name != "" && $_SESSION['accountFolder'] != "" && $name != "") {
            $filepath = $_SESSION['accountFolder'] . "/" . $name;
            
            if (move_uploaded_file($tmp_name, $filepath)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function changeLocation ($file = 'filename.php', $message=-520)
    {
        if($file != '' && $file != 'filename.php')
        {
            $message = (int) $message;
            if ($message === -520)
            {
                echo "<script language='javascript'>
                    window.location='./{$file}';
                </script>";
            } else {
                echo "<script language='javascript'>
                        window.location='./{$file}?message={$message}';
                  </script>";
            }
        } else {
            echo '<script language="javascript">
						window.location="/";
				</script>';
        }
    }

    public function showFiles($url)
    {
        $result = $this->readApi($url);
        echo '<table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th  scope="col">Id</th>
                <th  scope="col">Tên</th>
                <th  scope="col">Loại</th>
                <th  scope="col">Tải lên</th>
                <th  scope="col">Chủ sỡ hữu</th>
                <th  scope="col">Kích thước</th>
                <th  scope="col">Thao tác</th>
                </tr>
                </thead>
            <tbody>';
        $stt = 1;
        if(!is_null($result))
        {
            foreach ($result as $row) {
                $id = $row->id;
                $tenfile = $row->tenfile;
                $loaifile = $row->loaifile;
                $uploadtime = $row->uploadTime;
                $ten = $row->ten;
                $size = $this->showSize($row->size);
                $urlfile = "{$_SESSION['accountFolder']}/{$tenfile}.{$loaifile}";
                echo '<tr>
                    <td scope="row">' .$stt .'</td>
                    <td>' .$tenfile .'</td>
                    <td>' .$loaifile .'</td>
                    <td>' .$uploadtime .'</td>
                    <td>' .$ten .'</td>
                    <td>' .$size .'</td>
                    <td>
                        <div>                       
                            <form action="" method="post">
                                <input type="text" hidden name="idfile" value="' .$id .'">
                                <input type="text" hidden name="urlfile" value="' . $this->host . $urlfile .'">
                                
                                <button value="download" class="btnAction bg-transparent" name="btn"><i class="pri-color fa fa-download" aria-hidden="true"></i></button>
                                <button value="delete" class="btnAction bg-transparent" name="btn"><i class="pri-color fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                    </td>
                    </tr>';
    
                $stt++;
            }
            echo '     
                </tbody>
                </table>';
        } else {
            echo '     
                </tbody>
                </table>';
            echo '<p>Không có kết quả</p>';
        }
    }

    public function showSize ($size) 
    {
        if($size > 0)
        {
            $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
            $unitIndex = floor(log($size, 1024));
            $formatSize = $size / pow(1024, $unitIndex);
            $formatSize = round($formatSize * 100) / 100;
            return $formatSize . ' ' . $units[$unitIndex];
        } else {
            return '0 KB';
        }
    }

    public function deleteFile()
    {
        $idFileDel = $_SESSION['idFileDel'];
        $idAccount = $_SESSION['id'];
        $role = $_SESSION['phanquyen'];

        $urlRead = $this->urlApi."/xem.php?idFile={$idFileDel}&idAccount={$idAccount}";
        $urlDel = $this->urlApi."/xoa.php?idFile={$idFileDel}&idAccount={$idAccount}&role={$role}";
        
        $file = $this->readApi($urlRead)[0];
        $filepath = $_SESSION['accountFolder'] . '/' . $file->tenfile .'.'. $file->loaifile;

        if(unlink($filepath))
        {
            $resultDel = $this->excuteApi($urlDel);
            if($resultDel == 1)
            {
                $this->changeLocation('index.php', 2);
            } else {
                $this->changeLocation('index.php', -2);
            }
        }
        else
        {
            $this->changeLocation('index.php', -2);
        }
    }

    public function downloadFile($urlfile, $filename, $download_rate=10000)
    {
        if(file_exists($urlfile) && is_file($urlfile))
        {
            header('Cache-control: private');
            header('Content-Type: application/octet-stream');
            header('Content-Length: '.filesize($urlfile));
            header('Content-Disposition: filename='.$filename);
            flush();
            $file = fopen($urlfile, "r");

            while (!feof($file))
            {
                    print fread($file, round($download_rate * 1024));
                    flush();
                    sleep(1);
            }
            fclose($file);
        }else {
            echo "<script>alert('Lỗi: {$filename} không tồn tại');</script>";
        }
    }
}

?>
