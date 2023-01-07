<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy\bedrockEconomy;

use aieuo\moreactions\economy\EconomyAPIWrapper;
use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;
use cooldogedev\BedrockEconomy\libs\cooldogedev\libSQL\context\ClosureContext;
use SOFe\AwaitGenerator\Await;

class BedrockEconomyAPIWrapper implements EconomyAPIWrapper {

    public static function getMoney(string $name): \Generator {
        return yield from Await::promise(function ($resolve) use($name) {
            BedrockEconomyAPI::legacy()->getPlayerBalance($name, ClosureContext::create(function (?int $balance) use($resolve) {
                $resolve($balance ?? BedrockEconomyExtension::getPlugin()->getCurrencyManager()->getDefaultBalance());
            }));
        });
    }

    public static function addMoney(string $name, int $amount): \Generator {
        return yield from Await::promise(function ($resolve) use($name, $amount) {
            BedrockEconomyAPI::legacy()->addToPlayerBalance($name, $amount, ClosureContext::create(function () use($resolve) {
                $resolve();
            }));
        });
    }

    public static function takeMoney(string $name, int $amount): \Generator {
        return yield from Await::promise(function ($resolve) use($name, $amount) {
            BedrockEconomyAPI::legacy()->subtractFromPlayerBalance($name, $amount, ClosureContext::create(function () use($resolve) {
                $resolve();
            }));
        });
    }

    public static function setMoney(string $name, int $amount): \Generator {
        return yield from Await::promise(function ($resolve) use($name, $amount) {
            BedrockEconomyAPI::legacy()->setPlayerBalance($name, $amount, ClosureContext::create(function () use($resolve) {
                $resolve();
            }));
        });
    }
}
