<?php

declare(strict_types=1);

namespace aieuo\moreactions\economy\main;

use aieuo\mineflow\flowItem\FlowItemCategory;
use aieuo\mineflow\flowItem\FlowItemFactory;
use aieuo\moreactions\economy\main\action\AddMoney;
use aieuo\moreactions\economy\main\action\GetMoney;
use aieuo\moreactions\economy\main\action\SetMoney;
use aieuo\moreactions\economy\main\action\TakeMoney;
use aieuo\moreactions\economy\main\condition\LessMoney;
use aieuo\moreactions\economy\main\condition\OverMoney;
use aieuo\moreactions\economy\main\condition\TakeMoneyCondition;
use aieuo\moreactions\Extension;
use aieuo\moreactions\Main;
use cooldogedev\BedrockEconomy\BedrockEconomy;
use pocketmine\plugin\Plugin;
use function class_exists;

class MainEconomyExtension extends Extension {

    public const CATEGORY_NAME = "economy";

    public const ACTION_ADD_MONEY = "addMoney";
    public const ACTION_GET_MONEY = "getMoney";
    public const ACTION_SET_MONEY = "setMoney";
    public const ACTION_TAKE_MONEY = "takeMoney";

    public const CONDITION_LESS_MONEY = "lessMoney";
    public const CONDITION_OVER_MONEY = "overMoney";
    public const CONDITION_TAKE_MONEY = "takeMoneyCondition";

    private static ?Plugin $plugin = null;
    private static string $pluginName = "";

    public function getName(): string {
        return "MainEconomy";
    }

    public function init(Main $main): void {
        switch (self::getPluginName()) {
            case "BedrockEconomy":
                if (class_exists(BedrockEconomy::class)) {
                    self::$plugin = BedrockEconomy::getInstance();
                }
                break;
        }
    }

    public static function getPluginName(): string {
        return self::$pluginName;
    }

    public static function setPluginName(string $pluginName): void {
        self::$pluginName = $pluginName;
    }

    public function isPluginLoaded(): bool {
        return self::$plugin !== null;
    }

    public static function getPlugin(): Plugin {
        return self::$plugin;
    }

    public function addToMineflow(): void {
        FlowItemCategory::add(self::CATEGORY_NAME, FlowItemCategory::PLUGIN);

        FlowItemFactory::register(new AddMoney());
        FlowItemFactory::register(new GetMoney());
        FlowItemFactory::register(new SetMoney());
        FlowItemFactory::register(new TakeMoney());
        
        FlowItemFactory::register(new LessMoney());
        FlowItemFactory::register(new OverMoney());
        FlowItemFactory::register(new TakeMoneyCondition());
    }
}
