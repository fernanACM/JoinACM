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
use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
# Libs
use Vecnavium\FormsUI\FormsUI;
use muqsit\simplepackethandler\SimplePacketHandler;

use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\PacketHooker;

use cooldogedev\libBook\LibBook;

use DaPigGuy\libPiggyUpdateChecker\libPiggyUpdateChecker;

use fernanACM\JoinACM\commands\JoinCommand;

use fernanACM\JoinACM\utils\PluginUtils;

class Loader extends PluginBase{
    
    /** @var Config $config */
    public Config $config;

    /** @var Config $spawn */
    public Config $spawn;

    /** @var Loader $instance */
    public static Loader $instance;

    # CheckConfig
    public const CONFIG_VERSION = "2.0.0";

    /**
     * @return void
     */
    public function onLoad(): void{
        self::$instance = $this;
    }

    /**
     * @return void
     */
    public function onEnable(): void{
        $this->loadFiles();
        $this->loadCheck();
        $this->loadVirions();
        $this->loadCommands();
        $this->loadEvents();
        $this->loadSpawn();
    }

    /**
     * @return void
     */
    public function loadFiles(): void{
         $this->saveResource("config.yml");
         $this->config = new Config($this->getDataFolder() . "config.yml");
         $this->spawn = new Config($this->getDataFolder() . "spawn.yml");
    }

    public function loadCheck(){
        # CONFIG
        if((!$this->config->exists("config-version")) || ($this->config->get("config-version") != self::CONFIG_VERSION)){
            rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_old.yml");
            $this->saveResource("config.yml");
            $this->getLogger()->critical("Your configuration file is outdated.");
            $this->getLogger()->notice("Your old configuration has been saved as config_old.yml and a new configuration file has been generated. Please update accordingly.");
        }
    }

    /**
     * @return void
     */
    public function loadVirions(): void{
        foreach([
            "FormsUI" => FormsUI::class,
            "LibBook" => LibBook::class,
            "SimplePacketHandler" => SimplePacketHandler::class,
            "Commando" => BaseCommand::class,
            "libPiggyUpdateChecker" => libPiggyUpdateChecker::class
            ] as $virion => $class
        ){
            if(!class_exists($class)){
                $this->getLogger()->error($virion . " virion not found. Please download JoinACM from Poggit-CI or use DEVirion (not recommended).");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
        }
        if(!PacketHooker::isRegistered()){
            PacketHooker::register($this);
        }
        
        if(!LibBook::isRegistered()){
            LibBook::register($this);
        }
        # Update
        libPiggyUpdateChecker::init($this);
    }

    /**
     * @return void
     */
    public function loadEvents(): void{
        Server::getInstance()->getPluginManager()->registerEvents(new Event($this), $this);
    }

    /**
     * @return void
     */
    public function loadCommands(): void{
        Server::getInstance()->getCommandMap()->register("joinacm", new JoinCommand($this));
    }

    /**
     * @return void
     */
    public function loadSpawn(): void{
        $config = $this->config;
        if($config->getNested("SpawnMode.joinSpawn") === "CUSTOM"){
            if(isset($spawn["World"], $spawn["X"], $spawn["Y"], $spawn["Z"], $spawn["Yaw"], $spawn["Pitch"])){
                Server::getInstance()->getWorldManager()->loadWorld($spawn["World"]);
            }
        }
    }

    /**
     * @return Loader
     */
    public static function getInstance(): Loader{
        return self::$instance;
    }

    /**
     * @param Player $player
     * @param string $key
     * @return string
     */
    public static function getMessage(Player $player, string $key): string{
        $messageArray = self::$instance->config->getNested($key, []);
        if(!is_array($messageArray)){
            $messageArray = [$messageArray];
        }
        $message = implode("\n", $messageArray);
        return PluginUtils::codeUtil($player, $message);
    }

    /**
     * @return string
     */
    public static function Prefix(): string{
        return TextFormat::colorize(self::$instance->config->get("Prefix"));
    }
}
