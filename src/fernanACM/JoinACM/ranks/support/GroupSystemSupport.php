<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
namespace fernanACM\JoinACM\ranks\support;

use r3pt1s\GroupSystem\GroupSystem;

use fernanACM\JoinACM\ranks\RankSupport;

class GroupSystemSupport extends RankSupport{

    /**
     * @return boolean
     */
    public function isAvailable(): bool{
        return class_exists(GroupSystem::class);
    }

    /**
     * @param string $playerName
     * @return string
     */
    public function getRank(string $playerName): string{
        $group = GroupSystem::getInstance()->getPlayerGroupManager()->getPlayer($playerName);
        if(!($group instanceof \r3pt1s\GroupSystem\player\PlayerGroup)){
            return '';
        }
        return $group->getGroup()->getName();
    }
}