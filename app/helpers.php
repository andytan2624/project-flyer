<?php
function flash($title = null, $message = null)
{
	$flash = app('App\Http\Flash');

    if (count(func_get_args()) == 0) {
        return $flash;
    }

    return $flash->message($title, $message);
}