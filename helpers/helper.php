<?php

// Response Codes
const SUCCESS = 0;
const BAD_REQUEST = 400;
const NOT_MODIFIED = 304;
const NOT_FOUND = 404;

function isInt($data)
{
    if (preg_match('/^\d+$/', $data)) {
        return true;
    }
    return false;
}

function cleanInput($data)
{
    return htmlspecialchars(strip_tags($data));
}