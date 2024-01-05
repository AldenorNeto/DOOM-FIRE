<?php

use Illuminate\Support\Facades\Route;

function fireParams() {
    $colorPatter = [
        "#070707",
        "#1f0707",
        "#2f0f07",
        "#470f07",
        "#571707",
        "#671f07",
        "#771f07",
        "#8f2707",
        "#9f2f07",
        "#af3f07",
        "#bf4707",
        "#c74707",
        "#df4f07",
        "#df5707",
        "#df5707",
        "#d75f07",
        "#d75f07",
        "#d7670f",
        "#cf6f0f",
        "#cf770f",
        "#cf7f0f",
        "#cf8717",
        "#c78717",
        "#c78f17",
        "#c7971f",
        "#bf9f1f",
        "#bf9f1f",
        "#bfa727",
        "#bfa727",
        "#bfaf2f",
        "#b7af2f",
        "#b7b72f",
        "#b7b737",
        "#cfcf6f",
        "#dfdf9f",
        "#efefc7",
        "#ffffff",
    ];

    $heightFire = 50;
    $widthFire = $heightFire * 2;
    $array = array_fill(0, $heightFire * $widthFire, 0);

    return view('firedoom',[
        'patterJS' => json_encode($colorPatter), 
        'arrayJS' => json_encode($array), 
        'colorPatter' => $colorPatter, 
        'heightFire' => $heightFire, 
        'widthFire' => $widthFire,
        'array' => $array
    ]);
}

Route::get('/', function () {
    return fireParams();
});

Route::get('/phpGenerate', function () {
    return fireParams();
});

