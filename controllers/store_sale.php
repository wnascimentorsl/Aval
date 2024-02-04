<?php 
require '../Conexao.php';
require '../functions_db.php';


$db = new Conexao();
$db->setConexao();

$date = date('Y/m/d h:m:s', time());
$quantidadeDeVendas = $_POST['isales_quantity'];
$totalVendas = (float) $_POST['fsales_price'] * (float) $_POST['isales_quantity'];



$sql = "INSERT INTO product_sales (ssales_date, products_id, isales_quantity, fsales_total, fsales_price)  
        VALUES ('{$date}', {$_POST['id']}, {$quantidadeDeVendas}, {$totalVendas}, {$_POST['fsales_price']});";

$updateEstoque = "UPDATE products
                     SET iquantity = iquantity - $quantidadeDeVendas
                   WHERE idproduct = {$_POST['id']};";

$updateValor = "UPDATE products
                   SET iquantity = iquantity - $quantidadeDeVendas,
                       funit_price = $_POST[fsales_price]
                 WHERE idproduct = {$_POST['id']};";



$db->query($sql);

if($_POST['checkbox-venda']){
        $db->query($updateValor);
}

$db->query($updateEstoque);


$db->closeConexao();


header('location: /produtos.php');