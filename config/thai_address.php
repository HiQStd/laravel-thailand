<?php

return [

    'models' => [
        'sub_district' => Baraear\ThaiAddress\Models\SubDistrict::class,
        'district' => Baraear\ThaiAddress\Models\District::class,
        'province' => Baraear\ThaiAddress\Models\Province::class,
        'postal_code' => Baraear\ThaiAddress\Models\PostalCode::class,
    ],

    'table_names' => [
        'sub_district' => 'sub_districts',
        'district' => 'districts',
        'province' => 'provinces',
        'postal_code' => 'postal_codes',
    ],

];
