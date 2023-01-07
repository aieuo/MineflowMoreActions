<?php

declare(strict_types=1);

namespace aieuo\moreactions\economy\base\action;

use aieuo\mineflow\flowItem\FlowItemExecutor;

abstract class AddMoneyBase extends MoneyActionBase {

    protected function onExecute(FlowItemExecutor $source): \Generator {
        $name = $source->replaceVariables($this->getPlayerName());
        $amount = $this->getInt($source->replaceVariables($this->getAmount()), 1);

        yield from $this->addMoney($name, $amount);
    }

    abstract protected function addMoney(string $name, int $amount): \Generator;
}
