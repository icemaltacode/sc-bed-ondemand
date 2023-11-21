<?php
require 'DBConnect.php';
$conn = DBConnect::getInstance()->getConnection();

$sql = "SELECT COUNT(Product.id) AS prodCount FROM Product";
$sth = $conn->prepare($sql);
$sth->execute();
$result = $sth->fetch(PDO::FETCH_OBJ);
printf('<p>We have %d courses currently available.</p>', $result->prodCount);
echo "<p>View our <a href='short.php'>short</a> or <a href='long.php'>long</a> courses</p>.";

// try {
//     $dbh = new PDO("mysql:host=localhost;dbname=ShoppingCart", "root", "root", array(PDO::ATTR_PERSISTENT => true));

//     //var_dump($sth->fetchAll());

//     //var_dump($sth->fetchAll(PDO::FETCH_ASSOC));

//     //var_dump($sth->fetchAll(PDO::FETCH_OBJ));

//     //var_dump($sth->fetchAll(PDO::FETCH_COLUMN, 2));

//     // class Product {
//     //     public $id;
//     //     public $name;
//     //     public $price;
//     //     public $description;
//     //     public $featuredImage;
//     //     public $requiresDeposit;
//     // }

//     // var_dump($sth->fetchAll(PDO::FETCH_CLASS, "Product"));

//     // function product($id, $name, $price, $description, $featuredImage, $requiresDeposit) {
//     //     return sprintf("Product (%d) %s costing €%.2f: %s... Featured Image: %s. %s", 
//     //     $id, $name, $price, substr($description, 0, 10), $featuredImage, $requiresDeposit ? 'This product requires a deposit' : '');
//     // }
//     //var_dump($sth->fetchAll(PDO::FETCH_FUNC, "product"));

//     // foreach($dbh->query("SELECT * FROM Product", PDO::FETCH_OBJ) as $row) {
//     //     echo "<p>{$row->name}</p>";
//     // }

//     // $sql = 'SELECT * FROM Product WHERE Product.price < :price AND Product.requiresDeposit = :deposit';
//     // $sth = $dbh->prepare($sql);
//     // $sth->execute(['price'=>100, 'deposit'=>false]);

//     // $sql = 'SELECT * FROM Product WHERE Product.price < ? AND Product.requiresDeposit = ?';
//     // $sth = $dbh->prepare($sql);
//     // $sth->execute([100, false]);
//     // $result = $sth->fetchAll(PDO::FETCH_OBJ);


//     // $sql = 'SELECT * FROM Product WHERE Product.price < :price AND Product.requiresDeposit = :deposit';
//     // $sth = $dbh->prepare($sql);
//     // $sth->bindValue('price', 100);
//     // $sth->bindValue('deposit', false);
//     // $sth->execute();
//     // $result = $sth->fetchAll(PDO::FETCH_OBJ);

//     // $sql = 'SELECT * FROM Product WHERE Product.price < ? AND Product.requiresDeposit = ?';
//     // $sth = $dbh->prepare($sql);
//     // $sth->bindValue(1, 100);
//     // $sth->bindValue(2, false);
//     // $sth->execute();
//     // $result = $sth->fetchAll(PDO::FETCH_OBJ);

//     // foreach( $result as $row ) {
//     //     printf('<p>%s (€%.2f)</p>', $row->name, $row->price);
//     // }

//     // $sql = 'SELECT Product.name, Product.price, Product.requiresDeposit FROM Product';
//     // $sth = $dbh->prepare($sql);
//     // $sth->execute();
//     // $sth->bindColumn(1, $name);
//     // $sth->bindColumn('price', $price);
//     // $sth->bindColumn('requiresDeposit', $requiresDeposit);

//     // while($sth->fetch(PDO::FETCH_BOUND)) {
//     //     printf('<p>%s (€%.2f) Deposit: %s', $name, $price, $requiresDeposit ? 'Yes' : 'No');
//     // }

//     // $sql = 'SELECT * FROM Product WHERE Product.price = :price';
//     // $sth = $dbh->prepare($sql);

//     // $price = 90;
//     // $sth->bindParam('price', $price);
//     // $sth->execute();
//     // $result = $sth->fetchAll(PDO::FETCH_OBJ);
//     // foreach ($result as $row) {
//     //     printf('<p>Product: %s, Price: €: %.2f', $row->name, $row->price);
//     // }

//     // $price = 360;
//     // $sth->execute();
//     // $result = $sth->fetchAll(PDO::FETCH_OBJ);
//     // foreach ($result as $row) {
//     //     printf('<p>Product: %s, Price: €: %.2f', $row->name, $row->price);
//     // }

//     // $sql = 'INSERT INTO Product(name, price, description, featuredImage, requiresDeposit) VALUES 
//     // (:name, :price, :description, :featuredImage, :requiresDeposit)';
//     // $sth = $dbh->prepare($sql);
//     // $sth->bindValue('name', 'My New Product');
//     // $sth->bindValue('price', 100);
//     // $sth->bindValue('description', 'This is some new product');
//     // $sth->bindValue('featuredImage', 'some_image.png');
//     // $sth->bindValue('requiresDeposit', false, PDO::PARAM_BOOL);
//     // $sth->execute();
//     // printf('<p>%d rows inserted into database</p>', $sth->rowCount());

//     // $sql = 'UPDATE Product SET Product.price = :price WHERE Product.id = :id';
//     // $sth = $dbh->prepare($sql);
//     // $sth->execute(['price' => 90, 'id' => 5]);
//     // printf('<p>%d rows updated in database</p>', $sth->rowCount());

//     // $sql = 'DELETE FROM Product WHERE Product.id >= :id';
//     // $sth = $dbh->prepare($sql);
//     // $sth->execute(['id' => 5]);
//     // printf('<p>%d rows updated in database</p>', $sth->rowCount());





// } catch (PDOException $e) {
//     echo $e->getMessage();
// }