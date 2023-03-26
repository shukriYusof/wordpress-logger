<?php

declare (strict_types=1);

namespace Osky\WordpressPluginLogger\Config;

class Message 
{
    public function __construct(
        protected string|object|array|null $message
    )
    {
        
    }

    public function __invoke()
    {
        return (is_array($this->message)) 
            ? var_export($this->message, true)
            : var_export(json_decode(json_encode($this->message), true), true);
    }
}