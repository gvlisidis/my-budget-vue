<?php
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::view('/{any}', 'dashboard')
    ->middleware(['auth'])
    ->where('any', '.*');

