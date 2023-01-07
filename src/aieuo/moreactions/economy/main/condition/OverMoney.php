<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\main\condition;

use aieuo\moreactions\economy\base\condition\OverMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\main\MainEconomyExtension;
use SOFe\AwaitGenerator\GeneratorUtil;

class OverMoney extends OverMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $amount = "") {
        parent::__construct(MainEconomyExtension::CONDITION_OVER_MONEY, MainEconomyExtension::CATEGORY_NAME, $playerName, $amount);
    }

    protected function getMoney(string $name): \Generator {
        return match (MainEconomyExtension::getPluginName()) {
            "BedrockEconomy" => yield from BedrockEconomyAPIWrapper::getMoney($name),
            default => yield from GeneratorUtil::empty(0),
        };
    }
}
