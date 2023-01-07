<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\base\condition;

use aieuo\mineflow\flowItem\condition\Condition;
use aieuo\moreactions\economy\base\MoneyFlowItemBase;

abstract class MoneyConditionBase extends MoneyFlowItemBase implements Condition {
    use MoneyConditionNameWithMineflowLanguage;

    public function getDetailDefaultReplaces(): array {
        return ["target", "amount"];
    }

    public function getDetailReplaces(): array {
        return [$this->getPlayerName(), $this->getAmount()];
    }
}
