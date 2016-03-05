<?php

class Template
{
    public $brand = "My dashboard";

    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string|null
     */
    public $active;

    /**
     * @var callable|null
     */
    public $body;

    /**
     * @var callable|null
     */
    public $content;

    /**
     * @param string $template
     * @param array $vars
     */
    public function render($template, array $vars = [])
    {
        foreach ($this as $key => $value) {
            $$key = $value;
        }

        foreach ($vars as $key => $value) {
            $$key = $value;
        }

        require $template;
    }
}
