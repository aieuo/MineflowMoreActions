<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\bedrockEconomy\condition;

use aieuo\moreactions\economy\base\condition\LessMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyExtension;

class BedrockEconomyLessMoney extends LessMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $amount = "") {
        parent::__construct(BedrockEconomyExtension::CONDITION_LESS_MONEY, BedrockEconomyExtension::CATEGORY_NAME, $playerName, $amount);
    }

    protected function getMoney(string $name): \Generator {
        return yield from BedrockEconomyAPIWrapper::getMoney($name);
    }
}
