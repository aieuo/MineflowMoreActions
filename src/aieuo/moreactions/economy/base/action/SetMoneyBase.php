<?php

declare(strict_types=1);

namespace aieuo\moreactions\economy\base\action;

use aieuo\mineflow\flowItem\FlowItemExecutor;

abstract class SetMoneyBase extends MoneyActionBase {

    public function onExecute(FlowItemExecutor $source): \Generator {
        $name = $source->replaceVariables($this->getPlayerName());
        $amount = $this->getInt($source->replaceVariables($this->getAmount()), 0);

        yield from $this->setMoney($name, $amount);
    }

    abstract protected function setMoney(string $name, int $amount): \Generator;
}
