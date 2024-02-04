<?php

require '../Conexao.php';


    $db = new Conexao();
    $db->setConexao();

    $sql = "UPDATE products
            SET idelete = 1 
             WHERE idproduct = {$_GET['id']}";

    $db->query($sql);

    $db->closeConexao();



header('Location: /produtos.php');
