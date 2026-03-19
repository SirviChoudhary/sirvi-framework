<?php
spl_autoload_register(function ($class) {

    // Base namespace
    $prefix = 'App\\';

    // Base directory
    $base_dir = __DIR__ . '/../app/';
    // echo  $base_dir."<br>";
    // echo $class."<br>";

    // Check if class uses App namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Get relative class name
    $relative_class = substr($class, $len);

    // Replace namespace separator with directory separator
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // echo $file;

    // If file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
?>