<?php declare(strict_types=1);
return
    [
        'method' =>  'Middleware - Fehler | Function {{ :name }}, nicht vorhanden. Prüfe deine Config-Datei',
        'type' => 'Helper\helpers\hasResource Fehler - Es wurde :type übergeben, erlaubt sind aber nur String und Array.',
        'middleware' => 'Middleware - Fehler | Nutze bitte für {{ :route }} die Namen Methode - zum Beispiel: ->name("foobar")',
        'unauthorized' => 'Benutzer ist nicht angemeldet.',
        'permissen_denied' => 'Benutzer hat nicht die erforderlichen Berechtigungen.',
        'role_blocked' => 'Die Rolle kann nicht gelöscht werden. Ändere bitte die \'blockedRole\' in der Config-Datei.',
        'superAdmin' => 'Dieser Benutzer kann nicht geblockt werden. Er ist der superAdmin. Ändere den \'superAdmin\', in der Config-Datei.',
        'form'  => 'Formularfehler - Wert nicht im alten Array vorhanden.',
        'error_authorized' => 'Berechtigungsfehler',
        'back_login' => 'Zurück zum Login'

    ];

