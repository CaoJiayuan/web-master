<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/domains', function () {
    $dir = config('app.vhost_path');

    $files = [];

    file_map($dir, function ($filename, $fileInfo) use (&$files) {
        /** @var SplFileInfo $fileInfo */
        $content = file_get_contents($filename);

        preg_match('#server_name(.*);#', $content, $match);
        preg_match('#listen(.*);#', $content, $match2);

        $files[] = [
            'filename' => basename($filename),
            'name' => trim($match[1]),
            'listen' => trim(array_get($match2, 1))
        ];

    });

    return $files;
});
