<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\main\action;

use aieuo\moreactions\economy\base\action\AddMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\main\MainEconomyExtension;
use SOFe\AwaitGenerator\GeneratorUtil;

class AddMoney extends AddMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $amount = "") {
        parent::__construct(MainEconomyExtension::ACTION_ADD_MONEY, MainEconomyExtension::CATEGORY_NAME, $playerName, $amount);
    }

    protected function addMoney(string $name, int $amount): \Generator {
        return match (MainEconomyExtension::getPluginName()) {
            "BedrockEconomy" => yield from BedrockEconomyAPIWrapper::addMoney($name, $amount),
            default => yield from GeneratorUtil::empty(),
        };
    }
}
