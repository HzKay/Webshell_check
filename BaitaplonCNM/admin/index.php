<?php 
include("../class/clslogin.php");
$p=new dangnhap();
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['ten']) && isset($_SESSION['password']) && isset($_SESSION['phanquyen']))
{
	if($_SESSION['phanquyen']==2)
	{
		$p->confirmlogin($_SESSION['id'],$_SESSION['ten'],$_SESSION['password'],$_SESSION['phanquyen']);
		include_once("../class/clsXuLyFile.php");
		include_once("../class/clsAdmin.php");
		
		$xuLyFile = new clsXuLyFile();
		$admin = new clsAdmin();
	}
	else
	{
		echo '<script language="javascript">
					alert("Bạn không có quyền đăng nhập trang này!");
						</script>';
		echo '<script language="javascript">
				window.location="./login.php";
					</script>';	
    }
    
}
else
{
	header('location:./login.php');
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" type="text/css" href=".././Font_awesome/css/fontawesome.css">
<link rel="stylesheet" type="text/css" href=".././Font_awesome/css/brands.css">
<link rel="stylesheet" type="text/css" href=".././Font_awesome/css/regular.css">
<link rel="stylesheet" type="text/css" href=".././Font_awesome/css/solid.css">
<link rel="stylesheet" type="text/css" href=".././Font_awesome/css/svg-with-js.css">
<link rel="stylesheet" type="text/css" href=".././Font_awesome/css/v4-shims.css">
<link rel="stylesheet" type="text/css" href=".././Font_awesome/css/all.min.css"/>
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
<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body>
	<div class="content-box">
		<div class="row">
			<div class="col-lg-3 content text-center">
				<a href="index.php">
					<div class="logo">
						<i class="fa fa-user-circle user" aria-hidden="true"></i>
						<span class="title">ADMIN</span>
					</div> 
				</a>
			</div>
			<div class="col-lg-9 aside">
				<div class="row">
                    <div class="col-lg-10 col-xs-12 m-2" >
						<div class="search-box pull-right">
							<form action="" method="POST" id="search_mini_form" name="Categories">
								<input type="text" placeholder="Tìm kiếm file" name="txtsearch" id="search" value="<?php if(isset($_REQUEST['content'])) { echo $_REQUEST['content'];}?>">
								<button type="submit" class="search-btn-bg" name="btn" value="search" style="float:right; padding: 12px 40px;"><span class="glyphicon glyphicon-search"><i class="fa fa-search" aria-hidden="true"></i></span></button>
							</form>
							</div>
						</div>
						
						<div class="col-sm-1 col-xs-12">
							<div class="dropdown">
								<button type="button" class="btn user" data-toggle="dropdown">
								<span class="float-right glyphicon glyphicon-search "><i class="fa fa-bars icon-bar"></i></span>
								</button>
								<div class="dropdown-menu dropdown-menu-right mt-2">
									<p class="username text-center"><?php echo $_SESSION['ten']?></p>
									<form action="" method="post">
									<input type="submit" name="btn" class="btn btn-block btn-logout" value="Đăng xuất">
									</form>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 menu p-0">
				<nav>
				<ul id="nav" class="nav nav-pills flex-column" role="tablist"> 
					<li class="nav-item">
						<a href="#dsfile" class="nav-link active" data-toggle="pill"><i class="fa fa-home mr-2" aria-hidden="true"></i>Trang chủ</a>
					</li>
					<li class="nav-item">
						<a href="#tailen" class="nav-link" data-toggle="pill"><i class="fa fa-cog mr-2" aria-hidden="true"></i>Cấu hình</a>
					</li>
				</ul>
				</nav>
			</div>
			<div class="col-lg-9 home pt-2">
			<div class="tab-content">
			  <div id="dsfile" class="container tab-pane active <?php if(isset($_REQUEST['content'])) {echo 'del';}?>">
				<div class="space">
					<h4 class="title-tab">Trang chủ</h4>
					<div class="dashboard-box">
						<div id="dashboard" class="color1">
							<div class="float-left">
								<h2 class="pl-3 pt-2"><?php echo $admin->getOverview("user"); ?></h2>
								<h5 class="pl-3 pt-1">NGƯỜI DÙNG</h5>
							</div>
							<div class="float-right pr-3 pt-3">
								<i class="fa fa-user-plus icon-user" aria-hidden="true"></i>
							</div>
							<form action="" method="post" enctype="multipart/form-data">
							<button type="submit" class="btn btn-load mt-2" value="người dùng" name="btn">Chi tiết <i class="fa fa-plus" aria-hidden="true"></i></button>
							</form>
						</div>
						<div id="dashboard" class="color2">
							<div class="float-left">
								<h2 class="pl-3 pt-2"><?php echo $admin->getOverview("file"); ?></h2>
								<h5 class="pl-3 pt-1">FILE UPLOAD</h5>
							</div>
							<div class="float-right pr-3 pt-3">
							<i class="fa fa-cloud-upload icon-user" aria-hidden="true"></i>
							</div>
							<form action="" method="post" enctype="multipart/form-data">
							<button type="submit" class="btn btn-load mt-2" value="file upload" name="btn">Chi tiết <i class="fa fa-plus" aria-hidden="true"></i></button>
							</form>
						</div>
						<div id="dashboard" class="color3">
							<div class="float-left">
								<h2 class="pl-3 pt-2">
									<?php 
										$totalsize = $admin->getOverview('size'); 
										$totalsize = $admin->showSize($totalsize);
										echo $totalsize;
									?>
								</h2>
								<h5 class="pl-3 pt-1">KÍCH THƯỚC</h5>
							</div>
							<div class="float-right pr-3 pt-3">
							<i class="fa fa-bar-chart icon-user" aria-hidden="true"></i>
							</div>
							<form action="" method="post" enctype="multipart/form-data">
							<button type="submit" class="btn btn-load mt-2" value="kích thước" name="btn">Chi tiết <i class="fa fa-plus" aria-hidden="true"></i></button>
							</form>
						</div>
					</div>
				</div>
				<div class="listFiles">
					<?php
					if(isset($_REQUEST['content']))
					{
						echo "<h4 class='h4 text-center mb-3'>DANH SÁCH FILE</h4>";
						$search = $_REQUEST['content'];
						$url = "http://localhost/Webshell_check/api/timKiem.php?search={$search}&idAccount={$_SESSION['id']}&role={$_SESSION['phanquyen']}";
						$xuLyFile->showFiles($url);
					}
					?>
				</div>
				<div id="showinfo">
					<?php
					if(isset($_REQUEST['btn']))
					{
						switch($_REQUEST['btn'])
						{
							case 'người dùng':
							{
								$url = "http://localhost/Webshell_check/api/getUserList.php?idAccount={$_SESSION['id']}&role={$_SESSION['phanquyen']}";
								$admin->showUserList($url);
								break;
							}
							case 'file upload':
							{
								$url = "http://localhost/Webshell_check/api/xem.php?idAccount={$_SESSION['id']}&role={$_SESSION['phanquyen']}";
								$xuLyFile->showFiles($url);
								break;
							}
							case 'kích thước':
							{
								$url = "http://localhost/Webshell_check/api/xem.php?idAccount={$_SESSION['id']}&role={$_SESSION['phanquyen']}";
								$xuLyFile->showFiles($url);
								break;
							}
							case 'search':
							{
								$searchContent = $_REQUEST['txtsearch'];
								$xuLyFile->changeLocation("index.php?content={$searchContent}");
								break;
							}
							case 'Đăng xuất':
							{
								session_unset();
								session_destroy();
								echo "<script>window.location.replace('login.php')</script>";
							}
						}
					}
					?>
				</div>
			  </div>
			  <div id="tailen" class="container tab-pane fade">
				 <h4 class="title-tab">Cấu hình</h4>
				 <div class="form-cauhinh">
				 <form id="form1" name="form1" method="post" action="">
						<table width="926" border="1" align="center" cellpadding="5" cellspacing="0" class="table table-bordered">
							<tr>
							<td align="left" valign="middle">Kích thước tối đa của file tải lên</td>
							<td align="left" valign="middle"><p>
								<label for="txtdai"></label>
								<input type="text" name="txtdai" id="txtdai" />
								<label for="txtrong"> x </label>
								<input type="text" name="txtrong" id="txtrong" />
							</p>
							<p>
								<input type="checkbox" name="checksize" id="checksize" />
								<label for="checksize"></label>
							Tự động resize ảnh nếu kích thước lớn hơn kích thước tối đa</p></td>
							</tr>
							<tr>
							<td align="left" valign="middle">Dung lượng tối đa của file tải lên:</td>
							<td align="left" valign="middle"><p>
								<label for="txtdungluong"></label>
								<select name="txtdungluong" id="txtdungluong">
								<option value="1">200.00 MB</option>
								<option value="2">150.00 MB</option>
								</select>
							</p>
							<p>(Sever của bạn chỉ cho phép tải file có dụng lượng: 200.00 MB) </p></td>
							</tr>
							<tr>
							<td align="left" valign="middle">Kiểu kiểm tra file tải lên:</td>
							<td align="left" valign="middle"><label for="txtkieufile"></label>
								<select name="txtkieufile" id="txtkieufile">
								<option value="1">Mạnh</option>
								<option value="2">Trung bình</option>
								<option value="3">Yếu</option>
							</select></td>
							</tr>
							<tr>
							<td align="left" valign="middle">Bắt buộc nhập chú thích cho file khi upload</td>
							<td align="left" valign="middle"><input type="checkbox" name="checkcomment" id="checkcomment" />
							<label for="checkcomment"></label></td>
							</tr>
							<tr>
							<td align="left" valign="middle">Tự xác định mô tả từ tên file</td>
							<td align="left" valign="middle"><input type="checkbox" name="checkmotafile" id="checkmotafile" />
							<label for="checkmotafile"></label></td>
							</tr>
							<tr>
							  <td colspan="2" align="center" valign="middle">
								<button type="submit" class="btn btn-setup">Cài đặt</button>
							  </td>
							</tr>
						</table>
					</form>
				 </div>
			  </div>
			</div>
		</div>
		</div>
    </div>
</body>
</html>