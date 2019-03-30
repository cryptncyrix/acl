<?php declare(strict_types=1);

return [
    'email' => [
        'email' => 'Email-Format ist nicht gültig',
        'required' => 'Email wurde nicht angegeben',
        'unique' => 'E-Mail ist bereits vorhanden.',
    ],
    'name' => [
        'min' => 'Name ist zu kurz',
        'required' => 'Name wurde nicht angegeben',
    ],
    'password' => [
        'regex' => 'Password ist nicht gültig.',
        'required' => 'Password wurde nicht angegeben.',
    ],
];