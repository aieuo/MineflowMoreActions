<?php

declare(strict_types=1);

namespace aieuo\moreactions;

abstract class Extension {

    private bool $activated = false;

    public function __construct(
        private bool $enabled = true
    ) {
    }

    public function init(Main $main): void {
    }

    abstract public function getName(): string;

    public function isEnabled(): bool {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void {
        $this->enabled = $enabled;
    }

    public function isActivated(): bool {
        return $this->activated;
    }

    public function setActivated(bool $activated): void {
        $this->activated = $activated;
    }

    abstract public function isPluginLoaded(): bool;

    abstract public function addToMineflow(): void;
}
