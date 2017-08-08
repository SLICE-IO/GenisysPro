<?php

namespace pocketmine\inventory;

use pocketmine\block\Block;
use pocketmine\inventory\InventoryCustom\CustomChestInventory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\Player;
use pocketmine\tile\Tile;

class InventoryAPI{

    /**
     * @param Player $player
     * @param bool $autoOpen
     * @return CustomChestInventory
     *
     * @by Muqsit NBT and ChestInventory System!
     */
    public function createInventory(Player $player, string $name, bool $autoOpen = false){
        $tile = Tile::createTile("CustomChest", $level = $player->getLevel(), new CompoundTag("", [
            new StringTag("id", Tile::CHEST),
            new StringTag("CustomName", $name),
            new IntTag("x", (int) $player->x),
            new IntTag("y", (int) $player->y + 3),
            new IntTag("z", (int) $player->z),
        ]));
        $block = Block::get(Block::CHEST);
        $block->x = (int) $tile->x;
        $block->y = (int) $tile->y;
        $block->z = (int) $tile->z;
        $block->level = $level;
        $block->level->sendBlocks([$player], [$block]);
        $inventory = new CustomChestInventory($tile);
        $tile->spawnTo($player);
        if($autoOpen){
            $player->addWindow($inventory, 15);
        }
        return $inventory;
    }

    public function getInventory(Inventory $inventory){
        if($inventory instanceof CustomChestInventory) return $inventory;
        return null;
    }


}
