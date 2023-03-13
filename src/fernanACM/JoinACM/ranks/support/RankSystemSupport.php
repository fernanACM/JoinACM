<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
namespace fernanACM\JoinACM\ranks\support;

use IvanCraft623\RankSystem\RankSystem;

use fernanACM\JoinACM\ranks\RankSupport;

class RankSystemSupport implements RankSupport{

    /**
     * @return boolean
     */
    public function isAvailable(): bool {
        return class_exists(RankSystem::class);
    }

    /**
     * @param string $playerName
     * @return string
     */
    public function getRank(string $playerName): string{
        $rank = RankSystem::getInstance()->getRankManager()->getRank($playerName);
        if(!($rank instanceof \IvanCraft623\RankSystem\rank\Rank)){
            return '';
        }
        return $rank->getName();
    }
}