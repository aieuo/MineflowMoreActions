<?php
declare(strict_types=1);


namespace aieuo\moreactions\economy\base\condition;

use aieuo\moreactions\economy\base\MoneyFlowItemNameWithMineflowLanguage;

trait MoneyConditionNameWithMineflowLanguage {
    use MoneyFlowItemNameWithMineflowLanguage;

    public function getNameKey(): string {
        return "condition.".$this->getIdWithoutPrefix().".name";
    }

    public function getDetailKey(): string {
        return "condition.".$this->getIdWithoutPrefix().".detail";
    }
}
