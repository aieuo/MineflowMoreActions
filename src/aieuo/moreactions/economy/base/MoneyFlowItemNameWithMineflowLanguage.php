<?php
declare(strict_types=1);


namespace aieuo\moreactions\economy\base;

use aieuo\mineflow\flowItem\base\NameWithMineflowLanguage;
use function end;
use function explode;
use function rtrim;
use function str_replace;

trait MoneyFlowItemNameWithMineflowLanguage {
    use NameWithMineflowLanguage {
        getName as traitGetName;
        getDescription as traitGetDescription;
        getDetail as traitGetDetail;
    }

    protected function getIdWithoutPrefix(): string {
        $ids = explode("_", $this->getId());
        return end($ids);
    }

    protected function getIdPrefix(): string {
        return rtrim(str_replace($this->getIdWithoutPrefix(), "", $this->getId()), "_");
    }

    public function getName(): string {
        $prefix = $this->getIdPrefix();
        return $this->traitGetName().(empty($prefix) ? "" : " (".$prefix.")");
    }

    public function getDescription(): string {
        $prefix = $this->getIdPrefix();
        return $this->traitGetDescription().(empty($prefix) ? "" : " (".$prefix.")");
    }

    public function getDetail(): string {
        $prefix = $this->getIdPrefix();
        return $this->traitGetDetail().(empty($prefix) ? "" : " (".$prefix.")");
    }
}
