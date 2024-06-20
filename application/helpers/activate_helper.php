<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('active_link'))
{
     function activate_menu($controller)
     {
          // Get CI instance
          $CI = get_instance();
          // Fetch class name.
          $class = $CI->router->fetch_class();
          // var_dump($controller);
          // echo "string___________________";
          // var_dump($class);

          // Return class active as a string.
          return ($class == $controller) ? 'active' : '';
     }
}

if( ! function_exists('dumpvar') ){
     function dumpvar($var){
          echo '<pre>';
          print_r($var);
          echo '</pre>';
          exit();
     }
}

if( ! function_exists('photo_exits') ){
     function photo_exits($file){
          if(file_exists($file.'.jpeg'))
               return $file.'.jpeg';
          if(file_exists($file.'.jpg'))
               return $file.'.jpg';
          if(file_exists($file.'.png'))
               return $file.'.png';
          if(file_exists($file.'.gif'))
               return $file.'.gif';
          return false;
     }
}