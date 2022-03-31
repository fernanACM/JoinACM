<?php

namespace fernanACM\JoinACM\commands;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;

use fernanACM\JoinACM\Join;
use fernanACM\JoinACM\PluginUtils;

class JoinCommand extends Command implements PluginOwned{
    
    private $plugin;

    public function __construct(Join $plugin){
        $this->plugin = $plugin;
        
        parent::__construct("joinacm", "§r§fOpen menu JoinACM to view your welcome by §bfernanACM", "§cUse: /joinacm", ["join"]);
        $this->setPermission("joinacm.command");
        $this->setAliases(["join"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(count($args) == 0){
            if($sender instanceof Player) {
                $this->plugin->getJoinUI($sender);
                PluginUtils::PlaySound($sender, "random.screenshot", 1, 1);
            } else {
                  $sender->sendMessage("Use this command in-game");
            }
        }
        return true;
    }
    
    public function getPlugin(): Plugin{
        return $this->plugin;
    }

    public function getOwningPlugin(): Join{
        return $this->plugin;
    }
}
