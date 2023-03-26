<?php

declare (strict_types=1);

namespace Osky\WordpressPluginLogger\Config;

Class Timestamp
{
    public function __construct(
        protected string $format
    )
    {
        
    }
    public function __invoke() : string
    {
        return '[ '.date($this->format).' ] ';
    }
}