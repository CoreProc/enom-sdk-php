<?php

return [

    'userId'   => env('ENOM_USER_ID', ''),

    'password' => env('ENOM_PASSWORD', ''),

    // Allows us to set wheter we use the test API for development
    // or the production API.
    'develop'  => env('ENOM_DEVELOP', false),

];