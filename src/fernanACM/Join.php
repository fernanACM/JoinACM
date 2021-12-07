<?php

namespace fernanACM;

use fernanACM\PluginUtils;

use pocketmine\Server;
use pocketmine\Player\player;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use fernanACM\FormsUI\SimpleForm;
use fernanACM\FormsUI\Form;
use fernanACM\FormsUI\FormsUI;

use pocketmine\utils\Utils;

class Join extends PluginBase implements Listener {
  
    public function onEnable(): void{
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
  
    public function onJoin(PlayerJoinEvent $event): void{
        $player = $event->getPlayer();
        $name = $player->getName();
        $event->setJoinMessage("");
        $player->teleport($this->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        $this->getJoinUI($player);
        PluginUtils::PlaySound($player, $this->getConfig()->get("PlaySoundJoin"), 1, 1.5);
        $this->getServer()->broadcastMessage("§8[§r§a+§8]§r §a$name");
    }
    
    public function onQuit(PlayerQuitEvent $event): void{
        $player = $event->getPlayer();
        $name = $player->getName();
        $event->setQuitMessage("");
        PluginUtils::PlaySound($player, $this->getConfig()->get("PlaySoundQuit"), 1, 1.5);
        $this->getServer()->broadcastMessage("§8[§r§c-§8]§r §c$name");
    }
    
    public function getJoinUI($sender){
        $form = new SimpleForm(function (Player $sender, $data){
           $result = $data;
              if($result === null){
                  return true;
            }
              switch($result){
                  case 0:
                      $sender->sendMessage($this->getConfig()->get("Join-Message"));
                      $sender->sendTitle($this->getConfig()->get("Join-Title")); 
                      $sender->sendSubTitle($this->getConfig()->get("Join-SubTitle"));
                      PluginUtils::PlaySound($sender, $this->getConfig()->get("PlaySoundButton"), 1, 1.5);
                  break;
              }
        });
        $form->setTitle($this->getConfig()->get("JoinUI-Title"));
        $form->setContent($this->getConfig()->get("JoinUI-Content"));
        $form->addButton($this->getConfig()->get("JoinUI-Button"),0,"textures/ui/controller_glyph_color");
        $form->sendToPlayer($sender);
        return $form;
    }
}
