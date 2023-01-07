<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\bedrockEconomy\action;

use aieuo\moreactions\economy\base\action\TakeMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyExtension;

class BedrockEconomyTakeMoney extends TakeMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $amount = "") {
        parent::__construct(BedrockEconomyExtension::ACTION_TAKE_MONEY, BedrockEconomyExtension::CATEGORY_NAME, $playerName, $amount);
    }

    protected function takeMoney(string $name, int $amount): \Generator {
        yield from BedrockEconomyAPIWrapper::takeMoney($name, $amount);
    }
}
