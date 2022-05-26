<?php

namespace PartnerPackages;

use JsonException;
use PartnerPackages\command\PartnerPackagesCommand;
use PartnerPackages\listener\EventsListener;
use PartnerPackages\provider\JSONProvider;
use PartnerPackages\rewards\RewardsManager;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase
{

    use SingletonTrait;

    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {
        JSONProvider::enable();
        RewardsManager::enable();
        $this->getServer()->getPluginManager()->registerEvents(new EventsListener(), $this);
        $this->getServer()->getCommandMap()->register("partnerpackages", new PartnerPackagesCommand("pp"));
    }

    /**
     * @throws JsonException
     */
    protected function onDisable(): void
    {
        JSONProvider::disable();
        RewardsManager::disable();
    }

}