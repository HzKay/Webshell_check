<?php
    class clsApi {
        private $host = "localhost";
        private $user = "congnghemoi";
        private $pass = "123456";
        private $database = "baitaploncnm";

        private function connectDB()
        {
            $conn=mysqli_connect($this->host,$this->user,$this->pass,$this->database);

            if(!$conn)
            {
                echo 'Không kết nối với CSDL';
                exit();    
            }
            else
            {
                mysqli_query($conn,"SET NAMES UTF8");
                return $conn;
            }
        }

        private function closeConnectDB ($conn)
        {
            mysqli_close($conn);
        }


        public function apiXemFile ($sql)
        {
            $conn = $this->connectDB();
            $result = mysqli_query($conn, $sql);

            $numrow = mysqli_num_rows($result);
            
            if ($numrow > 0)
            {
                $data = array();
                while ($row = mysqli_fetch_array($result))
                {
                    $id = $row['id'];
                    $idAccount = $row['id_account'];
                    $tenfile = $row['tenfile'];
                    $loaifile = $row['loaifile'];
                    $uploadtime = $row['uploadtime'];
                    $ten = $row['ten'];
                    $size = $row['sizeofFile'];

                    $data[] = array("id" => $id, "tenfile" => $tenfile, "loaifile" => $loaifile, "id-account" => $idAccount, "uploadTime" => $uploadtime, "ten" => $ten, "size" => $size);
                }

                header('content-Type:application/json; charset=UTF-8');
                echo json_encode($data);
            } else {
                echo 'CSDL đang cập nhật';
            }

            $this->closeConnectDB($conn);
        }

        public function apiXuLyFile ($sql)
        {
            $conn = $this->connectDB();
            $result = 0;

            if (mysqli_query($conn, $sql))
            {
                $result = 1;
            }
            
            $respone = array("result" => $result);

            header('content-Type: application/json; charset=UTF-8');
            echo json_encode($respone);
        }

        public function apiTimKiem($sql)
        {
            $conn = $this->connectDB();
            $result = mysqli_query($conn, $sql);
            $numrow = mysqli_num_rows($result);

            if ($numrow > 0)
            {
                $data=array();
                while ($row = mysqli_fetch_array($result))
                {
                    $id = $row['id'];
                    $idAccount = $row['id_account'];
                    $tenfile = $row['tenfile'];
                    $loaifile = $row['loaifile'];
                    $uploadtime = $row['uploadtime'];
                    $ten = $row['ten'];
                    $size = $row['sizeofFile'];

                    $data[] = array("id" => $id, "tenfile" => $tenfile, "loaifile" => $loaifile, "id-account" => $idAccount, "uploadTime" => $uploadtime, "ten" =>$ten, "size" => $size);
                }

                header('content-Type:application/json; charset=UTF-8');
                echo json_encode($data);
            }else{
                echo 'Không có kết quả';
            }
            $this->closeConnectDB($conn);
        }

        public function apiDataCol($sql)
        {
            $conn = $this->connectDB();
            $result = mysqli_query($conn, $sql);
            $numrow = mysqli_num_rows($result);
            $temp = 0;

            if($numrow > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $temp = $row['result'];
                }
            }

            $respone = array('result' => $temp);
            
            header('content-Type:application/json; charset=UTF-8');
            echo json_encode($respone);
            $this->closeConnectDB($conn);
        }
        
        public function authenRole($sql)
        {
            $conn = $this->connectDB();
            $result = mysqli_query($conn, $sql);
            $numrow = mysqli_num_rows($result);
            $temp = 0;

            if($numrow > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $temp = $row['result'];
                }
            }

            return $temp;
        }

        public function getUserList($sql)
        {
            $conn = $this->connectDB();
            $result = mysqli_query($conn, $sql);

            $numrow = mysqli_num_rows($result);
            
            if ($numrow > 0)
            {
                $data = array();
                while ($row = mysqli_fetch_array($result))
                {
                    $id = $row['id'];
                    $ten = $row['ten'];
                    $sdt = $row['sdt'];
                    $email = $row['email'];

                    $data[] = array("id" => $id, "ten" => $ten, "sdt" => $sdt, "email" => $email);
                }
                
                header('content-Type:application/json; charset=UTF-8');
                echo json_encode($data);
            } else {
                echo 'CSDL đang cập nhật';
            }

            $this->closeConnectDB($conn);
        }
    }
?>