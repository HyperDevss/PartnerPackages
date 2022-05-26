<?php

namespace PartnerPackages\command;

use PartnerPackages\rewards\RewardsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class PartnerPackagesCommand extends Command
{

    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission("partnerpackages.command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player){
            return;
        }
        if (!$this->testPermission($sender)){
            return;
        }
		if (!isset($args[0])){
			$sender->sendMessage(TextFormat::colorize("&cUse: /pp help"));
			return;
		}
        if ($args[0] === "help"){
            $sender->sendMessage(TextFormat::colorize("&6PartnerPackages\n\n&c/pp setitems"));
            return;
        }
        if ($args[0] === "setitems"){
            RewardsManager::$rewards = $sender->getInventory()->getContents();
            return;
        }
        $sender->sendMessage(TextFormat::colorize("&6PartnerPackages\n\n&c/pp setitems"));
		return;
    }

}