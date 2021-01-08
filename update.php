
<?php  
$connect = mysqli_connect('localhost', 'root', 'welcome', 'task_vtech');

$input = filter_input_array(INPUT_POST);

$name = mysqli_real_escape_string($connect, $input["name"]);
$email = mysqli_real_escape_string($connect, $input["email"]);
$mobile = mysqli_real_escape_string($connect, $input["mobile"]);

if($input["action"] === 'edit'){
 $sql = " UPDATE users SET name = '".$name."',email = '".$email."', mobile = '".$mobile."' WHERE id = '".$input["id"]."' ";
 mysqli_query($connect, $sql);

}
if($input["action"] === 'delete'){
 $sql = "DELETE FROM users  WHERE id = '".$input["id"]."' ";
 mysqli_query($connect, $sql);
}

echo json_encode($input);

?>
