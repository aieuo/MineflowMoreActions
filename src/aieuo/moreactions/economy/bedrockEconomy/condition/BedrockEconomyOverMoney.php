<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\bedrockEconomy\condition;

use aieuo\moreactions\economy\base\condition\OverMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyExtension;

class BedrockEconomyOverMoney extends OverMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $amount = "") {
        parent::__construct(BedrockEconomyExtension::CONDITION_OVER_MONEY, BedrockEconomyExtension::CATEGORY_NAME, $playerName, $amount);
    }

    protected function getMoney(string $name): \Generator {
        return yield from BedrockEconomyAPIWrapper::getMoney($name);
    }
}
