<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\bedrockEconomy\action;

use aieuo\moreactions\economy\base\action\SetMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyExtension;

class BedrockEconomySetMoney extends SetMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $amount = "") {
        parent::__construct(BedrockEconomyExtension::ACTION_SET_MONEY, BedrockEconomyExtension::CATEGORY_NAME, $playerName, $amount);
    }

    protected function setMoney(string $name, int $amount): \Generator {
        yield from BedrockEconomyAPIWrapper::setMoney($name, $amount);
    }
}
