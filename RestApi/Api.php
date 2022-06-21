<?php

class API
{
    private $connect = '';

    function __construct()
    {
        $this->database_connection();
    }

    function database_connection()
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=country_currency", "root", "");
    }

    function fetch_all()
    {
        $limit = 10;
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $start = ($page - 1)* $limit;
        $query = "SELECT items.Official_name, items.Currency_code, currencies.Symbols, currencies.Currency_Official_name FROM items, currencies 
        WHERE items.Currency_code=currencies.Iso_code LIMIT $start, $limit";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
    }


    function fetch_all_currencies()
    {
        $limit = 100;
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $start = ($page - 1)* $limit;
        $query = "SELECT * FROM currencies LIMIT $start, $limit";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
    }
	
	function fetch_page($id)
    {
        $limit = 10;
        $start = ($id - 1)* $limit;
        $query = "SELECT items.Official_name, items.Currency_code, currencies.Symbols, currencies.Currency_Official_name FROM items, currencies 
        WHERE items.Currency_code=currencies.Iso_code LIMIT $start, $limit";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
    }


    function search_items($wheresgl)
{
    $limit = 10;
    $query = "SELECT * FROM items, currencies 
        WHERE(items.Official_name LIKE '%$wheresgl%' OR currencies.Currency_Official_name LIKE '%$wheresgl%'
         OR currencies.Symbols LIKE '%$wheresgl%') AND(items.Currency_code=currencies.Iso_code) LIMIT 1, $limit";
    $statement = $this->connect->prepare($query);
    if($statement->execute())
    {
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = $row;
        }
        return $data;
    }
}

    function insert_currency($file)
    {
        while(($impData = fgetcsv($file, 1000, ',')) !== FALSE){
            $query = "INSERT INTO currencies (Iso_code, Iso_numeric_code, Common_name, Currency_Official_name, Symbols)
            VALUES ('".$impData[0]."', '".$impData[1]."', '".$impData[2]."', '".$impData[3]."', '".$impData[4]."')";
            $statement = $this->connect->prepare($query);

            if($statement->execute()){
                $_SESSION['message'] = "Data imported successfully";
            }
            else{
                $_SESSION['message'] = "Cannot import data. Something went wrong";
            }
        }
        header('location: ../Web/viewData.php');
    }
	
	function insert_country($file)
    {
        while(($impData = fgetcsv($file, 1000, ',')) !== FALSE){
            $query = "INSERT INTO items (Continent, Currency_code, Iso2_code, Iso3_code, Iso_numerals, Fibs_code, Calling_code, Common_name, Official_name, Endonym, Demonym) 
            VALUES ('".$impData[0]."', '".$impData[1]."', '".$impData[2]."', '".$impData[3]."', '".$impData[4]."', '".$impData[5]."', '".$impData[6]."', '".$impData[7]."', '".$impData[8]."', '".$impData[9]."', '".$impData[10]."')";
            $statement = $this->connect->prepare($query);
     
            if($statement->execute()){
                $_SESSION['message'] = "Data imported successfully";
            }
            else{
                $_SESSION['message'] = "Cannot import data. Something went wrong";
            }
        }
        header('location: ../Web/Currencies.php');
    }
}