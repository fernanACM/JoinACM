<?php

namespace fernanACM\JoinACM;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\utils\Utils;
use pocketmine\utils\Config;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use fernanACM\JoinACM\FormsUI\SimpleForm;
use fernanACM\JoinACM\PluginUtils;
use fernanACM\JoinACM\commands\JoinCommand;

use function str_replace;

class Join extends PluginBase implements Listener {
    
    private $join;
  
    public function onEnable(): void{
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->join = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->register("joinacm", new JoinCommand($this));
    }
  
    public function onJoin(PlayerJoinEvent $event): void{
        $player = $event->getPlayer();
        $event->setJoinMessage("");
        if ($this->join->get("Spawn-Teleport", true) === true) {
             $player->teleport($this->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        }
        $this->getJoinUI($player);
        if ($this->join->get("JoinSound", true) === true) {
            PluginUtils::PlaySound($player, $this->join->get("PlaySoundJoin"), 1, 1);
        }
        if ($this->join->get("PlayerJoin", true) === true) {
        $message1 = $this->join->get("PlayerJoinMessage");
        $this->getServer()->broadcastMessage(str_replace("{PLAYER}", $player->getName(), $message1));
        }
    }
    
    public function onQuit(PlayerQuitEvent $event): void{
        $player = $event->getPlayer();
        $event->setQuitMessage("");
        if ($this->join->get("QuitSound", true) === true) {
            PluginUtils::PlaySound($player, $this->join->get("PlaySoundQuit"), 1, 1);
        }
        if ($this->join->get("PlayerQuit", true) === true) {
        $message2 = $this->join->get("PlayerQuitMessage");
        $this->getServer()->broadcastMessage(str_replace("{PLAYER}", $player->getName(), $message2));
        }
    }
    
    public function getJoinUI(Player $player){
        $form = new SimpleForm(function(Player $player, $data){
            if($data !== null){
              switch($data){
                  case 0:
                      if ($this->join->get("JoinACM-Message", true) === true) {
                          $player->sendMessage($this->join->get("Join-Message"));
                      }
                      if ($this->join->get("Join-Titles", true) === true) {
                          $player->sendTitle($this->join->get("Join-Title"));
                      } 
                      if ($this->join->get("Join-Titles", true) === true) {
                          $player->sendSubTitle($this->join->get("Join-SubTitle"));
                      }
                      if ($this->join->get("ButtonSound", true) === true) {
                          PluginUtils::PlaySound($player, $this->join->get("PlaySoundButton"), 1, 1);
                      }
                  break;
                  }
              }
        });
        $form->setTitle($this->join->get("JoinUI-Title"));
        $form->setContent($this->join->get("JoinUI-Content"));
        $form->addButton($this->join->get("JoinUI-Button"),0,"textures/ui/controller_glyph_color");
        $player->sendForm($form);
    }
}
