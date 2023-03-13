<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
namespace fernanACM\JoinACM\utils;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\entity\Location;

use pocketmine\network\mcpe\protocol\ActorEventPacket;
use pocketmine\network\mcpe\protocol\types\ActorEvent;

use fernanACM\JoinACM\Loader;
use fernanACM\JoinACM\forms\JoinForm;

class JoinModeUtils{

    /**
     * @param Player $player
     * @return void
     */
    public static function sendSpawnMode(Player $player): void{
        $config = Loader::getInstance()->config;
        switch($config->getNested("SpawnMode.joinSpawn")){
            case "CUSTOM": // Spawn defined through the /joinacm setspawn command
                $spawn = Loader::getInstance()->spawn->get("Spawn");
                if(isset($spawn["World"], $spawn["X"], $spawn["Y"], $spawn["Z"], $spawn["Pitch"], $spawn["Yaw"])){
                    $player->teleport(new Location($spawn["X"], $spawn["Y"], $spawn["Z"], $spawn["World"], $spawn["Pitch"], $spawn["Yaw"]));
                }else{
                    $player->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
                }
            break;

            case "DEFAULT": // default spawn of the world
                $player->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
            break;

            case false: // Last position where you disconnected
            break;
        }
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function sendJoinTypeUI(Player $player): void{
        $config = Loader::getInstance()->config;
        switch($config->getNested("PlayerJoin.JoinType.formType")){
            case "BOOK": // UI book mode
                JoinForm::getJoinBookUI($player);
            break;

            case "UI": // UI form mode
                JoinForm::getJoinUI($player);
            break;
        }
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function sendJoinModeForm(Player $player): void{
        $config = Loader::getInstance()->config;
        switch($config->getNested("PlayerJoin.JoinType.modeForm")){
            case "FIRST_TIME": // When you first join
                if(!$player->hasPlayedBefore()){
                    self::sendJoinTypeUI($player);
                }  
            break;

            case "ALWAYS": // Always when you join
                self::sendJoinTypeUI($player);
            break;

            case false: // Disabled when joined
            break;
        }
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function sendJoinMessage(Player $player): void{
        $config = Loader::getInstance()->config;
        switch($config->getNested("PlayerJoin.JoinType.modeMessage")){
            case "TOAST": //$player->sendToastNotification("...");
                $player->sendToastNotification(Loader::getMessage($player, "PlayerJoin.Messages.sendToast.title"), Loader::getMessage($player, "PlayerJoin.Messages.sendToast.subTitle"));
            break;

            case "MESSAGE": //$player->sendMessage("...");
                $player->sendMessage(Loader::getMessage($player, "PlayerJoin.Messages.sendMessage"));
            break;

            case "TIP": //$player->sendTip("...");
                $player->sendTip(Loader::getMessage($player, "PlayerJoin.Messages.sendTip"));
            break;

            case "POPUP": //$player->sendPopup("...");
                $player->sendPopup(Loader::getMessage($player, "PlayerJoin.Messages.sendPopup"));
            break;

            case "ACTION_BAR": //$player->sendActionBarMessage("...");
                $player->sendActionBarMessage(Loader::getMessage($player, "PlayerJoin.Messages.sendActionBar"));
            break;

            case false: // Disabled when joined
            break;
        }
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function sendTitleMessage(Player $player): void{
        $config = Loader::getInstance()->config;
        switch($config->getNested("JoinUI.sendFormMessage")){
            case true: // Disabled when "sendFormMessage" mode is true
            break;

            case false: // Enabled when the "sendFormMessage" mode is false
                if($config->getNested("PlayerJoin.JoinType.modeTitle")){
                    // Enabled when the "modeTitle" mode is true
                    $player->sendTitle(Loader::getMessage($player, "PlayerJoin.Messages.sendTitle.titleMessage"));
                    $player->sendSubTitle(Loader::getMessage($player, "PlayerJoin.Messages.sendTitle.subTitleMessage"));
                }

                if($config->getNested("PlayerJoin.JoinType.modeAnimation")){
                    self::sendAnimationTexture($player);
                }
            break;
        }
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function sendFormMessage(Player $player): void{
        $config = Loader::getInstance()->config;
        switch($config->getNested("JoinUI.sendFormMessage")){
            case true: // Enabled on button click
                $player->sendTitle(Loader::getMessage($player, "JoinUI.sendTitle.titleMessage"));
                $player->sendSubTitle(Loader::getMessage($player, "JoinUI.sendTitle.subTitleMessage"));
                if($config->getNested("JoinUI.modeAnimation")){
                    self::sendAnimationTexture($player);
                }
            break;

            case false: // Disabled on button click
            break;
        }
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function sendMessageFirstTime(Player $player): void{
        $config = Loader::getInstance()->config;
        switch($config->getNested("PlayerJoin.JoinType.firstTime")){
            case true: // Enabled when you first join
                if(!$player->hasPlayedBefore()){
                    $player->sendMessage(Loader::getMessage($player, "PlayerJoin.Messages.firstTimeMessage"));
                    Server::getInstance()->broadcastMessage(Loader::getMessage($player, "PlayerJoin.BroadCast.firstTimeBroadCastMessage"));
                }
            break;

            case false: // Disabled when you first join
            break;
        }
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function sendAnimationTexture(Player $player): void{
        $config = Loader::getInstance()->config;
        switch($config->getNested("PlayerJoin.JoinType.Animation.animationMode")){
            case "BOOTS":
                PluginUtils::AminationTexture($player, 1);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "CHAINS":
                PluginUtils::AminationTexture($player, 2);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "PICKAXE":
                PluginUtils::AminationTexture($player, 3);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "SHOVEL":
                PluginUtils::AminationTexture($player, 4);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "SWORD":
                PluginUtils::AminationTexture($player, 5);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "HEART":
                PluginUtils::AminationTexture($player, 10);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "SHIELD":
                PluginUtils::AminationTexture($player, 11);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "SHIELD_ON_FIRE":
                PluginUtils::AminationTexture($player, 12);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "MIRROR":
                PluginUtils::AminationTexture($player, 14);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "BLINDNESS":
                PluginUtils::AminationTexture($player, 15);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "HUNGER":
                PluginUtils::AminationTexture($player, 17);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "POISON":
                PluginUtils::AminationTexture($player, 19);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "HEART_OF_WITHER":
                PluginUtils::AminationTexture($player, 20);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "MULTi_HEART":
                PluginUtils::AminationTexture($player, 21);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "EYE":
                PluginUtils::AminationTexture($player, 26);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "PILLAGER":
                PluginUtils::AminationTexture($player, 28);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "EMERALD":
                PluginUtils::AminationTexture($player, 29);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;

            case "TWISTER":
                PluginUtils::AminationTexture($player, 30);
                PluginUtils::PlaySound($player, $config->getNested("PlayerJoin.JoinType.Animation.soundName"), 1, 1);
            break;
            
            case "TOTEM":
                ActorEventPacket::create($player->getId(), ActorEvent::CONSUME_TOTEM, 0);
            break;

            case "GUARDIAN":
                ActorEventPacket::create($player->getId(), ActorEvent::ELDER_GUARDIAN_CURSE, 0);
            break;

            case false:
            break;
        }
    }
}