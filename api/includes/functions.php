<?php

function errorRendring(int $errCode, string $errMsg): void
{
    $message = $errMsg;
    http_response_code($errCode);
    echo $message;
}
