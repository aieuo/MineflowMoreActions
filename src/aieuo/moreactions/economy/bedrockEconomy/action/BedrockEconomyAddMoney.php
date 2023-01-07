<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\bedrockEconomy\action;

use aieuo\moreactions\economy\base\action\AddMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyExtension;

class BedrockEconomyAddMoney extends AddMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $amount = "") {
        parent::__construct(BedrockEconomyExtension::ACTION_ADD_MONEY, BedrockEconomyExtension::CATEGORY_NAME, $playerName, $amount);
    }

    protected function addMoney(string $name, int $amount): \Generator {
        yield from BedrockEconomyAPIWrapper::addMoney($name, $amount);
    }
}
