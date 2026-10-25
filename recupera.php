<?php
function recupera($campo, $defecto = null)
{
    if (isset($_REQUEST[$campo]))
        return $_REQUEST[$campo];
    return $defecto;
}
