<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\base\condition;

use aieuo\mineflow\flowItem\FlowItemExecutor;

abstract class TakeMoneyConditionBase extends MoneyConditionBase {

    protected function onExecute(FlowItemExecutor $source): \Generator {
        $name = $source->replaceVariables($this->getPlayerName());
        $amount = $this->getInt($source->replaceVariables($this->getAmount()), 1);

        $myMoney = yield from $this->getMoney($name);
        if ($myMoney >= $this->getAmount()) {
            yield from $this->takeMoney($name, $amount);
            return true;
        }

        return false;
    }

    abstract protected function getMoney(string $name): \Generator;

    abstract protected function takeMoney(string $name, int $amount): \Generator;
}
