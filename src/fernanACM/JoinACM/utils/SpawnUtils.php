<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
declare(strict_types=1);

namespace fernanACM\JoinACM\utils;

use pocketmine\player\Player;

use fernanACM\JoinACM\Loader;

class SpawnUtils{

    /**
     * @param Player $player
     * @return void
     */
    public static function setSpawn(Player $player): void{
        $config = Loader::getInstance()->spawn;
        $config->remove("Spawn");
        $config->save();
        $setThis = [
            "World" => (string)$player->getWorld()->getFolderName(),
            "X" => (int)$player->getLocation()->getX(), 
            "Y" => (int)$player->getLocation()->getY(), 
            "Z" => (int)$player->getLocation()->getZ(), 
            "Yaw" => $player->getLocation()->getYaw(),
            "Pitch" => $player->getLocation()->getPitch()
        ];
        $config->set("Spawn", $setThis);
        $config->save();
        // message
        $datos = str_replace([
            "{X}", 
            "{Y}", 
            "{Z}"
        ],
        [
            $player->getLocation()->getX(),
            $player->getLocation()->getY(),
            $player->getLocation()->getZ()
        ], Loader::getMessage($player, "Messages.spawn-selected-successfully"));
        $player->sendMessage(Loader::Prefix(). $datos);
        PluginUtils::PlaySound($player, "random.levelup", 1, 1);
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function removeSpawn(Player $player): void{
        $config = Loader::getInstance()->spawn;
        $config->remove("Spawn");
        $config->save();
        $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "Messages.spawn-successfully-removed"));
        PluginUtils::PlaySound($player, "random.levelup", 1, 1);
    }
}