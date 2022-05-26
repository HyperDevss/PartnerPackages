<?php

namespace PartnerPackages\rewards;

use JsonException;
use PartnerPackages\provider\JSONProvider;
use pocketmine\item\Item;

class RewardsManager
{

    public static array $rewards = [];

    public static function enable(): void
    {
        $config = JSONProvider::getConfig();
        $contents = $config->getAll();
        foreach ($contents as $content => $item) {
            self::$rewards[$content] = Item::jsonDeserialize($item);
        }
    }

    public static function getRewards(): array
    {
        return self::$rewards;
    }

    public static function getRandomReward(): Item
    {
        return self::$rewards[array_rand(self::$rewards)];
    }

    public static function serialize(Item $item): array
    {
        return $item->jsonSerialize();
    }

    /**
     * @throws JsonException
     */
    public static function disable(): void
    {
        $config = JSONProvider::getConfig();
        $rewards = [];
        foreach (self::getRewards() as $reward => $item) {
            $rewards[$reward] = self::serialize($item);
        }
        $config->setAll($rewards);
        $config->save();
    }

}