<?php
    session_start();
    if(!isset($_SESSION['dang-nhap'])){
        header('location: login.php');
    }
    
	if(isset($_POST['logout'])){
		unset($_SESSION['dang-nhap']);
		header('location:login.php');
	}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="script/script.js"></script>
    <script src="script/ckeditor/ckeditor.js"></script>
    <script src="script/jquery-3.5.1.min.js"></script>
</head>
<body>
    <?php
        include('modules/config.php');
        include('modules/header.php');
        include('modules/sidebar.php');
        include('modules/menu.php');
        include('modules/content.php');
        include('modules/footer.php');
    ?>
    
</body>
</html>