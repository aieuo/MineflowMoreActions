<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\base\action;

use aieuo\moreactions\economy\base\MoneyFlowItemBase;

abstract class MoneyActionBase extends MoneyFlowItemBase {
    use MoneyActionNameWithMineflowLanguage;

    public function getDetailDefaultReplaces(): array {
        return ["target", "amount"];
    }

    public function getDetailReplaces(): array {
        return [$this->getPlayerName(), $this->getAmount()];
    }
}
