<?php

namespace PartnerPackages\listener;

use PartnerPackages\rewards\RewardsManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\utils\TextFormat;

class EventsListener implements Listener
{

    public function onUse(PlayerItemUseEvent $event)
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item->getId() === 130){
            if ($item->getCustomName() === TextFormat::colorize("&r&l&dPartner-Package")){
                $reward = RewardsManager::getRandomReward();
                if (count(RewardsManager::getRewards()) === 0) return;
                if (!$player->getInventory()->canAddItem($reward)) {
                    $player->sendMessage(TextFormat::colorize("&cYour inventory is full!"));
                    return;
                }
                $player->sendMessage(TextFormat::colorize("&eYou Have Got: &r{$reward->getCustomName()}"));
                $player->getInventory()->addItem($reward);
                $player->getInventory()->setItemInHand($player->getInventory()->getItemInHand()->setCount($player->getInventory()->getItemInHand()->getCount() - 1));
            }
        }
    }

}