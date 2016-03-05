<?php

class FlashMessage
{
    /**
     * @param string $type
     * @param string $message
     */
    public static function set($type, $message)
    {
        $_SESSION["flash_message"] = [
            "type" => $type,
            "message" => $message,
        ];
    }

    /**
     * @return array
     */
    public static function pop()
    {
        $message = null;
        if (isset($_SESSION["flash_message"])) {
            $message = $_SESSION["flash_message"];
            unset($_SESSION["flash_message"]);
        }

        return $message;
    }
}
