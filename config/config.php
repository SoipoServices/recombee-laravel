<?php

return [
    'database'=>['id'=>env('RECOMBEE_DB_NAME'),'token'=>env('RECOMBEE_DB_TOKEN'),'region' => env('RECOMBEE_REGION','us-west')],
    'properties' => [
        'item'=>[],
        'user'=>[]
    ]

];
