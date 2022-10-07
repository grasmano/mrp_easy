<?php

include "pages.php";
include 'vendor/autoload.php';
include 'classes/Users.php';
include 'classes/ParseTags.php';

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <title>MRPeasy TEST</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
                <ul class="navbar-nav">
                    <li class="nav-item mr-5">
                        <a class="nav-link " href="?page=parsing">Parse Tags<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link mr-10" href="?page=sql">SQL Last versions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=login">Counter web application</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mt-5">
            <h3 class="text-center">MRPeasy testwork</h3>
            <?php
            if (isset($_REQUEST['page'])) {
                include getIncludedFile($_REQUEST['page']);
            } else {
                include 'pages/login.php';
            }
            ?>
        </div>
    </body>
</html>
