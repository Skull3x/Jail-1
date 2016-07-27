<?php
/*
 * This file is a part of UltimateParticles.
 * Copyright (C) 2016 hoyinm14mc
 *
 * UltimateParticles is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * UltimateParticles is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with UltimateParticles. If not, see <http://www.gnu.org/licenses/>.
 */

namespace hoyinm14mc\jail\tasks;

use hoyinm14mc\jail\base\BaseTask;

class TimeBroadcastTask extends BaseTask
{

    private $dots = "";

    public function onRun($currentTick)
    {
        $t = $this->getPlugin()->data->getAll();
        foreach ($this->getPlugin()->getAllJailedPlayerNames() as $name) {
            $player = $this->getPlugin()->getServer()->getPlayer($name);
            if ($player !== null) {
                $length = strlen("&3You have been jailed!");
                if (strlen($this->dots) + 5 != $length) {
                    $this->dots = $this->dots . ">";
                } else {
                    $this->dots = "";
                }
                if(isset($t[$name]["seconds"])){
                    $time = $t[$name]["seconds"];
                    $seconds = $time;
                    $minutes = 0;
                    $hours = 0;
                    while ($seconds > 59) {
                        $minutes = $minutes + 1;
                        $seconds = $seconds - 60;
                    }
                    while ($minutes > 59) {
                        $hours = $hours + 1;
                        $minutes = $minutes - 60;
                    }
                    $time_dis = "&e" . ($hours < 10 ? "0" . $hours : $hours) . "&b:&e" . ($minutes < 10 ? "0" . $minutes : $minutes) . "&b:&e" . ($seconds < 10 ? "0" . $seconds : $seconds);
                    $player->sendTip($this->getPlugin()->colorMessage("&3You have been jailed!\n&6Time left: " . $time_dis . "\n&l&c" . $this->dots));
                }else{
                    $player->sendTip($this->getPlugin()->colorMessage("&3You have been jailed!\n&6Time left: &einfinite\n&l&c" . $this->dots));
                }
            }
        }
    }

}

?>