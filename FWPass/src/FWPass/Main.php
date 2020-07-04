<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 03/07/2020
 * Time: 18:11
 */

namespace FWPass;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\Player;

use jojoe77777\FormAPI\SimpleForm;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\utils\TextFormat;





class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getScheduler()->scheduleRepeatingTask(new UpgradeTask($this), 20);
        if($this->getServer()->getPluginManager()->getPlugin("OnlineTime") === null){
            $this->getLogger()->critical("FWPass requires OnlineTime, disabling the plugin.");
            $this->getServer()->getPluginManager()->disablePlugin($this);
        }


        if($this->getServer()->getPluginManager()->getPlugin("FormAPI") === null){
            $this->getLogger()->critical("FWPass requires OnlineTime, disabling the plugin.");
            $this->getServer()->getPluginManager()->disablePlugin($this);
        }

    }

    public function onCommand(CommandSender $player, Command $cmd, string $label, array $args) : bool{
        switch($cmd->getName()) {
            case "pass":
                if($player->hasPermission("fw.pass.openui")){
                    if($player instanceof Player){
                        $this->MainUI($player);
                    }else{
                        $this->getLogger()->notice("You can use this command only in FW Server Lobby");
                    }
                }else{
                    $player->sendMessage("§l§cFWMC §r§7» §aNo.Perm.Core");
                }
        }
        return true;
    }

    public function MainUI($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, ?int $data){
            if ($data === null){
                return true;
            }
            switch($data){
                case 0:
                    $this->PassInfo($player);
                    return true;
                    break;

                case 1:
                    if($player->hasPermission("fw.pass.status")){
                        $this->PassStatus($player);
                    }
                    return true;
                    break;

                case 2:
                    if($player->hasPermission("fw.pass.rewards")){
                        $this->PassRewards($player);
                    }
                    return true;
            }
            return true;
        });
        $form->setTitle("§l§dFW Pass");
        $form->setContent("§bSeason 0§7 » §eTechnical Test\n§aSeason Ending §7» §c15/08");
        $form->addButton("§cPass Information\n§0FW Pass Info", SimpleForm::IMAGE_TYPE_PATH, "textures/ui/Caution");
        $form->addButton("§cPass Status\n§0Check Your Status", SimpleForm::IMAGE_TYPE_PATH, "textures/ui/conduit_power_effect");
        $form->addButton("§cPass Rewards\n§0Check Pass Rewards", SimpleForm::IMAGE_TYPE_PATH, "textures/persona_thumbnails/plain_eyes_thumbnail_0");
        $form->sendToPlayer($player);
    }

    public function PassInfo($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $player, ?array $data){

         });

        $form->setTitle("§l§dFW Pass Info");
        $form->addLabel("§aThe FW Pass is a cosmetic - redeem system\nwhere you can collect multiple unique rewards only for Pass Owners.\n§o §r\nThe FW Pass is only available by buying it \n§6Price: 5$");
        $form->addLabel("§bStay online and play games to level up!");
        $form->sendToPlayer($player);
    }

    public function PassStatus($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $player, ?array $data){

        });

        $form->setTitle("§l§dFW Pass Info");
        $form->addLabel("§cYour current FW Pass status:");
        $form->addLabel("§6Pass Level: §9Technical Test LVL");
        $form->addLabel("§3Remember: Stay online and play to level up!");
        $form->sendToPlayer($player);
    }

    public function PassRewards($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, ?int $data){
            if ($data === null){
                return true;
            }
            switch($data){
                case 0:

                    return true;
                    break;

                case 1:

                    return true;
                    break;

                case 2:

                    return true;
                    break;

                case 3:

                    return true;
                    break;

                case 4:
                    return true;
            }
            return true;
        });
        $form->setTitle("§l§dFW Pass");
        $form->setContent("FW Pass Season 0 Rewards");
        $form->addButton("§eHoney §6§lTAG\n§r§0Level 1", SimpleForm::IMAGE_TYPE_PATH, "textures/blocks/honeycomb");
        $form->addButton("§9300 Mystery Dust\n§0Level 2", SimpleForm::IMAGE_TYPE_PATH, "textures/items/glowstone_dust");
        $form->addButton("§cTechnical Tester §6§lTAG\n§r§0Level 3", SimpleForm::IMAGE_TYPE_PATH, "textures/items/dye_powder_cyan");
        $form->addButton("§9300 Mystery Dust\n§0Level 4", SimpleForm::IMAGE_TYPE_PATH, "textures/items/glowstone_dust");
        $form->addButton("§5The OG Player §dTITLE\n§0Level 5", SimpleForm::IMAGE_TYPE_PATH, "textures/items/crossbow_firework");
        $form->sendToPlayer($player);
    }



}