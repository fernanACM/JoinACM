<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
namespace fernanACM\JoinACM;

use pocketmine\Server;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerJoinEvent;

use fernanACM\JoinACM\Loader;
use fernanACM\JoinACM\utils\JoinModeUtils;
use fernanACM\JoinACM\utils\PluginUtils;;

class Event implements Listener{
    
    /**
     * @param PlayerJoinEvent $event
     * @return void
     */
    public function onJoin(PlayerJoinEvent $event): void{
        $player = $event->getPlayer();
        $config = Loader::getInstance()->config;
        $spawn = Loader::getInstance()->spawn->get("Spawn");
        $defaultSound = $config->getNested("JoinVip.Sound.default-joinSoundName");
        # JoinVip
        if($config->getNested("JoinVip.Support.enabled")){
            foreach($config->getNested("JoinVip.vip-list") as $vips){
                if($player->getName() == $vips){
                    $event->setJoinMessage("");
                    $message = str_replace(["{PLAYER}"], [$vips], Loader::getMessage($player, "JoinVip.Join.".$vips.".message"));
                    Server::getInstance()->broadcastMessage($message);
                    if($config->getNested("JoinVip.Sound.playerJoin")){
                        PluginUtils::BroadSound($player, $config->getNested("JoinVip.Join.".$vips.".soundName") ?? $defaultSound, 500, 1);
                    }
                }
            }
            # VipList
            $vips = $config->getNested("JoinVip.vip-list");
            if(!in_array($player->getName(), $vips)){
                if($config->getNested("PlayerJoin.BroadCast.playerJoin")){
                    $event->setJoinMessage("");
                    Server::getInstance()->broadcastMessage(Loader::getMessage($player, "PlayerJoin.BroadCast.playerJoinMessage"));
                    if($config->getNested("PlayerJoin.BroadCast.joinSound")){
                        PluginUtils::BroadSound($player, $config->getNested("PlayerJoin.BroadCast.joinSoundName"), 500, 1);
                    }
                }
            }
        }else{
            if($config->getNested("PlayerJoin.BroadCast.playerJoin")){
                $event->setJoinMessage("");
                Server::getInstance()->broadcastMessage(Loader::getMessage($player, "PlayerJoin.BroadCast.playerJoinMessage"));
                if($config->getNested("PlayerJoin.BroadCast.joinSound")){
                    PluginUtils::BroadSound($player, $config->getNested("PlayerJoin.BroadCast.joinSoundName"), 500, 1);
                }
            }
        }
        # Form => JoinModeUils::sendJoinModeForm($player);
        JoinModeUtils::sendJoinModeForm($player);
        # Title => JoinModeUils::sendTitleMessage($player);
        JoinModeUtils::sendTitleMessage($player);
        # Message => JoinModeUils::sendJoinMessage($player);
        JoinModeUtils::sendJoinMessage($player);
        # FirstTime => JoinModeUils::sendMessageFirstTime($player);
        JoinModeUtils::sendMessageFirstTime($player);

        # Custom spawn
        if($config->getNested("SpawnMode.joinSpawn") === "CUSTOM"){
            if(!isset($spawn["World"], $spawn["X"], $spawn["Y"], $spawn["Z"], $spawn["Pitch"], $spawn["Yaw"])){
                if(Server::getInstance()->isOp($player->getName())){
                    $player->sendMessage(Loader::Prefix(). Loader::getMessage($player, "SpawnMode.undefined-message"));
                }
            }
        }
    }

    /**
     * @param PlayerQuitEvent $event
     * @return void
     */
    public function onQuit(PlayerQuitEvent $event): void{
        $player = $event->getPlayer();
        $config = Loader::getInstance()->config;
        $defaultSound = $config->getNested("JoinVip.Sound.default-quitSoundName");
        # QuitVip
        if($config->getNested("JoinVip.Support.enabled")){
            foreach($config->getNested("JoinVip.vip-list") as $vips){
                if($player->getName() == $vips){
                    $event->setQuitMessage("");
                    $message = str_replace(["{PLAYER}"], [$vips], Loader::getMessage($player, "JoinVip.Quit.".$vips.".message"));
                    Server::getInstance()->broadcastMessage($message);
                    if($config->getNested("JoinVip.Sound.playerQuit")){
                        PluginUtils::BroadSound($player, $config->getNested("JoinVip.Quit.".$vips.".soundName") ?? $defaultSound, 500, 1);
                    }
                }
            }
            # VipList
            $vips = $config->getNested("JoinVip.vip-list");
            if(!in_array($player->getName(), $vips)){
                if($config->getNested("PlayerQuit.BroadCast.playerQuit")){
                    $event->setQuitMessage("");
                    Server::getInstance()->broadcastMessage(Loader::getMessage($player, "PlayerQuit.BroadCast.playerQuitMessage"));
                    if($config->getNested("PlayerQuit.BroadCast.quitSound")){
                        PluginUtils::BroadSound($player, $config->getNested("PlayerQuit.BroadCast.quitSoundName"), 500, 1);
                    }
                }
            }
        }else{
            if($config->getNested("PlayerQuit.BroadCast.playerQuit")){
                $event->setQuitMessage("");
                Server::getInstance()->broadcastMessage(Loader::getMessage($player, "PlayerQuit.BroadCast.playerQuitMessage"));
                if($config->getNested("PlayerQuit.BroadCast.quitSound")){
                    PluginUtils::BroadSound($player, $config->getNested("PlayerQuit.BroadCast.quitSoundName"), 500, 1);
                }
            }
        }
    }

    /**
     * @param PlayerLoginEvent $event
     * @return void
     */
    public function onLogin(PlayerLoginEvent $event): void{
        $player = $event->getPlayer();
        JoinModeUtils::sendSpawnMode($player);
    }
}