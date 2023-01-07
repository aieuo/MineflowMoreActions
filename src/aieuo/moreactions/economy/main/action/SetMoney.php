<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\main\action;

use aieuo\moreactions\economy\base\action\SetMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\main\MainEconomyExtension;
use SOFe\AwaitGenerator\GeneratorUtil;

class SetMoney extends SetMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $amount = "") {
        parent::__construct(MainEconomyExtension::ACTION_SET_MONEY, MainEconomyExtension::CATEGORY_NAME, $playerName, $amount);
    }

    protected function setMoney(string $name, int $amount): \Generator {
        return match (MainEconomyExtension::getPluginName()) {
            "BedrockEconomy" => yield from BedrockEconomyAPIWrapper::setMoney($name, $amount),
            default => yield from GeneratorUtil::empty(),
        };
    }
}
