<?php

if (!isset($_COOKIE['kookie'])) {
    $pagecount = 0;

    setcookie("kookie", $pagecount);


    echo " 
    <center class=\"main\">
        FIRST TIME USER
    </center>
    ";
} else {

    $pagecount = ++$_COOKIE['kookie'];

    setcookie("kookie", $pagecount);

    echo "<center class=\"main\">View Count: " . $_COOKIE['kookie'] . "</center>";
}

?>

<html>

<head>
    <style>
        .main {
            font-size: 2em;
            color: rebeccapurple;
        }
    </style>
</head>

<body>
    <b>
        <center>Refresh button will refresh the page and the page count</center>
    </b>
</body>

</html>
