<?php

use App\Core\Router;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthController;


// Auth Routes
// Router::get('/', [AuthController::class, 'index']);
Router::post('/send-otp', [AuthController::class, 'sendOtp']);
Router::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Router::post('/login', [AuthController::class, 'login']);

// Product Routes
Router::get('/product-add', [ProductController::class, 'add']);
Router::get('/products', [ProductController::class, 'show']);
Router::post('/product-update', [ProductController::class, 'update']);
Router::post('/product-delete', [ProductController::class, 'delete']);

?>

