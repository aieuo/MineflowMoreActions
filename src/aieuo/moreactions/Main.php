<?php

declare(strict_types=1);

namespace aieuo\moreactions;

use aieuo\mineflow\flowItem\action\common\SendMessageToConsole;
use aieuo\mineflow\flowItem\action\script\ifelse\IFAction;
use aieuo\mineflow\flowItem\action\script\Wait;
use aieuo\mineflow\recipe\Recipe;
use aieuo\mineflow\utils\Language;
use aieuo\moreactions\economy\bedrockEconomy\BedrockEconomyExtension;
use aieuo\moreactions\economy\main\action\AddMoney;
use aieuo\moreactions\economy\main\action\GetMoney;
use aieuo\moreactions\economy\main\action\SetMoney;
use aieuo\moreactions\economy\main\action\TakeMoney;
use aieuo\moreactions\economy\main\MainEconomyExtension;
use pocketmine\plugin\PluginBase;
use const INI_SCANNER_RAW;

class Main extends PluginBase {

    private static Main $instance;

    /** @var Extension[] */
    private array $extensions = [];

    public static function getInstance(): Main {
        return self::$instance;
    }

    protected function onLoad(): void {
        self::$instance = $this;

        $this->registerMineflowMessages();
        $this->registerDefaultExtensions();

        $this->setConfigDefaultValues();
        $this->applyConfigToExtensions();
        $this->initExtensions();
        $this->activateExtensions();

        $recipe = new Recipe("test100", "test100");
        $recipe->addAction(new Wait("1"));
        $recipe->addAction(new SendMessageToConsole("aieuooo"));
        $recipe->addAction(new AddMoney("aieuooo", "200"));
        $recipe->addAction(new GetMoney("aieuooo", "money"));
        $recipe->addAction(new SendMessageToConsole("aieuooo: {money}"));
        $recipe->addAction(new SetMoney("aieuooo", "1000"));
        $recipe->addAction(new GetMoney("aieuooo", "money"));
        $recipe->addAction(new SendMessageToConsole("aieuooo: {money}"));
        $recipe->addAction(new TakeMoney("aieuooo", "100"));
        $recipe->addAction(new GetMoney("aieuooo", "money"));
        $recipe->addAction(new SendMessageToConsole("aieuooo: {money}"));
        $recipe->addAction(new IFAction([
            new TakeMoney("aieuooo", "100"),
        ], [
            new SendMessageToConsole("if!")
        ]));
        $recipe->addAction(new GetMoney("aieuooo", "money"));
        $recipe->addAction(new SendMessageToConsole("aieuooo: {money}"));
        $recipe->executeAllTargets();
    }

    private function registerDefaultExtensions(): void {
        $this->registerExtension(new MainEconomyExtension());
        $this->registerExtension(new BedrockEconomyExtension());
    }

    public function registerExtension(Extension $extension): void {
        $this->extensions[$extension::class] = $extension;
    }

    public function getExtensionByName(string $name): ?Extension {
        foreach ($this->extensions as $extension) {
            if ($extension->getName() === $name) {
                return $extension;
            }
        }
        return null;
    }

    public function getExtensions(): array {
        return $this->extensions;
    }

    private function setConfigDefaultValues(): void {
        $config = $this->getConfig();
        $defaults = [];
        foreach ($this->getExtensions() as $extension) {
            $defaults[$extension->getName()] = $extension->isEnabled();
        }
        $config->setDefaults([
            "extensions" => $defaults,
            "economy" => "BedrockEconomy",
        ]);
        $config->save();
    }

    private function applyConfigToExtensions(): void {
        $config = $this->getConfig();

        MainEconomyExtension::setPluginName($config->get("economy", "BedrockEconomy"));

        $values = $config->get("extensions", []);
        foreach ($this->getExtensions() as $extension) {
            $extension->setEnabled($values[$extension->getName()] ?? true);
        }
    }

    private function initExtensions(): void {
        foreach ($this->getExtensions() as $extension) {
            $extension->init($this);
        }
    }

    private function activateExtensions(): void {
        foreach ($this->getExtensions() as $extension) {
            if (!$extension->isEnabled() or !$extension->isPluginLoaded() or $extension->isActivated()) continue;

            $extension->addToMineflow();
            $extension->setActivated(true);
        }
    }

    private function registerMineflowMessages(): void {
        foreach ($this->getResources() as $resource) {
            $filenames = explode(".", $resource->getFilename());
            if (($filenames[1] ?? "") === "ini") {
                Language::add(parse_ini_file($resource->getPathname(), scanner_mode: INI_SCANNER_RAW), $filenames[0]);
            }
        }
    }
}
