<?php
session_start();
 include("../RestApi/Api.php");
 $insert_file = new Api();


        if(isset($_POST['import'])){
            //check if input file is empty
            if(!empty($_FILES['file']['name'])){
                $filename = $_FILES['file']['tmp_name'];
                $fileinfo = pathinfo($_FILES['file']['name']);
     
                //check file extension
                if(strtolower($fileinfo['extension']) == 'csv'){

                    //check if file contains data
                    if($_FILES['file']['size'] > 0){
     
                        $file = fopen($filename, 'r');

                        fgets($file);
                        
                        // call insert_currency fuction
                        $insert_file->insert_currency($file);
                        header('location: viewData.php');
                    }
                    else{
                        $_SESSION['message'] = "File contains empty data";
                        header('location: Currencies.php');
                    }
                }
                else{
                    $_SESSION['message'] = "Please upload CSV files only";
                    header('location: Currencies.php');
                }
            }
            else{
                $_SESSION['message'] = "File empty";
                header('location: index.php');
            }
     
        }
     
        else{
            $_SESSION['message'] = "Please import a file first";
            header('location: Currencies.php');
        }
