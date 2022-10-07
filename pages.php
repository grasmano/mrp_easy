<?php

function getIncludedFile($action)
{
    $pages = [
        'login' => 'login.php',
        'user' => 'user.php',
        'parsing' => 'parsing.php',
        'sql' => 'sql.php',
    ];
    return 'pages/' . $pages[$action ?: 'login.php'];
}
