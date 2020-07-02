<?php

$request = $_SERVER['REQUEST_URI'];

// GET Requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    switch ($request) {
        case '/stocks' :
            require __DIR__ . '/api/get.php';
            break;
    }
}
// POST Requests
elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    switch ($request) {
        case '/stocks' :
            require __DIR__ . '/api/post.php';
            break;
    }
}else{}
