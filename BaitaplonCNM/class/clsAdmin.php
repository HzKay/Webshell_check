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
    }
?>