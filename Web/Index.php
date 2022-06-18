<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>myShop</title>

    <!--bootstrapCDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
     

     <?php
         session_start();
       ?>

    <!-- Custom CSS style -->
    <style>
        .wrapper{
            width: 50vw;
            height: 50vh;
            display: flex;
            position:absolute;
            top: 25%;
            left: 25%;
        }
        .wrapper-form{
            padding: 50px 40px;
            border-radius: 10px;
            box-shadow: 10px 10px 10px 10px rgba(44, 38, 41, 0.1);
        }
    </style>


</head>
<body>
<h3 class="container mt-5" style="text-align:center;color:grey">Upload Country Details CSV File</h3>
<div class="wrapper">
<div class="container wrapper-form">
    <form action="UploadCsv.php" method="POST" enctype="multipart/form-data">
       <input class="form-control" type="file" id="formFile" name="file">
       <button class="btn btn-outline-primary mt-3 mb-3" type="submit" name="import">Submit</button>
    </form>
    <div style="text-align:center">
         <h5 style="color:grey">View Data if database already exist</h5>
         <div class="btn btn-outline-primary mt-3 mb-3">
             <a href="viewData.php">View Data</a>
         </div>
     </div>
</div>
</div>
</body>


