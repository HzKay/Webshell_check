<?php 
    class notionStatus 
    {
        private function showNotion ($mess)
        {
            switch ((int) $mess)
            {
                case 2:
                    {
                        $this->delFileSuccess();
                        break;
                    } 
                case 1:
                    {
                        $this->uploadSuccess();
                        break;
                    } 
                case 0:
                    {
                        $this->uploadFail();
                        break;
                    } 
                case -1:
                    {
                        $this->uploadFileIsWebshell();
                        break;
                    } 
                case -2:
                    {
                        $this->delFileFail();
                        break;
                    } 
                case 3:
                    {
                        $this->delFileAccept();
                        break;
                    }
                case 4:
                    {
                        $this->updateFileAccept();
                        break;
                    }
                case -4:
                    {
                        $this->uploadFailType();
                        break;
                    }
                case -5:
                    {
                        $this->uploadFailSize();
                        break;
                    }
                default:
                    {
                        $this->defaultError();
                        break;
                    }
            }

            echo "
                <script>
                    $(document).ready(function() {
                    $('#resultModal').modal('show')
                    })
                </script>
            ";
        }

        public function modelNotion ($mess)
        {
            echo "
            <div class='modal fade' id='resultModal' role='dialog' aria-label='resultModalLabel'  aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content min-h-65'>
                        <div class='modal-body text-center'>";
            $this->showNotion($mess);            
            echo "
                        </div>
                    </div>
                </div>
            </div>";
        }

        private function uploadSuccess ()
        {
            $render = "
                <div class='icon-status mt-2 p-5'>     
                    <i class='far fa-check-circle text-success mb-3'></i></br>
                    <h3 class='text-success'>Upload file thành công<h3></h3>
                </div>
                <input type='button' class='btn btn-accept mb-3' data-dismiss='modal' value='Okay'>
            ";
            echo $render;
        }

        private function uploadFail ()
        {
            $render = "
                <div class='icon-status mt-2 p-5'>     
                    <i class='far fa-times-circle text-danger mb-3'></i></br>
                    <h3 class='text-danger'>Upload file thất bại</h3>
                </div>
                <input type='button' class='btn btn-accept mb-3' data-dismiss='modal' value='Okay'>
            ";
            echo $render;
        }

        private function uploadFileIsWebshell ()
        {
          
            $render = "
                <div class='icon-status mt-2 p-5'>     
                    <i class='far fa-times-circle text-danger mb-3'></i></br>
                    <h3 class='text-danger'>Upload file thất bại! </br>File của bạn có thể chứa webshell</h3>
                </div>
                <input type='button' class='btn btn-accept mb-3' data-dismiss='modal' value='Okay'>
            ";
            echo $render;
        }

        private function delFileSuccess ()
        {
                $render = "
                <div class='icon-status mt-2 p-5'>     
                    <i class='far fa-check-circle text-success mb-3'></i></br>
                    <h3 class='text-success'>Xoá file thành công!</h3>
                </div>
                <input type='button' class='btn btn-accept mb-3' data-dismiss='modal' value='Okay'>
            ";
            echo $render;
        }

        private function delFileFail ()
        {
            $render = "
                <div class='icon-status mt-2 p-5'>     
                    <i class='far fa-times-circle text-danger mb-3'></i></br>
                    <h3 class='text-danger'>Xoá file không thành công</h3>
                </div>
                <input type='button' class='btn btn-accept mb-3' data-dismiss='modal' value='Okay'>
            ";
            echo $render;
        }
        
        private function delFileAccept ()
        {
            $render = "
                <form method='POST' style='margin-top: 65px'>
                    <h5>Bạn có chắc chắn xóa file này không ?</h5></br>
                    
                    <button type='submit' class='btn btn-accept mb-3 mr-3' name='btn' value='btn-del-yes'>Có</button>
                    <button type='submit' class='btn bg-light mb-3' name='btn' value='btn-del-no'>Không</button>
                </form>
            ";
            echo $render;
        }

        private function updateFileAccept ()
        {
            $render = "
                <form method='POST' style='margin-top: 65px'>
                    <h5>File đã tồn tại! Bạn có muốn cập nhật lại không</h5></br>
                    
                    <button type='submit' class='btn btn-accept mb-3 mr-3' name='btn' value='btn-update-yes'>Có</button>
                    <button type='submit' class='btn bg-light mb-3' name='btn' value='btn-update-no'>Không</button>
                </form>
            ";
            echo $render;
        }

        private function uploadFailType ()
        {
            $render = "
                <div class='icon-status mt-2 p-5'>     
                    <i class='far fa-times-circle text-danger mb-3'></i></br>
                    <h3 class='text-danger'>Upload file thất bại, <br> Loại file không hợp lệ</h3>
                </div>
                <input type='button' class='btn btn-accept mb-3' data-dismiss='modal' value='Okay'>
            ";
            echo $render;
        }

        private function uploadFailSize ()
        {
            $render = "
                <div class='icon-status mt-2 p-5'>     
                    <i class='far fa-times-circle text-danger mb-3'></i></br>
                    <h3 class='text-danger'>Upload file thất bại<br> Kích thước file quá lớn</h3>
                </div>
                <input type='button' class='btn btn-accept mb-3' data-dismiss='modal' value='Okay'>
            ";
            echo $render;
        }



        private function defaultError ()
        {
            $render = "
                <div class='icon-status mt-2 p-5'>     
                    <i class='far fa-times-circle text-danger mb-3'></i></br>
                    <h3 class='text-danger'>Lỗi hệ thống!</h3>
                </div>
                <input type='button' class='btn btn-accept mb-3' data-dismiss='modal' value='Okay'>
            ";
            echo $render;
        }
    }
?>