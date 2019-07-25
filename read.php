<?php
/**
 * Returns the list of policies.
 */
require 'database.php';

$policies = [];
$sql = "SELECT * FROM react_register";

if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['email']    = $row['email'];
    $policies[$i]['password'] = $row['password'];
    $policies[$i]['phone'] = $row['phone'];
    $i++;
  }

  echo json_encode($policies);
}
else
{
  http_response_code(404);
}