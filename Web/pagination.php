<?php

     $id = 0;
     if(isset($_POST["id"])){
         $id = $_POST["id"];
     }else{
         $id = 1;
     }
     $api_url = "http://localhost/Api/RestApi/testapi.php?action=fetch_page&id=".$id."";
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