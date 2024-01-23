<?php

/**
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://www.gnu.org/licenses/lgpl-3.0 LGPL-3.0 License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 *
 * @noinspection PhpUnused
 */

declare(strict_types=1);

namespace kim\present\consoleexporter\listener;

use kim\present\consoleexporter\Main;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\event\server\CommandEvent;
use pocketmine\utils\TextFormat;

/** The event listener for outputting command input */
class ConsoleCommandListener implements Listener{
    public function __construct(private Main $plugin){
    }

    /** @priority HIGHEST */
    public function onCommandEvent(CommandEvent $event) : void{
        if(!$this->plugin->isRecording() || !($event->getSender() instanceof ConsoleCommandSender)){
            return;
        }

        $command = trim($event->getCommand());
        if($command[0] === "#"){
            $event->cancel();
        }else{
            $this->plugin->writeBuffer(TextFormat::ITALIC);
        }
        $this->plugin->writeBuffer(TextFormat::GRAY . $command . TextFormat::RESET . PHP_EOL);
    }
}