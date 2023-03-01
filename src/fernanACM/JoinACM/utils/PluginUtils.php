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

use pocketmine\utils\TextFormat;

use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class PluginUtils {

	public static function PlaySound(Player $player, string $sound, $volume = 1, $pitch = 1) {
		$packet = new PlaySoundPacket();
		$packet->x = $player->getPosition()->getX();
		$packet->y = $player->getPosition()->getY();
		$packet->z = $player->getPosition()->getZ();
		$packet->soundName = $sound;
		$packet->volume = 1;
		$packet->pitch = 1;
		$player->getNetworkSession()->sendDataPacket($packet);
	}
    
    public static function BroadSound(Player $player, string $soundName, int $volume = 500, float $pitch = 1){
        $packet = new PlaySoundPacket();
        $packet->soundName = $soundName;
        $position = $player->getPosition();
        $packet->x = $position->getX();
        $packet->y = $position->getY();
        $packet->z = $position->getZ();
        $packet->volume = $volume;
        $packet->pitch = $pitch;
        $world = $position->getWorld();
        $world->getServer()->broadcastPackets($world->getPlayers(), [$packet]);
    }

	public static function codeUtil(Player $player, string $message): string{
       $replacements = [
            "{LINE}" => "\n",
            "{NAME}" => $player->getName(),
            "&" => "§",
            # Colors
            "{BLACK}" => TextFormat::BLACK,
            "{DARK_BLUE}" => TextFormat::DARK_BLUE,
            "{DARK_GREEN}" => TextFormat::DARK_GREEN,
            "{CYAN}" => TextFormat::DARK_AQUA,
            "{DARK_RED}" => TextFormat::DARK_RED,
            "{PURPLE}" => TextFormat::DARK_PURPLE,
            "{GOLD}" => TextFormat::GOLD,
            "{GRAY}" => TextFormat::GRAY,
            "{DARK_GRAY}" => TextFormat::DARK_GRAY,
            "{BLUE}" => TextFormat::BLUE,
            "{GREEN}" => TextFormat::GREEN,
            "{AQUA}" => TextFormat::AQUA,
            "{RED}" => TextFormat::RED,
            "{PINK}" => TextFormat::LIGHT_PURPLE,
            "{YELLOW}" => TextFormat::YELLOW,
            "{WHITE}" => TextFormat::WHITE,
            "{ORANGE}" => "§6",
            # {BOLD} => "§l", {RESET} => "§r"
            "{BOLD}" => TextFormat::BOLD,
            "{RESET}" => TextFormat::RESET
        ];
        return str_replace(array_keys($replacements), $replacements, $message);
    }
}