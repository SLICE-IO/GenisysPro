<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 27/07/2017
 * Time: 16:57
 */

namespace pocketmine\inventory\InventoryCustom;


use pocketmine\inventory\ChestInventory;
use pocketmine\inventory\InventoryType;
use pocketmine\Player;

class CustomChestInventory extends ChestInventory
{

    public function __construct(CustomChest $tile){
        parent::__construct($tile);
    }
    public function onOpen(Player $who){
        parent::onOpen($who);
    }
    public function onClose(Player $who){
        $this->holder->sendReplacement($who);
        parent::onClose($who);
        $this->holder->close();
    }

}