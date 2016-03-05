<?php

/**
 * @param $value string
 *
 * @return string
 */
function e($value)
{
    return htmlentities($value);
}

function ensure_session_started()
{
    if (!session_id()) {
        session_start();
    }
}
