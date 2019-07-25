<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if(trim($request->number) === '' || (string)$request->amount < 0)
  {
    return http_response_code(400);
  }

  // Sanitize.
  $number = mysqli_real_escape_string($con, trim($request->number));
  $amount = mysqli_real_escape_string($con, (string)$request->amount);
   $pass = mysqli_real_escape_string($con, (string)$request->pass);
   $dept = mysqli_real_escape_string($con, (string)$request->dept);


  // Create.
  $sql = "INSERT INTO `policies`(`id`,`number`,`amount`,`pass`,`dept`) VALUES (null,'{$number}','{$amount}','{$pass}','{$dept}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $policy = [
      'number' => $number,
      'amount' => $amount,
	  'dept' => $dept,
	  'pass' => $pass,
	  
      'id'    => mysqli_insert_id($con)
    ];
    echo json_encode($policy);
  }
  else
  {
    http_response_code(422);
  }
}