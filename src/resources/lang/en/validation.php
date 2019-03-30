<?php declare(strict_types=1);

return [
    'email' => [
        'email' => 'Email-Format is not valid',
        'required' => 'Email is required',
        'unique' => 'E-Mail exists',
    ],
    'name' => [
        'min' => 'Name is to short',
        'required' => 'Name is required',
    ],
    'password' => [
        'regex' => 'Password is not valid',
        'required' => 'Password is required',
    ],
];