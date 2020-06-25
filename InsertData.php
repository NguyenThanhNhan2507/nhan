<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>INSERT DATA TO DATABASE</h1>
<h2>Enter data into customers table</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li>Customer ID:</li><li><input type="text" name="customerID" /></li>
<li>Email:</li><li><input type="text" name="Email" /></li>
<li>First Name:</li><li><input type="text" name="FirstName" /></li>
<li>Last Name:</li><li><input type="text" name="LastName" /></li>
<li>Street:</li><li><input type="text" name="Street" /></li>
<li>City:</li><li><input type="text" name="City" /></li>
<li>Phone:</li><li><input type="text" name="Phone" /></li>
<li><input type="submit" /></li>
</form>
</ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-174-129-240-67.compute-1.amazonaws.com;port=5432;user=wrflrxtavasvqh;password=fbfef36049fbd28f1200e3a775a389e014838e86522765e67782f9cf7a3f516b;dbname=d3mmhribgmc6bf",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(CustomerID ,Email ,Password, FirstName,LastName,City,Street,Phone) VALUES('1','nhandaica125@gmail.com' '123456','Nhan','Nguyen','VietNam','Ly Thuong Kiet','09005852221')";
$sql = "INSERT INTO student(CustomerID ,Email ,Password, FirstName,LastName,City,Street,Phone)"
        . " VALUES('$_POST[CustomerID]','$_POST[Email]','$_POST[PassWord]','$_POST[FirstName]','$_POST[LastName]','$_POST[City]','$_POST[Street]','$_POST[Phone]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
$sql = "INSERT INTO `themes` (`theme_id`, `theme_title`)"
    ." VALUES(
(1, 'Words & Phrases'),
(2, 'Love & Romance'),
(3, 'Flowers & Plants'),
(4, 'Trees'),
(5, 'Animals'),
(7, 'Nature & Landscapes'),
(8, 'Tropical'),
(9, 'Music'),
(10, 'Games & Fantasy'),
(11, 'Sports & Fitness'),
(12, 'Cities & Buildings'),
(13, 'Movies & TV'),
(14, 'Stars'),
(15, 'Glowing'),
(16, 'Disney'),
(17, '3D');
)";

 if (is_null($_POST[StudentID])) {
   echo "StudentID must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
