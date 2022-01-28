<?php

/*
 * Get player height location relative to sea level using command
 * Copyright (C) 2021-2022 KygekDev
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
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Height extends PluginBase {

    private const PREFIX = TF::YELLOW . "[Height] " . TF::RESET;
    private const COMMAND_PERMISSION = "height.command";

    private const SEA_LEVEL = 63;

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
        if ($command->getName() !== "height" || !$sender->hasPermission(self::COMMAND_PERMISSION)) return true;

        if (!isset($args[0])) {
            if (!$sender instanceof Player) return false;

            $height = self::getHeight($sender);
            $this->sendMessage($sender, "You're " . ($height >= 0 ? $height . "m above" : abs($height) . "m below") . " sea level");
            return true;
        }

        $player = $this->getServer()->getPlayerByPrefix($args[0]);
        if (!$player) {
            $sender->sendMessage(self::PREFIX . TF::RED . "Player is not online!");
            return true;
        }

        $height = self::getHeight($player);
        $this->sendMessage($sender, "Player " . $player->getName() . " is " . ($height >= 0 ? $height . "m above" : abs($height) . "m below")  . " sea level");
        return true;
    }

    /**
     * Gets player's height location (Y coordinate) relative to sea level
     *
     * @param Player $player    Player to get height location of
     * @param int $precision    Number of decimal places to pass to the round() function
     * @return float
     */
    public static function getHeight(Player $player, int $precision = 1) : float {
        return round($player->getPosition()->getY() - self::SEA_LEVEL, $precision);
    }

    private function sendMessage(CommandSender $sender, string $message) {
        $sender->sendMessage(self::PREFIX . TF::GREEN . $message);
    }

}