<?php

declare(strict_types=1);

namespace aieuo\moreactions\economy\bedrockEconomy;

use aieuo\mineflow\flowItem\FlowItemCategory;
use aieuo\mineflow\flowItem\FlowItemFactory;
use aieuo\moreactions\economy\bedrockEconomy\action\BedrockEconomyAddMoney;
use aieuo\moreactions\economy\bedrockEconomy\action\BedrockEconomyGetMoney;
use aieuo\moreactions\economy\bedrockEconomy\action\BedrockEconomySetMoney;
use aieuo\moreactions\economy\bedrockEconomy\action\BedrockEconomyTakeMoney;
use aieuo\moreactions\economy\bedrockEconomy\condition\BedrockEconomyLessMoney;
use aieuo\moreactions\economy\bedrockEconomy\condition\BedrockEconomyOverMoney;
use aieuo\moreactions\economy\bedrockEconomy\condition\BedrockEconomyTakeMoneyCondition;
use aieuo\moreactions\Extension;
use aieuo\moreactions\Main;
use cooldogedev\BedrockEconomy\BedrockEconomy;
use function class_exists;

class BedrockEconomyExtension extends Extension {

    public const CATEGORY_NAME = "bedrock_economy";

    public const ACTION_ADD_MONEY = "BedrockEconomy_addMoney";
    public const ACTION_GET_MONEY = "BedrockEconomy_getMoney";
    public const ACTION_SET_MONEY = "BedrockEconomy_setMoney";
    public const ACTION_TAKE_MONEY = "BedrockEconomy_takeMoney";

    public const CONDITION_LESS_MONEY = "BedrockEconomy_lessMoney";
    public const CONDITION_OVER_MONEY = "BedrockEconomy_overMoney";
    public const CONDITION_TAKE_MONEY = "BedrockEconomy_takeMoneyCondition";

    private static ?BedrockEconomy $plugin = null;

    public function getName(): string {
        return "BedrockEconomy";
    }

    public function init(Main $main): void {
        if (class_exists(BedrockEconomy::class)) {
            self::$plugin = BedrockEconomy::getInstance();
        }
    }

    public function isPluginLoaded(): bool {
        return self::$plugin !== null;
    }

    public static function getPlugin(): BedrockEconomy {
        return self::$plugin;
    }

    public function addToMineflow(): void {
        FlowItemCategory::add(self::CATEGORY_NAME, FlowItemCategory::PLUGIN);

        FlowItemFactory::register(new BedrockEconomyAddMoney());
        FlowItemFactory::register(new BedrockEconomyGetMoney());
        FlowItemFactory::register(new BedrockEconomySetMoney());
        FlowItemFactory::register(new BedrockEconomyTakeMoney());
        
        FlowItemFactory::register(new BedrockEconomyLessMoney());
        FlowItemFactory::register(new BedrockEconomyOverMoney());
        FlowItemFactory::register(new BedrockEconomyTakeMoneyCondition());
    }
}
