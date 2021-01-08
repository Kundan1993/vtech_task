<?php  
// print_r($_POST);
$connect = mysqli_connect('localhost', 'root', 'welcome', 'task_vtech');
$name = $_POST["name"];
$email = $_POST["email"];
$mobile = $_POST["mbl"];

$sql = "INSERT INTO users(name,email,mobile) VALUES ('{$name}','{$email}','{$mobile}')";
if(mysqli_query($connect, $sql)){
    echo "Added successfully";
}else{
    echo "Failed to add user";
}
?>