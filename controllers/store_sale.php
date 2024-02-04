<?php
session_start();
require '../Conexao.php';
require '../functions_db.php';


$db = new Conexao();
$db->setConexao();

$date = date('Y/m/d h:m:s', time());
$quantidadeDeVendas = $_POST['isales_quantity'];
$totalVendas = (float) $_POST['fsales_price'] * (float) $_POST['isales_quantity'];


$quantidade = "SELECT iquantity FROM products where idproduct = {$_POST['id']}";
$db->query($quantidade);
$quantidadeResult = $db->getRowAsArray();


if ($quantidadeDeVendas <= 0) {
        $_SESSION['_flash'] = 'A quantidade da venda precisa ser maior que zero.';
        header("location: /form-venda.php");
        exit();
}

if ($quantidadeResult['iquantity'] < $quantidadeDeVendas) {
        $_SESSION['_flash'] = 'Voce esta vendendo mais itens do que tem em estoque.';
        header("location: /form-venda.php");
        exit();
}


$insertSale = "INSERT INTO product_sales (ssales_date, products_id, isales_quantity, fsales_total, fsales_price)  
        VALUES ('{$date}', {$_POST['id']}, {$quantidadeDeVendas}, {$totalVendas}, {$_POST['fsales_price']});";

/*
Ja que optei por nao usar uma tabela pra fazer o controle de estoque, faço um update na própria 
quantidade de estoque dos itens quando realiza uma venda
*/

$updateEstoque = "UPDATE products
                     SET iquantity = iquantity - $quantidadeDeVendas
                   WHERE idproduct = {$_POST['id']};";


$updateValor = "UPDATE products
                   SET iquantity = iquantity - $quantidadeDeVendas,
                       funit_price = $_POST[fsales_price]
                 WHERE idproduct = {$_POST['id']};";

$db->query($insertSale);

$db->query($_POST['checkbox-venda'] ? $updateValor : $updateEstoque);



header('location: /produtos.php');
