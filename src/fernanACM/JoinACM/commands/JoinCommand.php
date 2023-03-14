<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
 
namespace fernanACM\JoinACM\commands;

use pocketmine\player\Player;

use CortexPE\Commando\BaseCommand;
use fernanACM\JoinACM\commands\subcommands\RemoveSpawnSubCommand;
use fernanACM\JoinACM\commands\subcommands\SpawnSubCommand;
use Vecnavium\FormsUI\SimpleForm;

use pocketmine\command\CommandSender;

use fernanACM\JoinACM\Loader;
use fernanACM\JoinACM\forms\JoinForm;
use fernanACM\JoinACM\utils\PluginUtils;

class JoinCommand extends BaseCommand{

    public function __construct(){
        parent::__construct(Loader::getInstance(), "joinacm", "§r§fOpen menu JoinACM to view your welcome by §bfernanACM", ["join"]);
        $this->setPermission("joinacm.command");
    }
    /**
     * @return void
     */
    protected function prepare(): void{
        $this->registerSubCommand(new SpawnSubCommand("setspawn", "§r§fDefining custom JoinACM spawn by §bfernanACM", ["setjoin"]));
        $this->registerSubCommand(new RemoveSpawnSubCommand("removespawn", "§r§fRemover custom JoinACM spawn by §bfernanACM", ["removejoin"]));
    }

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     * @return void
     */
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
        if(!$sender instanceof Player){
            $sender->sendMessage("Use this command in-game");
            return;
        }

        if(!$sender->hasPermission("joinacm.command")){
            $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }

        $form = new SimpleForm(function(Player $player, $data){
            if($data === null){
                PluginUtils::PlaySound($player, "random.pop2", 1, 1.5);
                return true;
            }
            switch($data){
                case 0: // FormUI
                    JoinForm::getJoinUI($player);
                    PluginUtils::PlaySound($player, "random.pop", 1, 1.5);
                break;

                case 1: // BooKUI
                    JoinForm::getJoinBookUI($player);
                    PluginUtils::PlaySound($player, "random.pop", 1, 1.5);
                break;

                case 2:
                break;
            }
        });
        $form->setTitle("§l§9JoinACM");
        $form->addButton("FormUI");
        $form->addButton("BookUI");
        $form->addButton("Close menu");
        $sender->sendForm($form);
    }
}
