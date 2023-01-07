<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\base\condition;

use aieuo\mineflow\flowItem\FlowItemExecutor;

abstract class OverMoneyBase extends MoneyConditionBase {

    protected function onExecute(FlowItemExecutor $source): \Generator {
        $name = $source->replaceVariables($this->getPlayerName());
        $amount = $this->getInt($source->replaceVariables($this->getAmount()));

        $myMoney = yield from $this->getMoney($name);

        return $myMoney >= $amount;
    }

    abstract protected function getMoney(string $name): \Generator;
}
