<?php
$user_name = addslashes($_POST['user_name']);
$first_name = addslashes($_POST['first_name']);
$last_name = addslashes($_POST['last_name']);
$gender = addslashes($_POST['gender']);
$birth = date('Y-m-d', strtotime($_POST['birth']));
$phone = addslashes($_POST['phone']);
$email = addslashes($_POST['email']);
$password = addslashes($_POST['password']);
    // chưa thêm trường address

        // liên kết file đến database
require './admin/connect.php';

        // đếm xem đã xuất hiện username email hay phone number chưa
$sql = "select count(*) from customer
where user_name = '$user_name' and email = '$email' and phonenumber = '$phonenumber'";
$result = mysqli_query($connect, $sql);
$number_rows = mysqli_fetch_array($result)['count(*)'];

if ($number_rows == 1) { 
    header("location:login_register.php?error");
    exit;
}


        // lấy dữ liệu từ form hiển thị bảng trên DB
$sql = "insert into customer(user_name,first_name,last_name,gender,birth,phone,address,email,password)
values ('$user_name','$first_name','$last_name','$gender','$birth','$phone','$address','$email','$password')" ;
mysqli_query($connect,$sql);


        // tạo session lưu lại tên người đăng Nhập
$sql = "select id from customer
where username = '$username' and email = '$email' and phonenumber = '$phonenumber'" ;
$result = mysqli_query($connect,$sql);
        $id = mysqli_fetch_array($result)['id']; // lỗi ở đây, khồng hiểu sao lỗi mặc dù làm giống y hệt Anh Long
        session_start();
        // lưu lại id gồm(username, email, phonmenumber) và tên sau
        $_SESSION['id'] = $id;
        $_SESSION['user_name'] = $user_name;
        header("location:login_register.php");
        // đóng kết nối sau xử lý
        mysqli_close($connect);





