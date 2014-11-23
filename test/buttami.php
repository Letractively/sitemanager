<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
<head>

  <meta charset="utf-8">
      </head>
    <body>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('xdebug.var_display_max_depth', 20);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

$obj2='a:3:{s:4:"meta";a:1:{s:7:"version";s:3:"1.0";}s:13:"main_settings";a:10:{s:12:"mi_look_feel";a:5:{s:11:"color_sheme";s:10:"green-blue";s:7:"mi_logo";s:77:"http://www.asili-nido-roma.com/wp-content/uploads/2012/07/asili-nido-roma.png";s:10:"logo_width";s:0:"";s:11:"logo_height";s:0:"";s:10:"mi_favicon";s:77:"http://anteprimasito.info/asilonido/wp-content/themes/kids/images/favicon.png";}s:7:"mi_blog";a:4:{s:19:"mi_blog_meta_switch";s:2:"on";s:8:"readmore";s:12:"Leggi di piu";s:15:"comments_switch";s:3:"off";s:9:"hide_cats";a:1:{i:0;i:0;}}s:9:"mi_header";a:6:{s:13:"teaser_switch";s:2:"on";s:18:"breadcrumbs_switch";s:3:"off";s:24:"bread_crumbs_text_switch";s:3:"off";s:15:"scroller_switch";s:2:"on";s:14:"scroller_title";s:4:"MENU";s:17:"scroller_category";s:1:"1";}s:9:"mi_footer";a:8:{s:19:"mi_copyright_switch";s:2:"on";s:12:"mi_copyright";s:781:"<a href=\"http://www.asili-nido-roma.com/asili-nidi-privati-roma/\">Asili nidi privati Roma</a>, <a href=\"http://anteprimasito.info/asilonido/asili-nido-iv-municipio-roma/\">Asili nido iv municipio Roma</a>, <a href=\"http://anteprimasito.info/asilonido/asili-nido-privati-roma/\">Asili nido privati Roma</a>, <a href=\"http://anteprimasito.info/asilonido/asili-nido-roma/\">Asili nido Roma</a>, <a href=\"http://anteprimasito.info/asilonido/asilo-nido-bilingue-roma/\">Asilo nido bilingue Roma</a><br><a href=\"http://anteprimasito.info/asilonido/asilo-nido-privato-roma/\">Asilo nido privato Roma</a>, <a href=\"http://anteprimasito.info/asilonido/asilo-nido-roma/\">Asilo nido Roma</a>, <a href=\"http://anteprimasito.info/asilonido/asilo-privato-roma/\">Asilo privato Roma</a>";s:15:"mi_terms_switch";s:2:"on";s:8:"mi_terms";s:0:"";s:24:"mi_copyright_link_switch";s:2:"on";s:17:"mi_copyright_link";s:0:"";s:17:"mi_sitemap_switch";s:3:"off";s:15:"mi_sitemap_link";s:0:"";}s:7:"mi_home";a:5:{s:18:"slider_hide_switch";s:3:"off";s:23:"featured_section_switch";s:2:"on";s:30:"featured_section_widget_switch";s:2:"on";s:21:"featured_section_post";s:3:"771";s:24:"content_section_category";s:1:"1";}s:8:"mi_gmaps";a:4:{s:15:"mi_gmaps_switch";s:3:"off";s:13:"mi_gmaps_zoom";s:2:"16";s:12:"mi_gmaps_lat";s:0:"";s:13:"mi_gmaps_long";s:0:"";}s:10:"mi_contact";a:11:{s:5:"email";s:19:"info@babysplanet.it";s:3:"tel";s:15:"+39 06 87201218";s:3:"fax";s:15:"+39 06 87236497";s:7:"address";s:52:"via Roberto Bracco 8, 00137 Roma (quartiere Talenti)";s:11:"form_switch";s:2:"on";s:17:"switch_auto_reply";s:3:"off";s:13:"email_subject";s:0:"";s:17:"email_sender_name";s:0:"";s:18:"email_contact_form";s:19:"info@babysplanet.it";s:10:"intro_text";s:0:"";s:8:"auto_msg";s:158:"Gentili Signore e Signori,

Abbiamo ricevuto il tuo messaggio. Questa è una risposta automatica messaggio di posta elettronica. Si prega di non rispondere.";}s:9:"mi_social";a:9:{s:6:"switch";s:2:"on";s:5:"title";s:0:"";s:8:"facebook";s:0:"";s:7:"twitter";s:0:"";s:10:"googleplus";s:0:"";s:9:"pinterest";s:0:"";s:7:"youtube";s:0:"";s:8:"linkedin";s:0:"";s:3:"rss";s:0:"";}s:19:"mi_google_analitics";a:2:{s:23:"google_analitics_switch";s:3:"off";s:16:"google_analitics";s:0:"";}s:7:"mi_misc";a:3:{s:13:"mi_custom_css";s:0:"";s:12:"mi_custom_js";s:0:"";s:6:"mi_404";s:95:"Ooops. Something went wrong. Requested page does not exists. Make sure you entered correct URL.";}}s:11:"collections";a:1:{s:7:"sliders";a:1:{s:4:"data";a:3:{s:8:"incommon";a:2:{s:11:"slider_name";s:11:"Slider Name";s:11:"slider_type";s:12:"cycle_slider";}s:8:"settings";a:9:{s:14:"has_pagination";s:2:"on";s:8:"autostop";s:3:"off";s:13:"autostopCount";s:1:"0";s:5:"delay";s:5:"-4000";s:2:"fx";s:4:"fade";s:6:"easing";s:6:"jswing";s:5:"pause";s:2:"on";s:5:"speed";s:4:"1000";s:7:"timeout";s:3:"500";}s:9:"item_data";a:2:{i:0;a:2:{s:10:"slide_name";s:7:"slide 2";s:9:"slide_url";s:82:"http://www.asili-nido-roma.com/wp-content/uploads/2014/11/nido_via-bracco5_DxO.jpg";}i:1;a:2:{s:10:"slide_name";s:7:"Slide 1";s:9:"slide_url";s:78:"http://www.asili-nido-roma.com/wp-content/uploads/2014/11/pan_atti_003_red.jpg";}}}}}}';
$unserObj = unserialize($obj2);
//var_dump($unserObj);


$arrayOfSlides= $unserObj['collections']['sliders']['data']['item_data'];
$elem=array();
$elem['slide_name'] ="slide 3";
$elem['slide_url'] ="http://www.asili-nido-roma.com/wp-content/uploads/2014/11/Panorama-bis1_red.jpg";
array_push($unserObj['collections']['sliders']['data']['item_data'],$elem );
$elem['slide_name'] ="slide 4";
$elem['slide_url'] ="http://www.asili-nido-roma.com/wp-content/uploads/2014/11/Panorama_rec_-1_001_red.jpg";
array_push($unserObj['collections']['sliders']['data']['item_data'],$elem );
$elem['slide_name'] ="slide 5";
$elem['slide_url'] ="http://www.asili-nido-roma.com/wp-content/uploads/2014/11/piscine_pano_red.jpg";
array_push($unserObj['collections']['sliders']['data']['item_data'],$elem );
var_dump($unserObj);

//echo serialize($unserObj);
?>
    </body>
    </html>