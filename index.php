<?php

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// GET Requests
if ($method === 'GET') {
    switch ($request) {
        case '/stocks' :
            require __DIR__ . '/api/get.php';
            break;
    }
}
// POST Requests
elseif($method === 'POST'){
    switch ($request) {
        case '/stocks' :
            require __DIR__ . '/api/post.php';
            break;
    }
}
// TODO: Other methods will be done
else{}
