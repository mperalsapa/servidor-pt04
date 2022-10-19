<?php


function retornarError(string $error, string $vista)
{
    $formResult = $error;
    include_once($vista);
    die();
}
