<?php
declare(strict_types=1);


namespace aieuo\moreactions;

use aieuo\mineflow\flowItem\FlowItem;
use pocketmine\plugin\Plugin;

abstract class BaseFlowItem extends FlowItem {
    public function getPlugin(): ?Plugin {
        return Main::getInstance();
    }
}
