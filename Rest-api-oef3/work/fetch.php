<?php
//Get data
$api_url = "http://localhost/Rest-api-oef3/api/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);
$output = '';

if(($result) != "")
{
  foreach($result as $row){
    $output .= '
<tr>
<td>' .$row->first_name.'</td>
<td>' .$row->last_name.'</td>
<td><button type="button" name="edit"
class="btn btn-warning btn-xs edit"
id="'.$row->Id.'">Edit</button></td>
   <td><button type="button" name="delete"
   class="btn btn-danger btn-xs delete"
   id="'.$row->Id.'">Delete</button></td>
</tr>';
  }
}else{
  $output .= '
<tr>
<td colspan="4" align="center">No Data Found</td>
</tr>
  ';
}

echo $output;
echo $result;

 ?>
