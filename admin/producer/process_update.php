<?php  
if (empty($_POST['name']
	|| $_FILES['image']
	|| $_POST['phone']
	|| $_POST['address'])) 
{
	header('location:index.php?empty_update');
	die();
}
$id = $_GET['id'];
$name = $_POST['name'];
$new_image = $_FILES['new_image'];
if ($new_image['size'] > 0) {
	$folder='../../history_image/';
	$file_extension = explode('.', $new_image['name'])[1];
	$file_image_name=time() . '.' . $file_extension;
	$path_file = $folder . $file_image_name;

	move_uploaded_file($new_image["tmp_name"], $path_file);
}else{
	$file_image_name= $_POST['old_image'];
}
$phone = $_POST['phone'];
$address = $_POST['address'];

require '../connect.php';

$query = "update producer 
set
name='$name',
image='$file_image_name',
phone='$phone',
address='$address'
where
id='$id'";

mysqli_query($connect,$query);
// $error= mysqli_error($connect);
// echo $error;
mysqli_close($connect);

header('location:index.php?update');
