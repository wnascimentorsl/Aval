<?php
require '../Conexao.php';


$db = new Conexao();
$db->setConexao();

$unitPrice = str_replace(',', '.', $_POST['unit_price']);

$sql = "INSERT INTO products (sdescription, funit_price, iquantity, sbarcode)  
VALUES ('{$_POST['description']}', {$unitPrice}, {$_POST['quantity']}, {$_POST['barcode']})";

$db->query($sql);

$db->closeConexao();




header('location: /produtos.php');