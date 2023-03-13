<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
namespace fernanACM\JoinACM\forms;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\item\VanillaItems;

use pocketmine\console\ConsoleCommandSender;

use pocketmine\utils\TextFormat;

use cooldogedev\libBook\LibBook;
use Vecnavium\FormsUI\SimpleForm;

use fernanACM\JoinACM\Loader;
use fernanACM\JoinACM\utils\JoinModeUtils;
use fernanACM\JoinACM\utils\PluginUtils;

class JoinForm{
    
    /**
     * @param Player $player
     * @return void
     */
    public static function getJoinUI(Player $player): void{
        $config = Loader::getInstance()->config;
        $form = new SimpleForm(function(Player $player, $data) use($config){
            if($data === null){
                JoinModeUtils::sendFormMessage($player);
                PluginUtils::PlaySound($player, $config->getNested("JoinUI.Sounds.closeForm"), 1, 1);
                return true;
            }
            $buttons = Loader::getInstance()->config->getNested("JoinUI.buttons");
            foreach($buttons as $buttonName => $button){
                if(isset($button["command"])){
                    $buttonCommand = $button["command"];
                    $target = $button["target"] ?? "PLAYER";
                    if($data === $buttonName){
                        if($buttonCommand !== null && $buttonCommand !== ""){
                            switch($target){
                                case "PLAYER":
                                    Server::getInstance()->dispatchCommand($player, $buttonCommand);
                                    PluginUtils::PlaySound($player, $config->getNested("JoinUI.Sounds.clickTheButton"), 1, 1);
                                    JoinModeUtils::sendFormMessage($player);
                                    PluginUtils::PlaySound($player, $config->getNested("JoinUI.Sounds.clickTheButton"), 1, 1);
                                    break;
                                case "CONSOLE":
                                    $command = str_replace("{PLAYER}", $player->getName(), $buttonCommand);
                                    Server::getInstance()->dispatchCommand(new ConsoleCommandSender(Server::getInstance(), Server::getInstance()->getLanguage()), $command);
                                    JoinModeUtils::sendFormMessage($player);
                                    PluginUtils::PlaySound($player, $config->getNested("JoinUI.Sounds.clickTheButton"), 1, 1);
                                    break;
                            }
                        }else{
                            JoinModeUtils::sendFormMessage($player);
                            PluginUtils::PlaySound($player, $config->getNested("JoinUI.Sounds.clickTheButton"), 1, 1);
                        }
                    }
                }else{
                    JoinModeUtils::sendFormMessage($player);
                    PluginUtils::PlaySound($player, $config->getNested("JoinUI.Sounds.clickTheButton"), 1, 1);
                }
            }
        });
        $form->setTitle(Loader::getMessage($player, "JoinUI.title"));
        $form->setContent(Loader::getMessage($player, "JoinUI.content"));
        // buttons
        $buttons = Loader::getInstance()->config->getNested("JoinUI.buttons");
        foreach($buttons as $buttonName => $button){
            $url = str_starts_with($button["image"], "http://") || str_starts_with($button["image"], "https://");
            if(isset($button["name"])){
                $buttonInfo = str_replace(["{LINE}"], ["\n"], TextFormat::colorize($button['name']));
                $form->addButton($buttonInfo, $url ? 1 : 0, $button["image"] ?? null, $buttonName);
            }            
        }
        $player->sendForm($form);
    } 
    
    /**
     * @param Player $player
     * @return void
     */
    public static function getJoinBookUI(Player $player): void {
        $book = VanillaItems::WRITTEN_BOOK();
        $book->setTitle(TextFormat::colorize(Loader::getInstance()->config->getNested("BookUI.title")));
        $book->setAuthor(TextFormat::colorize(Loader::getInstance()->config->getNested("BookUI.author")));
        $pages = Loader::getInstance()->config->getNested("BookUI.pages");
        foreach($pages as $pageName => $pageData){
            $content = implode("\n", $pageData["content"]);
            $content = str_replace(["{LINE}"], ["\n"], $pageData["content"]);
            $book->setPageText($pageData["page"], TextFormat::colorize($content));
        }
        LibBook::sendPreview($player, $book);
    }
}