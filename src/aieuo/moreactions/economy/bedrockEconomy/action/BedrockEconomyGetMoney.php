<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\bedrockEconomy\action;

use aieuo\moreactions\economy\base\action\GetMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyExtension;

class BedrockEconomyGetMoney extends GetMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $resultName = "money") {
        parent::__construct(BedrockEconomyExtension::ACTION_GET_MONEY, BedrockEconomyExtension::CATEGORY_NAME, $playerName, $resultName);
    }

    protected function getMoney(string $name): \Generator {
        return yield from BedrockEconomyAPIWrapper::getMoney($name);
    }
}
