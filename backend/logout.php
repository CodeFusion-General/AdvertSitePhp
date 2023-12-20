<?php
// logout.php

// Oturumu başlat
session_start();

// Oturumu sonlandır
session_unset();
session_destroy();

// Kullanıcıyı başka bir sayfaya yönlendir
header('Location: http://localhost/phpProject/index.php'); // veya başka bir sayfaya yönlendirin
exit();
?>