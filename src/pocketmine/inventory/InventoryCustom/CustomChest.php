<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 27/07/2017
 * Time: 16:57
 */

namespace pocketmine\inventory\InventoryCustom;


use pocketmine\block\Block;
use pocketmine\level\Level;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\Player;
use pocketmine\tile\Chest;

class CustomChest extends Chest
{

    private $replacement;

    public function __construct(Level $level, CompoundTag $nbt)
    {
        parent::__construct($level, $nbt);
        $this->inventory = new CustomChestInventory($this);
        $this->replacement = [$this->getBlock()->getId(), $this->getBlock()->getDamage()];
    }

    private function getReplacement() : Block{
        return Block::get(...$this->replacement);
    }

    public function sendReplacement(Player $player){
        $block = $this->getReplacement();
        $block->x = (int) $this->x;
        $block->y = (int) $this->y;
        $block->z = (int) $this->z;
        $block->level = $this->getLevel();
        if($block->level !== null){
            $block->level->sendBlocks([$player], [$block]);
        }
    }

    public function spawnToAll(){
    }

}