<?php

include("bootstrap.php");


if (isset($_GET['search'])) {
    include("functional/Search.php");
    $search = new Search($db);   
    $search->locate($_GET['search']);
}