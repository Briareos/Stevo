<?php

class Company
{
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string
     */
    public $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}
