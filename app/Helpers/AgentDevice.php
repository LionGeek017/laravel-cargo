<?php
use Jenssegers\Agent\Agent;

function agentDevice() {
    $agent = new Agent();
    if($agent->isDesktop()) {
        $device = 'Компьютер';
    } else if($agent->isPhone()) {
        $device = 'Телефон';
    } else if($agent->isTablet()) {
        $device = 'Планшет';
    } else if($agent->isRobot()) {
        $device = 'Робот';
    } else {
        $device = null;
    }
    return $device;
}
