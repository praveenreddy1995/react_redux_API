<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  /* if(trim($request->fname) === '' || (string)$request->lname === '')
  {
    return http_response_code(400);
  } */

  // Sanitize.
	$fname = mysqli_real_escape_string($con, (string)$request->fname);
	$lname = mysqli_real_escape_string($con, (string)$request->lname);
	$email = mysqli_real_escape_string($con, (string)$request->email);
	$phone = mysqli_real_escape_string($con, (string)$request->phone);
	$password = mysqli_real_escape_string($con, (string)$request->password);
	$cpassword = mysqli_real_escape_string($con, (string)$request->cpassword);
	$Question = mysqli_real_escape_string($con, (string)$request->Question);
	$Answer = mysqli_real_escape_string($con, (string)$request->Answer);


  // Create.
  //$sql = "INSERT INTO `react_register`(`id`,`number`,`amount`,`pass`,`dept`) VALUES (null,'{$number}','{$amount}','{$pass}','{$dept}')";
  
 $sql=" INSERT INTO `react_register` (`fname`, `lname`, `email`, `phone`, `password`, `cpassword`, `Question`, `Answer`) VALUES ('{$fname}','{$lname}','{$email}','{$phone}','{$password}','{$cpassword}','{$Question}','{$Answer}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $policy = [
      'fname' => $fname,
      'lname' => $lname,
	  'email' => $email,
	  'phone' => $phone,
	  'password' => $password,
	  'cpassword' => $cpassword,
	  'Question' => $Question,
	  'Answer' => $Answer,
	  
      'id'    => mysqli_insert_id($con)
    ];
	
    echo json_encode($policy);
  }
  else
  {
    http_response_code(422);
  }
}