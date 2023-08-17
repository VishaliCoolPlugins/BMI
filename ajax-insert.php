<?php
 $age = $_POST["age"];
 $feet = $_POST["feet"];
 $inches = $_POST["inches"];
 $weight = $_POST["weight"];
 $result = $_POST["result"];
 $conn = mysqli_connect("localhost","root","","BMI") or die("connection fail");
 $sql = "INSERT INTO `bmi_table`(`Age`, `Feet`, `Inches`, `Weight`, `Result`) VALUES ('$age','$feet','$inches','$weight','$result')";
 //$query = mysqli_query($conn,$sql) or die("SQL Query failed");
 if(mysqli_query($conn,$sql)){
    echo 1;
 }else{
    echo 0;
 }
?>