<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM
    
namespace fernanACM\JoinACM\ranks;

interface RankSupport{

    /**
     * @return bool
     */
    public function isAvailable(): bool;

    /**
     * @param string $playerName
     * @return string
     */
    public function getRank(string $playerName): string;
}