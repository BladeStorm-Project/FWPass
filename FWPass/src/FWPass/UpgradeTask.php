<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 04/07/2020
 * Time: 09:42
 */

namespace FWPass;

use pocketmine\Player;
use pocketmine\scheduler\Task;
use FWPass\Main;

class UpgradeTask extends Task{

    /** @var Main */
    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun($tick) : void{
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player)
            $this->upgradePass($player);
        return;
    }

    public function upgradePass(Player $player){
        $upgrader = $this->plugin->getServer()->getPluginManager()->getPlugin("OnlineTime");

        if($upgrader->getRealTimeMinutes($player) === 20){
            $pp = $this->plugin->getServer()->getPluginManager()->getPlugin("PurePerms");
            $pp->getUserDataMgr()->setPermission($player, "fw.tag.honey");
        }

        if($upgrader->getRealTimeMinutes($player) === 70){
            $pp = $this->plugin->getServer()->getPluginManager()->getPlugin("PurePerms");

        }

        if($upgrader->getRealTimeMinutes($player) === 180){
            $pp = $this->plugin->getServer()->getPluginManager()->getPlugin("PurePerms");
            $pp->getUserDataMgr()->setPermission($player, "fw.tag.techtester");
        }

        if($upgrader->getRealTimeMinutes($player) === 280){
            $pp = $this->plugin->getServer()->getPluginManager()->getPlugin("PurePerms");

        }

        if($upgrader->getRealTimeMinutes($player) === 400){
            $pp = $this->plugin->getServer()->getPluginManager()->getPlugin("PurePerms");
            $pp->getUserDataMgr()->setPermission($player, "fw.title.theogplayer");
        }
    }

}