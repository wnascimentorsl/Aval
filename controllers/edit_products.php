<?php

require '../Conexao.php';
    session_start();


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

    $db->closeConexao();

    $_SESSION['flash'] = 'Produto atualizado com sucesso';

header('Location: /produtos.php');
