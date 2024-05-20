<?php 
    class notionStatus 
    {
        private function showNotion ($mess)
        {
            switch ((int) $mess)
            {
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
                case 2:
                    {
                        $this->delFileSuccess();
                        break;
                    } 
                case -2:
                    {
                        $this->delFileFail();
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
                    <div class='modal-content'>
                    <div class='modal-body text-center'>
                        <div class='icon-status mt-2 p-5'>";
            $this->showNotion($mess);            
            echo "            
                        </div>
                        <input type='button' class='btn btn-accept mb-3' data-dismiss='modal' value='Okay'>
                    </div>
                    </div>
                </div>
            </div>";
        }

        private function uploadSuccess ()
        {
            echo '<i class="far fa-check-circle text-success mb-3"></i></br>';
            echo '<h3 class="text-success">Upload file thành công<h3>';
        }

        private function uploadFail ()
        {
            echo '<i class="far fa-times-circle text-danger mb-3"></i></br>';
            echo '<h3 class="text-danger">Upload file thất bại</h3>';
        }

        private function uploadFileIsWebshell ()
        {
            echo '<i class="far fa-times-circle text-danger mb-3"></i></br>';
            echo '<h3 class="text-danger">Upload file thất bại! </br>File của bạn có thể chứa webshell</h3>';
        }

        private function delFileSuccess ()
        {
            echo '<i class="far fa-check-circle text-success mb-3"></i></br>';
            echo '<h3 class="text-danger">Xoá file thành công!</h3>';
        }

        private function delFileFail ()
        {
            echo '<i class="far fa-times-circle text-danger mb-3"></i></br>';
            echo '<h3 class="text-danger">Xoá file không thành công</h3>';
        }

        private function defaultError ()
        {
            echo '<i class="far fa-times-circle text-danger mb-3"></i></br>';
            echo '<h3 class="text-danger">Lỗi hệ thống!</h3>';
        }
    }
?>