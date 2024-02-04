<?php
session_start();
require '../Conexao.php';
require '../functions_db.php';

if (
    empty($_POST['description']) ||
    empty($_POST['unit_price']) ||
    empty($_POST['quantity']) ||
    empty($_POST['barcode'])
) {
    $_SESSION['_flash'] = 'Por favor preencha todos os campos';
    $_SESSION['_form'] = [
        'description' => $_POST['description'],
        'unit_price' => $_POST['unit_price'],
        'quantity' => $_POST['quantity'],
        'barcode' => $_POST['barcode'],
    ];
    header('location: /form-produto.php');
    exit();
}

$db = new Conexao();
$db->setConexao();

$unitPrice = str_replace(',','.',$_POST['unit_price']);

$description = $_POST['description'];

$sql = "INSERT INTO products (sdescription, funit_price, iquantity, sbarcode)  
VALUES ('{$_POST['description']}', {$unitPrice}, {$_POST['quantity']}, {$_POST['barcode']})";

$db->query($sql);

header('location: /produtos.php');
