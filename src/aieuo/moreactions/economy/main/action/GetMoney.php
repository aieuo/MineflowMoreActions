<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\main\action;

use aieuo\moreactions\economy\base\action\GetMoneyBase;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyAPIWrapper;
use aieuo\moreactions\economy\main\MainEconomyExtension;
use SOFe\AwaitGenerator\GeneratorUtil;

class GetMoney extends GetMoneyBase {

    public function __construct(string $playerName = "{target.name}", string $resultName = "money") {
        parent::__construct(MainEconomyExtension::ACTION_GET_MONEY, MainEconomyExtension::CATEGORY_NAME, $playerName, $resultName);
    }

    protected function getMoney(string $name): \Generator {
        return match (MainEconomyExtension::getPluginName()) {
            "BedrockEconomy" => yield from BedrockEconomyAPIWrapper::getMoney($name),
            default => yield from GeneratorUtil::empty(0),
        };
    }
}
