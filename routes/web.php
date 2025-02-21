<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');

require __DIR__.'/auth.php';
