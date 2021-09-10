<?php
$arr = array();
$handle = fopen("test.csv", "r");
while (!feof($handle)) {
    $arrOfCSVLine = fgetcsv($handle);
    $articulo = $arrOfCSVLine[1];
    $descripcion = $arrOfCSVLine[2];
    $capitulo = $arrOfCSVLine[3];

    if (!array_key_exists($data, $arr)) {
        $arr[$articulo] = $descripcion;
    } else {
        $arr[$articulo] += $descripcion;
    }
}

echo '<pre>';
print_r($arr);
