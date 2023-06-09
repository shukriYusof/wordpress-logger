<?php

declare (strict_types=1);

namespace Osky\WordpressPluginLogger\Config;

class Path
{
    const EXT = '.log';
    const FILENAME = 'logger';

    public function __construct(
        protected string|null $path,
        protected string|null $pluginName,
        protected string $logSize
    )
    {

    }

    public function setPluginName($name)
    {
        $this->pluginName = $name ? $name : basename((  dirname( __FILE__ , 6 )));
        return $this;
    }

    public function wordpress()
    {

        if (!file_exists('log/')) {
            $this->createDirectory(false, 'log/');
        }

        return $this->path = 'log/' . self::FILENAME . self::EXT;
    }

    public function wordpressPlugin()
    {
        if (!file_exists(dirname((__FILE__), 6). '/' . $this->pluginName . '/log/')) {
            $this->createDirectory(true, dirname((__FILE__), 6) . '/' . $this->pluginName . '/log/');
        }
        return $this->path = dirname((__FILE__), 6) . '/' . $this->pluginName . '/log/' . self::FILENAME . self::EXT;
    }

    private function createDirectory($isPlugin, $path)
    {
        if ($isPlugin) {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
                if (!file_exists($path . self::FILENAME . self::EXT)) {
                    fopen($path . self::FILENAME . self::EXT, 'w');
                }
            } else {
                if ($this->logSize < filesize($path . self::FILENAME . self::EXT )) {
                    rename(
                        $path . self::FILENAME . self::EXT,
                        sprintf('%s-%s%s', $path, date( 'Y-m-d-H-i-s' ), self::EXT )
                    );
                }
            }
        } else {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
                if (!file_exists($path . self::FILENAME . self::EXT)) {
                    fopen($path . self::FILENAME . self::EXT, 'w');
                }
            } else {
                if ($this->logSize < filesize($path . self::FILENAME . self::EXT )) {
                    rename(
                        $path . self::FILENAME . self::EXT,
                        sprintf('%s-%s%s', $path, date( 'Y-m-d-H-i-s' ), self::EXT )
                    );
                }
            }
        }
    }
}
