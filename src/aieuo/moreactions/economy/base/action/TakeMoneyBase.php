<?php

declare(strict_types=1);

namespace aieuo\moreactions\economy\base\action;

use aieuo\mineflow\flowItem\FlowItemExecutor;

abstract class TakeMoneyBase extends MoneyActionBase {

    public function onExecute(FlowItemExecutor $source): \Generator {
        $name = $source->replaceVariables($this->getPlayerName());
        $amount = $this->getInt($source->replaceVariables($this->getAmount()), 1);

        yield from $this->takeMoney($name, $amount);
    }

    abstract protected function takeMoney(string $name, int $amount): \Generator;
}
