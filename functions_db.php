<?php

require 'Conexao.php';


function getConnection()
{
    $db = new Conexao();
    $db->setConexao();
    return $db;
}

function getProduct($id)
{
    $db = getConnection();
    $db->query("SELECT *
                  FROM products p
             LEFT JOIN product_sales ps
                    ON ps.products_id = p.idproduct
                 WHERE idproduct = {$id}
                   AND idelete = 0;");
    return $db->getRowAsArray();
    
}


function getProductList()
{
    $db = getConnection();
    $db->query("SELECT idproduct,
                       sdescription,
                       funit_price,
                       fsales_price,
                       iquantity,
                       max(ssales_date) AS last_sale,
                       (SELECT count(1) 
                          FROM product_sales ps1 
                         WHERE ps1.products_id = ps.products_id) AS count_sale
                  FROM products p
                  LEFT JOIN product_sales ps
                    ON p.idproduct = ps.products_id
                 WHERE idelete = 0
                 GROUP BY 1, 2, 3,4 
                 ORDER BY 1 DESC;");
    return $db->getArrayResults();
}

function countProducts()
{
    $db = getConnection();
    $db->query("SELECT count(1) 
                  FROM products 
                 WHERE idelete = 0;");
    return $db->getRowAsArray();
}

function countSalesProducts()
{
    $db = getConnection();
    $db->query("SELECT count(1) 
                  FROM products p
                  JOIN product_sales ps
                    on ps.products_id = p.idproduct;");
    return $db->getRowAsArray();
}


function getProductDeletetList()
{
    $db = getConnection();
    $db->query("SELECT *
                  FROM products 
                 WHERE idelete = 1;");
    return $db->getArrayResults();
}

function getSoldProductList()
{
    $db = getConnection();
    $db->query("SELECT *
                  FROM products p
                  JOIN product_sales ps
                    ON ps.products_id = p.idproduct
                WHERE idelete = 0 
                 ORDER BY idsales DESC;");
    return $db->getArrayResults();
}



function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

