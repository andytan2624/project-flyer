<?php
function flash($title = null, $message = null)
{
	$flash = app('App\Http\Flash');

    if (count(func_get_args()) == 0) {
        return $flash;
    }

    return $flash->message($title, $message);
}

function link_to($body, $path, $type)
{
    $csrf = csrf_field();

    if (is_object($path)) {
        $action = $path->getTable();
        if (in_array($type, ['PUT', 'PATCH', 'DELETE'])) {
            $action .= '/' . $path->getKey();
        }
    } else {
        $action = $path;
    }

    return <<<EOT
        <form method="POST" action="{$action}">
            <input type='hidden' name='_method' value='{$type}'>
            $csrf
            <button type="submit">{$body}</button>
        </form>
EOT;
}