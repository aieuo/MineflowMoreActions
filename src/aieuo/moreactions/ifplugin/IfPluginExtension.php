<?php

declare(strict_types=1);

namespace aieuo\moreactions\ifplugin;

use aieuo\ip\IFPlugin;
use aieuo\mineflow\flowItem\FlowItemCategory;
use aieuo\mineflow\flowItem\FlowItemFactory;
use aieuo\moreactions\Extension;
use aieuo\moreactions\Main;
use function class_exists;

class IfPluginExtension extends Extension {

    public const CATEGORY_NAME = "if_plugin";

    public const ACTION_EXECUTE_IF_CHAIN = "executeIFChain";

    private static ?IFPlugin $plugin = null;

    public function getName(): string {
        return "IF";
    }

    public function init(Main $main): void {
        if (class_exists(IFPlugin::class)) {
            self::$plugin = IFPlugin::getInstance();
        }
    }

    public function isPluginLoaded(): bool {
        return self::$plugin !== null;
    }

    public function addToMineflow(): void {
        FlowItemCategory::add(self::CATEGORY_NAME, FlowItemCategory::PLUGIN);

        FlowItemFactory::register(new ExecuteIFChain());
    }
}
