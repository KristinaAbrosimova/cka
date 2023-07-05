<?php

/**
 * Скачивает файл с текущего сервера
 * 
 * @param string $path Путь к файлу
 * @param string $filename Алиас файла
 * @param int $filesize Размер файла в байтах
 * @param array $headers Дополнительные заголовки для ответа
 * 
 * @return void
 */

include_once("config.php");
include_once("db_connect.php");
function downloadFile($path, $filename, $filesize = null, $headers = array()){

    $file = fopen($path, 'rb');

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$filename.'"');

    if(isset($filesize)){
        header('Content-Length: ' . $filesize);
    }

    foreach ($headers as $value) {
        header($value);
    }

    fpassthru($file);
    fclose($file);
}

$query = "SELECT `name_file` FROM `Form` WHERE id = ".$_GET['id'];
$res_query = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($res_query);


$path = '/var/www/u0941340/data/www/dev.rea.hrel.ru/AKB/form/upload/'.$row['name_file'];
$filename = $row['name_file'];
$filesize = filesize($path);

$headers = array(
    'Cache-Control: no-cache, no-store, must-revalidate', // HTTP 1.1
    'Pragma: no-cache', // HTTP 1.0
    'Expires: 0' // Прокси
);
downloadFile($path, $filename, $filesize, $headers);
