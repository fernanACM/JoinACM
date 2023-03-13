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
use pocketmine\network\mcpe\protocol\OnScreenTextureAnimationPacket;

class PluginUtils {

    /**
     * @param Player $player
     * @param string $sound
     * @param int $volume
     * @param float $pitch
     * @return void
     */
	public static function PlaySound(Player $player, string $sound, int $volume, float $pitch){
		$packet = new PlaySoundPacket();
		$packet->x = $player->getPosition()->getX();
		$packet->y = $player->getPosition()->getY();
		$packet->z = $player->getPosition()->getZ();
		$packet->soundName = $sound;
		$packet->volume = $volume;
		$packet->pitch = $pitch;
		$player->getNetworkSession()->sendDataPacket($packet);
	}
    
    /**
     * @param Player $player
     * @param string $soundName
     * @param int $volume
     * @param float $pitch
     * @return void
     */
    public static function BroadSound(Player $player, string $soundName, int $volume, float $pitch){
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

    /**
     * @param Player $player
     * @param string $message
     * @return string
     */
	public static function codeUtil(Player $player, string $message): string{
       $replacements = [
            "{LINE}" => "\n",
            "{NAME}" => $player->getName(),
            "&" => "§",
            "{HEALTH}" => $player->getHealth(),
            "{MAX_HEALTH}" => $player->getMaxHealth(),
            "{FOOD}" => $player->getHungerManager()->getFood(),
            "{MAX_FOOD}" => $player->getHungerManager()->getMaxFood(),
            "{PING}" => $player->getNetworkSession()->getPing(),
            "{WORLD_NAME}" => $player->getWorld()->getFolderName(),
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
        return strtr($message, $replacements);
    }

    /**
     * @param Player $player
     * @param int $effectId
     * @return void
     */
    public static function AminationTexture(Player $player, int $effectId){
        $packet = new OnScreenTextureAnimationPacket();
        $packet->effectId = $effectId;
        $player->getNetworkSession()->sendDataPacket($packet);
    }
}