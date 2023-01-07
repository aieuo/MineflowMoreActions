<?php
declare(strict_types=1);

namespace aieuo\moreactions\economy;

interface EconomyAPIWrapper {

    public static function getMoney(string $name): \Generator;

    public static function addMoney(string $name, int $amount): \Generator;

    public static function takeMoney(string $name, int $amount): \Generator;

    public static function setMoney(string $name, int $amount): \Generator;

}
