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
# Libs
use Vecnavium\FormsUI\FormsUI;
use muqsit\simplepackethandler\SimplePacketHandler;

use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\PacketHooker;

use DaPigGuy\libPiggyUpdateChecker\libPiggyUpdateChecker;

use fernanACM\JoinACM\utils\PluginUtils;

class Loader extends PluginBase{
    
    /** @var Config $config */
    public Config $config;

    /** @var Config $messages */
    public Config $messages;

    /** @var Loader $instance */
    public static Loader $instance;

    # CheckConfig
    public const CONFIG_VERSION = "1.0.0";
    public const LANGUAGE_VERSION = "1.0.0";

     # MultiLanguages
    public const LANGUAGES = [
        "eng", // English
        "spa", // Spanish
        "ger", // German
        "frc", // French
        "portg", // Portuguese
        "indo", // Indonesian
        "vie" // Vietnamese
    ];

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
    }

    public function loadFiles(){
         # Config files
         @mkdir($this->getDataFolder() . "languages");
         $this->saveResource("config.yml");
         $this->config = new Config($this->getDataFolder() . "config.yml");
         # Languages
         foreach(self::LANGUAGES as $language){
             $this->saveResource("languages/" . $language . ".yml");
         }
         $this->messages = new Config($this->getDataFolder() . "languages/" . $this->config->get("language") . ".yml");
    }

    public function loadCheck(){
        # Update
        libPiggyUpdateChecker::init($this);
        # CONFIG
        if((!$this->config->exists("config-version")) || ($this->config->get("config-version") != self::CONFIG_VERSION)){
            rename($this->getDataFolder() . "config.yml", $this->getDataFolder() . "config_old.yml");
            $this->saveResource("config.yml");
            $this->getLogger()->critical("Your configuration file is outdated.");
            $this->getLogger()->notice("Your old configuration has been saved as config_old.yml and a new configuration file has been generated. Please update accordingly.");
        }
        # LANGUAGES
        $data = new Config($this->getDataFolder() . "languages/" . $this->config->get("language") . ".yml");
        if((!$data->exists("language-version")) || ($data->get("language-version") != self::LANGUAGE_VERSION)){
            rename($this->getDataFolder() . "languages/" . $this->config->get("language") . ".yml", $this->getDataFolder() . "languages/" . $this->config->get("language") . "_old.yml");
            foreach(self::LANGUAGES as $language){
                $this->saveResource("languages/" . $language . ".yml");
            }
            $this->getLogger()->critical("Your ".$this->config->get("language").".yml file is outdated.");
            $this->getLogger()->notice("Your old ".$this->config->get("language").".yml has been saved as ".$this->config->get("language")."_old.yml and a new ".$this->config->get("language").".yml file has been generated. Please update accordingly.");
        }
    }

    public function loadVirions(){
        foreach ([
            "FormsUI" => FormsUI::class,
            "SimplePacketHandler" => SimplePacketHandler::class,
            "Commando" => BaseCommand::class,
            "libPiggyUpdateChecker" => libPiggyUpdateChecker::class
            ] as $virion => $class
        ){
            if(!class_exists($class)){
                $this->getLogger()->error($virion . " virion not found. Please download PvPShop from Poggit-CI or use DEVirion (not recommended).");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
        }

        if(!PacketHooker::isRegistered()){
            PacketHooker::register($this);
        }
    }

    public function loadEvents(){
        Server::getInstance()->getPluginManager()->registerEvents(new Event($this), $this);
    }

    public function loadCommands(){
        Server::getInstance()->getCommandMap()->register("pvpshop", new ShopCommand($this, "pvpshop", "Item shop for PvP use by fernanACM", ["pshop"]));
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
        return PluginUtils::codeUtil($player, self::$instance->messages->getNested($key, $key));
    }
}
