<?php

/*
 * Get player height location relative to sea level using command
 * Copyright (C) 2021 KygekDev
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace KygekDev\Height;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Height extends PluginBase {

    private const PREFIX = TF::YELLOW . "[Height] " . TF::RESET;
    private const COMMAND_PERMISSION = "height.command";

    private const SEA_LEVEL = 63;

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
        if ($command->getName() !== "height" || !$sender->hasPermission(self::COMMAND_PERMISSION)) return true;

        if (!isset($args[0])) {
            if (!$sender instanceof Player) {
                $this->sendMessage($sender, "Usage: /height <player>");
                return true;
            }

            $height = $this->getHeight($sender);
            $this->sendMessage($sender, "You're " . ($height >= 0 ? $height . "m above" : abs($height) . "m below") . " sea level");
            return true;
        }

        $player = $this->getServer()->getPlayer($args[0]);
        if ($player === null) {
            $sender->sendMessage(self::PREFIX . TF::RED . "Player is not online!");
            return true;
        }

        $height = $this->getHeight($player);
        $this->sendMessage($sender, "Player " . $player->getName() . " is " . ($height >= 0 ? $height . "m above" : abs($height) . "m below")  . " sea level");
        return true;
    }

    private function getHeight(Player $player) : float {
        return round($player->getY() - self::SEA_LEVEL, 1);
    }

    private function sendMessage(CommandSender $sender, string $message) {
        $sender->sendMessage(self::PREFIX . TF::GREEN . $message);
    }

}