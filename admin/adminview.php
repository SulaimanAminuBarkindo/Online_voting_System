<?php
require "connection.php";
if(isset($_GET['id'])){
$id = mysqli_real_escape_string($conn,$_GET['id']);
$opr = mysqli_real_escape_string($conn,$_GET['opr']);
if($opr=='delm'){
$sql_del = "DELETE FROM nacoss WHERE studentid = ?;";
}else {
	if($opr=='delcont') {
$sql_del = "DELETE FROM contestants WHERE studentid = ?;";
}
}
$stmt_del = mysqli_stmt_init($conn);
$stmt_del->prepare($sql_del);
$stmt_del->bind_param('s',$id);
$stmt_del->execute();
}
?>

<html>
	<head>
		<title>ADMIN VIEW</title>
			<h1><font class="id-style"><b class="csd">Computer Science Department Admin Panel</b><tt>Welcome:<?php echo $_SESSION['admin_name'];?></font></tt><a href="logout1.php" class="logout-style">
		<input type="submit" class="logout-bottom" name="submit"value="Logout"></a></h1>
			<link rel="shortcut icon" href="images/nacos.jpg">
			<link href="adminview.css" rel="stylesheet" type="text/css">
	</head>

<body bgcolor="lightgrey">

<font size="5" color="darkblue">
<?php require "voterstable.php";?>
<?php require "contestanttable.php";?>

</body>
</html>
