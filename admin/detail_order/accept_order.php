<?php 
session_start();
$id_serve = $_SESSION['id'];
$id_order = $_GET['id'];
$status = 0;
require '../connect.php';
$query = "
insert into bill(id_serve, id_order) 
values ('$id_serve', '$id_order')";
mysqli_query($connect,$query);

$query = "
update `order` 
set status='1'
where id= '$id_order'";
mysqli_query($connect,$query);

$error= mysqli_error($connect);
if ($error){
	mysqli_close($connect);
	header('location:index.php?error_insert');
	die();
}
else{ 
	mysqli_close($connect);
	header('location:../bill/index.php?insert');
}