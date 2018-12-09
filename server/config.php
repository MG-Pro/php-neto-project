<?php

if(strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
  define('DB_LOGIN', "root");
  define('DB_PASS', "");
  define('DB_NAME', "faq");
} else {
  define('DB_LOGIN', "mgladkih");
  define('DB_PASS', "neto1853");
  define('DB_NAME', "mgladkih");
}




