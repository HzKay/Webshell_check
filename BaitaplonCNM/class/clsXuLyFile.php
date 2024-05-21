<?php
include_once("connect.php");
// include_once("class/clsHandleApi.php");
class clsXuLyFile extends connectDB
{
    private function readApi ($url)
    {
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $respone = curl_exec($client);
        $result = json_decode($respone);
        return $result;
    }

    public function xuLyLuuFile()
    {
       if ($this->kiemTraFile() == 1)
       {
        $result = -1;
        echo '<script language="javascript">
        window.location="./index.php?message='.$result.'";
          </script>';
       } else {
        $this->luuFile();
       }

    }

    private function kiemTraFile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']))
        {
            $url = 'http://localhost:5000/predict';
            $tmpName = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileType = $_FILES['file']['type'];

            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_POST, TRUE);

            $file = new CURLFile($tmpName, $fileType, $fileName);

            $postData = array('file' => $file);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

            $response = curl_exec($curl);

            if (curl_errno($curl)) 
            {
                echo 'Error: ' . curl_error($curl);
            }

            curl_close($curl);

            return json_decode($response)->result;
        }
    }

    public function luuFile()
    {
        if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
            // Lấy thông tin về tập tin
            $name = $_FILES["file"]["name"];
            $filename_without_extension = pathinfo($name, PATHINFO_FILENAME);
            $tmp_name = $_FILES["file"]["tmp_name"];
            $type = $_FILES["file"]["type"];
            $extension = end(explode(".", $name));

            // Lấy thời gian upload
            $uploadTime = date("Y-m-d H:i:s");
            // Kiểm tra xem phiên đã được khởi động trước khi sử dụng biến $_SESSION
            if (isset($_SESSION["id"])) {
                $idaccount = $_SESSION["id"];
                // $name = time() . "_" . $name;
                if ($this->upload_file($tmp_name, "upload", $name) == 1) {
                    $sql = "insert into uploadfile(id_account,tenfile,loaifile,uploadtime) values ('$idaccount','$filename_without_extension','$extension','$uploadTime')";
                    $result = $this->themxoasua($sql);
                    
                    if ($result != 1) {
                        $result = 0;
                    }
                    echo '<script language="javascript">
                    window.location="./index.php?message='.$result.'";
                      </script>';
                }
            } else {
                echo "Session không tồn tại.";
            }
        } else {
            echo "Có lỗi xảy ra khi tải lên tập tin.";
        }
    }

    public function upload_file($tmp_name, $folder, $name)
    {
        if ($tmp_name != "" && $folder != "" && $name != "") {
            $newname = $folder . "/" . $name;
            if (move_uploaded_file($tmp_name, $newname)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    public function themxoasua($sql)
    {
        $link = $this->connectDB();
        $kq = mysqli_query($link, $sql);
        if ($kq) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function getFilename ($sql) {
        $conn = $this->connectDB();
        $result = mysqli_query($conn, $sql);

        $numrow = mysqli_num_rows($result);

        if($numrow > 0)
        {
            $fileName = mysqli_fetch_array($result);
            $filePath = $fileName["tenfile"] . '.' . $fileName["loaifile"];
            return $filePath;
        } else
        {
            return 0;
        }
    }
    public function showFiles($url)
    {
        $result=$this->readApi($url);
        echo '<table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th  scope="col">Id</th>
                <th  scope="col">Tên</th>
                <th  scope="col">Loại</th>
                <th  scope="col">Tải lên</th>
                <th  scope="col">Chủ sỡ hữu</th>
                <th  scope="col">Thao tác</th>
                </tr>
                </thead>
            <tbody>';
        $stt = 1;
        foreach ($result as $row) {
            $id=$row->id;
            $tenfile = $row->tenfile;
            $loaifile = $row->loaifile;
            $uploadtime = $row->uploadTime;
            $ten = $row->ten;
            echo '<tr>
                <td scope="row">' .$stt .'</td>
                <td>' . $tenfile . '</td>
                <td>' . $loaifile . '</td>
                <td>' . $uploadtime .'</td>
                <td>' . $ten . '</td>
                <td>
                    <div>
                        <a  href="#"><i class="fa fa-download action" aria-hidden="true"></i></a>
                        <a  href="./delete_file.php?id='.$id.'"><i class="fa fa-trash action" aria-hidden="true"></i></a>
                    </div>
                </td>
                </tr>';

            $stt++;
        }
        echo '     
            </tbody>
            </table>';
    }
    public function laycot($sql)
	{
		$link=$this->connectDB();
		$ketqua=mysqli_query($link,$sql);
		$i=mysqli_num_rows($ketqua);
		$giatri="";
		if($i>0)
		{
			while($row=mysqli_fetch_array($ketqua))
			{
				$giatri=$row[0];
			}
			return $giatri;
		}
		
	}
    public function load_ds_nguoidung($sql)
    {
        $link = $this->connectDB();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            echo '<table class="table table-hover pt-2">
				<thead class="thead-light">
				<tr>
					<th  scope="col">STT</th>
					<th  scope="col">Name</th>
					<th  scope="col">Phone</th>
					<th  scope="col">Email</th>
				</tr>
				</thead>
				<tbody>';
            $dem = 1;
            while ($row = mysqli_fetch_array($ketqua)) {
                $id=$row['id'];
                $ten = $row["ten"];
                $sdt = $row["sdt"];
                $email = $row["email"];
                echo '<tr>
					<td scope="row">' .
                    $dem .
                    '</td>
					<td>' .
                    $ten .
                    '</td>
					<td>' .
                    $sdt .
                    '</td>
					<td>' .
                    $email .
                    '</td>
				  </tr>';

                $dem++;
            }
            echo '     
				</tbody>
				</table>';
        } else {
            echo " Không có dữ liệu";
        }
        mysqli_close($link);
    }      
    }

?>
