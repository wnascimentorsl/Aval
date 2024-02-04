<?php
session_start();

require '../Conexao.php';

if (
    empty($_POST['description']) ||
    empty($_POST['unit_price']) ||
    empty($_POST['quantity']) ||
    empty($_POST['barcode'])
) {
    $_SESSION['_flash'] = 'Por favor preencha todos os campos';
    $_SESSION['_form'] = [
        'description' => $_POST['description'] ?? '',
        'unit_price' => $_POST['unit_price'] ?? '',
        'quantity' => $_POST['quantity'] ?? '',
        'barcode' => $_POST['barcode'] ?? '',
    ];
    header("location: /form-produto-edit.php?id={$_POST['id']}");
    exit();
}

$db = new Conexao();
$db->setConexao();

$unitPrice = str_replace(',', '.', $_POST['unit_price']);

$sql = "UPDATE products 
               SET sdescription = '{$_POST['description']}',  
                   funit_price = $unitPrice,
                   iquantity = {$_POST['quantity']},
                   sbarcode = {$_POST['barcode']}
             WHERE idproduct = {$_POST['id']}";

$db->query($sql);
$_SESSION['_flash'] = 'Produto atualizado com sucesso';

header('Location: /produtos.php');
