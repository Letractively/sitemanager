<?php

define('DEBUG', true);

function recursive_unserialize_replace($data, $key = null) {
    $stringToFix=$data[3];
    if (is_string($stringToFix) && ( $unserialized = @unserialize($stringToFix) ) === false) {
        $stringToFix = str_replace("'", "\'", html_entity_decode($stringToFix, ENT_QUOTES, 'UTF-8'));
        $stringToFix = preg_replace_callback('/s:(\d+):"(.*?)";/', function ($match) {
            $temp = intval(strlen($match[2]));
            $result = 's:' . $temp . ':"' . $match[2] . '";';
            return $result;
        }, $stringToFix);
    }
    if (DEBUG && ( $unserialized = @unserialize($stringToFix) ) === false) {
        echo $data . "</br>";
    }
    $result = "(".$data[1].",'theme_mods_arras".$data[2]."','".$stringToFix."','".$data[4]."')";
    return $result;
}

$content = "(1303,'theme_mods_arras.1.5.3-child/arras','a:8:{i:0;b:0;s:16:\"background_image\";s:73:\"http://www.latuaformafisica.it/wp-content/uploads/2014/07/VERDEDX3.jpg\";s:22:\"background_image_thumb\";s:81:\"http://www.latuaformafisica.it/wp-content/uploads/2014/07/VERDEDX3-150x150.jpg\";s:17:\"background_repeat\";s:9:\"no-repeat\";s:21:\"background_position_x\";s:6:\"center\";s:21:\"background_attachment\";s:5:\"fixed\";s:16:\"background_color\";s:0:\"\";s:18:\"nav_menu_locations\";a:1:{s:9:\"main-menu\";i:6;}}','yes'),";
echo $content;
echo "<br><br><br>";
$pattern = "/\((\d+)\s?,\s?'theme_mods_arras(.+?)'\s?,\s?'(.+?)'\s?,\s?'(...?)'\s?\)/";
$replacer = preg_replace_callback($pattern, "recursive_unserialize_replace", $content);
echo $replacer;
?>
