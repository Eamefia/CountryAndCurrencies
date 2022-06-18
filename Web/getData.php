<?php

$whereSQL = '';
    if(isset($_POST['keywords'])){ 
        $whereSQL = trim ($_POST["keywords"]);
    } 
     $api_url = "http://localhost/Api/RestApi/testapi.php?action=search_items&wheresql=$whereSQL";
     $client = curl_init($api_url);
     curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
     $response = curl_exec($client);
    $result = json_decode($response);

    $output = "";
    if($result != null)
    {
        if(count($result) > 0)
        {
           foreach($result as $row)
           {
               $output .="
                 <tr>
                 <td>$row->Official_name</td>
                 <td>$row->Currency_Official_name</td>
                 <td>$row->Currency_code</td>
                 <td>$row->Symbols</td>
                </tr>
               ";
           }
        }
    }
    else {
        $output .="
          <tr>
            <td colspan='4' align='center'>No data found</td>
          </tr>
        ";
    }
    echo $output;

?>