<?php

namespace PartnerPackages\provider;

use JsonException;
use PartnerPackages\Loader;
use pocketmine\utils\Config;

class JSONProvider
{

    public static Config $config;

    public static function enable(): void
    {
        self::$config = new Config(Loader::getInstance()->getDataFolder()."rewards.json", Config::JSON);
    }

    /**
     * @throws JsonException
     */
    public static function disable(): void
    {
        self::$config->save();
    }

    public static function getConfig(): Config
    {
        return self::$config;
    }

}