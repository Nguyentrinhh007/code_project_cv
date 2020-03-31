<?php
if(!defined('TEMPLATE')){
	die('Bạn không có quyền truy cập vào file này!');
}

// Lấy chuỗi kết nối
$conn= mysqli_connect('localhost', 'root', '','php_k74');
if($conn)
{
    //tránh lỗi tiếng việt khi lấy dữ liêu trong Database
    mysqli_query($conn, "SET NAMES 'utf8'");
}
else
{
    die ('Không thể kết nối với CSDL');
}


// $sql="select * from user";
// // Thực thi câu lệnh 
// $query=mysqli_query($conn,$sql);

// Đếm số bản ghi khi thực thi
// echo mysqli_num_rows($query);
// echo '<hr>';

//Lấy dữ liệu
// while($row=mysqli_fetch_array($query))
// {
//     echo $row['user_id'].$row['user_full'].$row['user_mail'];
//     echo '<hr>';
// }
