<?php
declare(strict_types=1);


namespace aieuo\moreactions\economy\base\action;

use aieuo\moreactions\economy\base\MoneyFlowItemNameWithMineflowLanguage;

trait MoneyActionNameWithMineflowLanguage {
    use MoneyFlowItemNameWithMineflowLanguage;

    public function getNameKey(): string {
        return "action.".$this->getIdWithoutPrefix().".name";
    }

    public function getDetailKey(): string {
        return "action.".$this->getIdWithoutPrefix().".detail";
    }
}
