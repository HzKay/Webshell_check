<?php
    include_once("clsHandleApi.php");
    class clsAdmin extends handleApi
    {
        public function getOverview($action)
        {
            $idAccount = $_SESSION['id'];
            $role = $_SESSION['phanquyen'];
            $url = "http://localhost/Webshell_check/api/getCol.php?idAccount={$idAccount}&role={$role}&action={$action}";
            $result = $this->excuteApi($url);
            return $result;
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

        public function showUserList($url)
    {
        $result = $this->readApi($url);
        
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
        if(!is_null($result))
        {
            $dem = 1;
            foreach ($result as $row)
            {
                $ten = $row->ten;
                $sdt = $row->sdt;
                $email = $row->email;
                
                echo '<tr><td scope="row">' .$dem .'</td>
                    <td>' .$ten .'</td>
                    <td>' .$sdt .'</td>
                    <td>' .$email .'</td>
                    </tr>';
                $dem++;
            }
            echo '</tbody>
				</table>';
        } else {
            echo '</tbody>
				</table>';
            echo " Không có dữ liệu";
        }
    }

    public function updateSetting($maxsize, $extentions) 
    {
        $url = "http://localhost/Webshell_check/api/xacthuc.php?idAccount={$_SESSION['id']}&role={$_SESSION['phanquyen']}&ten={$_SESSION['ten']}";
        $result = (int) $this->excuteApi($url);
        $allow_extends = implode(",", $extentions);
        $content = "";
        $maxsize = $maxsize*1000;

        if ($result == 2) {
            $content = $content . "maxsize = '{$maxsize}'\n";
            $content = $content . "allowed_file_type = 'text/plain,image/jpeg,image/png,application/pdf,image/webp,application/octet-stream,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'\n";
            $content = $content . "allowed_extentions = '$allow_extends'";
        }
        
        $result = file_put_contents("../config.ini", $content);
        
        if($result == false) {
            echo "<script>alert('Lỗi, cài đặt không thành công');</script>";
        } else {
            echo "<script>alert('Cài đặt thành công');</script>";
        }
    }
    
    public function showSetting()
    {
        $maxsize = ((int) $this->getSettingFile('maxsize')) / 1000;
        $fileExt= explode(",", $this->getSettingFile('allowed_extentions'));
        $arrSize = range(50, 400+1, 50);
        $extentions = array('php','txt','jpg','png','pptx','xlsx');

        echo "
            <form id='form1' name='form1' method='post' action=''>
                <table width='926' border='1' align='center' cellpadding='5' cellspacing='0' class='table table-bordered'>
                    <tr>
                        <td align='left' valign='middle' class='col-md-5'>Dung lượng tối đa của file tải lên:</td>
                        <td align='left' valign='middle' class='col-md-7'>
                            <label for='txtdungluong'></label>
                            <select name='txtdungluong' class='p-1' id='txtdungluong'>";
                               
        foreach ($arrSize as $value)
        {
            if ($maxsize == $value) {
                echo "<option value='{$value}' selected>{$value} KB</option>";
            } else {
                echo "<option value='{$value}'>{$value} KB</option>";
            }
        }

        echo "</select>
                    </td>
                </tr>
                <tr>
                    <td align='left' valign='middle'>Đuôi mở rộng file được tải lên:</td>
                    <td align='left' valign='middle'>";
        foreach ($extentions as $value)
        {
            if (in_array($value, $fileExt)) {
                echo "<input type='checkbox' name='ext-file[]' id='ex-{$value}' class='check-ex' value='{$value}' checked><label class='mr-3' for='ex-{$value}'>{$value}</label>";
            } else {
                echo "<input type='checkbox' name='ext-file[]' id='ex-{$value}' class='check-ex' value='{$value}'><label for='ex-{$value}' class='mr-3'>{$value}</label>";
            }
        }

        echo "
                    </td>
                </tr>
                
                <tr>
                    <td colspan='2' align='center' valign='middle'>
                        <button type='submit' name='btn' value='btn-setup' class='btn btn-setup'>Cài đặt</button>
                    </td>
                </tr>
            </table>
        </form>
        ";
    }

    private function getSettingFile($index = 'maxsize')
    {
        $filepath = "../config.ini";
        $setting = parse_ini_file($filepath);

        return $setting[$index];
    }
    }
?>