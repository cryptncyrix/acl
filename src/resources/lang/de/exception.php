<?php declare(strict_types=1);

return [
    'back_login' => 'Zurück zum Login',
    'command_argument_not_exists' => 'Dein Argument war nicht gültig - Prüfe für weitere Informationen die Readme-Datei.',
    'error_authorized' => 'Berechtigungsfehler',
    'form'  => 'Formularfehler - Wert nicht im alten Array vorhanden.',
    'method' =>  'Middleware - Fehler | Function {{ :name }}, nicht vorhanden. Prüfe deine Config-Datei',
    'middleware' => 'Middleware - Fehler | Nutze bitte für {{ :route }} die Namen Methode - zum Beispiel: ->name("foobar")',
    'permissen_denied' => 'Benutzer hat nicht die erforderlichen Berechtigungen.',
    'repository_model_type' => 'Klasse :class muss vom Type Illuminate\\Database\\Eloquent\\Model sein, :type übergeben.',
    'role_blocked' => 'Die Rolle kann nicht gelöscht werden. Ändere bitte die \'blockedRole\' in der Config-Datei.',
    'superAdmin' => 'Dieser Benutzer kann nicht gelöscht werden. Er ist der superAdmin. Ändere den \'superAdmin\', in der Config-Datei.',
    'type' => 'Helper\helpers\hasResource Fehler - Es wurde :type übergeben, erlaubt sind aber nur String und Array.',
    'unauthorized' => 'Benutzer ist nicht angemeldet.',
];

