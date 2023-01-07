<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\main\condition;

use aieuo\moreactions\economy\base\condition\TakeMoneyConditionBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\main\MainEconomyExtension;
use SOFe\AwaitGenerator\GeneratorUtil;

class TakeMoneyCondition extends TakeMoneyConditionBase {

    public function __construct(string $playerName = "{target.name}", string $amount = "") {
        parent::__construct(MainEconomyExtension::CONDITION_TAKE_MONEY, MainEconomyExtension::CATEGORY_NAME, $playerName, $amount);
    }

    protected function getMoney(string $name): \Generator {
        return match (MainEconomyExtension::getPluginName()) {
            "BedrockEconomy" => yield from BedrockEconomyAPIWrapper::getMoney($name),
            default => yield from GeneratorUtil::empty(0),
        };
    }

    protected function takeMoney(string $name, int $amount): \Generator {
        return match (MainEconomyExtension::getPluginName()) {
            "BedrockEconomy" => yield from BedrockEconomyAPIWrapper::takeMoney($name, $amount),
            default => yield from GeneratorUtil::empty(),
        };
    }
}
