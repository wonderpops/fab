<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    $path = 'storage/';
    $path .= $_POST['path'];

    // $fp = fopen($path, "w");
    // fclose($fp);
    // chmod($file_path, 0777);

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // ini_set('error_reporting', E_ALL);

    function get_file_extension($file_path) {
        $basename = basename($file_path); // получение имени файла
        if ( strrpos($basename, '.')!==false ) { // проверка на наличии в имени файла символа точки
          // вырезаем часть строки после последнего символа точки в имени файла
          $file_extension = substr($basename, strrpos($basename, '.') + 1);
        } else {
          // в случае отсутствия символа точки в имени файла возвращаем false
          $file_extension = false;
        }
        return $file_extension;
    }

    $ex = get_file_extension($path);
    // magick uploads/pJzflA3YNLPmCyWg3xltqamNd4OCo8AAk2J2BQPn.png -gravity center -extent 1:1 uploads/pJzflA3YNLPmCyWg3xltqamNd4OCo8AAk2J2BQPn.png
    if ($ex == 'jpeg'){
        $im = imagecreatefromjpeg($path);
        $size = min(imagesx($im), imagesy($im));
        if (imagesx($im) >= imagesy($im)){
            $x_offset = (imagesx($im) - imagesy($im)*4/3) / 2;
            $y_offset = 0;
            $im2 = imagecrop($im, ['x' => $x_offset, 'y' => $y_offset, 'width' => imagesy($im)*4/3, 'height' => imagesy($im)]);
            if ($im2 !== FALSE) {
                imagejpeg($im2, $path);
                imagedestroy($im2);
            }
            imagedestroy($im);
        } else {
            $x_offset = 0;
            $y_offset = (imagesy($im) - imagesx($im)*3/4) / 2;
            $im2 = imagecrop($im, ['x' => $x_offset, 'y' => $y_offset, 'width' => imagesx($im), 'height' => imagesx($im)*3/4]);
            if ($im2 !== FALSE) {
                imagejpeg($im2, $path);
                imagedestroy($im2);
            }
            imagedestroy($im);
        }
    } else if ($ex == 'png') {
        $im = imagecreatefrompng($path);
        $size = min(imagesx($im), imagesy($im));
        if (imagesx($im) >= imagesy($im)){
            $x_offset = (imagesx($im) - imagesy($im)*4/3) / 2;
            $y_offset = 0;
            $im2 = imagecrop($im, ['x' => $x_offset, 'y' => $y_offset, 'width' => imagesy($im)*4/3, 'height' => imagesy($im)]);
            if ($im2 !== FALSE) {
                imagejpeg($im2, $path);
                imagedestroy($im2);
            }
            imagedestroy($im);
        } else {
            $x_offset = 0;
            $y_offset = (imagesy($im) - imagesx($im)*3/4) / 2;
            $im2 = imagecrop($im, ['x' => $x_offset, 'y' => $y_offset, 'width' => imagesx($im), 'height' => imagesx($im)*3/4]);
            if ($im2 !== FALSE) {
                imagepng($im2, $path);
                imagedestroy($im2);
            }
            imagedestroy($im);
        }

    }
    
    echo json_encode($ex);
?>