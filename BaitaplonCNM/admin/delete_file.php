<?php 
include("../class/clsXuLyFile.php");
$p=new clsXuLyFile();
?>
<?php 
if(isset($_REQUEST['id']))
{
	$layid=$_REQUEST['id'];

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" type="text/css" href="../Font awesome/css/fontawesome.css">
<link rel="stylesheet" type="text/css" href="../Font awesome/css/brands.css">
<link rel="stylesheet" type="text/css" href="../Font awesome/css/regular.css">
<link rel="stylesheet" type="text/css" href="../Font awesome/css/solid.css">
<link rel="stylesheet" type="text/css" href="../Font awesome/css/svg-with-js.css">
<link rel="stylesheet" type="text/css" href="../Font awesome/css/v4-shims.css">
<link rel="stylesheet" type="text/css" href="../Font awesome/css/all.min.css"/>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
<!-- Morris chart -->
<link rel="stylesheet" href="plugins/morris/morris.css">
<!-- jvectormap -->
<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<!-- Date Picker -->
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<script src="../js/jquery-3.6.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/delete.css"/>
</head>

<body>
<div class="container">
	<div class="p-4 form-delete mt-2 text-center">
        <form enctype='multipart/form-data' method='post'>
          <div class='form-group'> 
              <h5>Bạn có chắc chắn xóa sản phẩm này không ?</h5>
          </div>
          <div class='form-group pt-3'>
          <div class='col-sm-12'>
             <input type='submit' name='btndelete' id='btndelete' class='btn btn-primary' value='Có'>
             <input type='submit' name='btndelete' id='btndelete' class='btn btn-danger' value='Không'>
          </div>
        </div>
      </form>
	</div>
    
</div>
<?php
if(isset($_REQUEST['btndelete']))
{
	switch($_REQUEST['btndelete'])
	{
		case 'Có':
		{
			$result=$p->themxoasua("delete from uploadfile where id='$layid'");
			if($result==1)
			{
				echo " <script>alert('Xóa file thành công')</script>;";
				echo '<script language="javascript">
					window.location="./";
						</script>';
			}
			else
			{
				echo " <script>alert('Xóa file thất bại')</script>;";
				echo '<script language="javascript">
					window.location="./";
						</script>';
			}
			break;
		}
		case 'Không':
		{
			echo '<script language="javascript">
						window.location="./";
						</script>';
			break;
		}
	}
}
?>

</body>
</html>