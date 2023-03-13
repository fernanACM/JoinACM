<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
namespace fernanACM\JoinACM\ranks\support;

use alvin0319\GroupsAPI\GroupsAPI;

use fernanACM\JoinACM\ranks\RankSupport;

class GroupsAPISupport implements RankSupport{

    /**
     * @return boolean
     */
    public function isAvailable(): bool{
        return class_exists(GroupsAPI::class);
    }

    /**
     * @param string $playerName
     * @return string
     */
    public function getRank(string $playerName): string{
        $group = GroupsAPI::getInstance()->getMemberManager()->getMember($playerName);
        if(!($group instanceof \alvin0319\GroupsAPI\user\Member)){
            return '';
        }
        return $group->getName();
    }
}