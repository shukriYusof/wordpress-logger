<?php

declare (strict_types=1);

namespace Osky\WordpressPluginLogger\Config;

Class Timezone 
{
    public function __construct(
        protected string $timezone
    )
    {
        
    }

    public function __invoke()
    {
        date_default_timezone_set($this->timezone);
    }
}
