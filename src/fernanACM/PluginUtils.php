<?php

declare(strict_types=1);

namespace MenuScore;

use pocketmine\{Server, Player, level\Position};
use pocketmine\network\mcpe\protocol\{AddActorPacket, PlaySoundPacket, LevelSoundEventPacket, StopSoundPacket};

class PluginUtils {
    
    	public static function PlaySound(Player $player, string $sound, $volume = 1, $pitch = 1) {
		$pk = new PlaySoundPacket();
		$pk->x = $player->getX();
		$pk->y = $player->getY();
		$pk->z = $player->getZ();
		$pk->soundName = $sound;
		$pk->volume = $volume;
		$pk->pitch = $pitch;
		$player->dataPacket($pk);
	}
}
