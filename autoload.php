<?php
spl_autoload_register(function ($class_name) {
  if(file_exists("classes/" . $class_name . ".php")) {
    require_once 'classes/'.$class_name . '.php';
  } elseif (file_exists('services/' . $class_name . ".php")) {
    require_once 'services/'.$class_name . '.php';
  } elseif (file_exists('classes/essenses/' . $class_name . ".php")) {
    require_once 'classes/essenses/'.$class_name . '.php';
  }
});