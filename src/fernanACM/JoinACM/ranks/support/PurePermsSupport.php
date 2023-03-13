<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
namespace fernanACM\JoinACM\ranks\support;

use _64FF00\PurePerms\PurePerms;

use fernanACM\JoinACM\ranks\RankSupport;

class PurePermsSupport extends RankSupport{

    /**
     * @return boolean
     */
    public function isAvailable(): bool{
        return class_exists(PurePerms::class);
    }

    /**
     * @param string $playerName
     * @return string
     */
    public function getRank(string $playerName): string{
        $group = PurePerms::getInstance()->getUserDataMgr()->getGroup($playerName);
        return $group->getName();
    }
}