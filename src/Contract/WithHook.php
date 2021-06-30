<?php

declare(strict_types=1);

namespace Stringth\WPHook\Contract;

use Stringth\WPHook\Hook;

interface WithHook
{

    /**
     * Add WordPress hooks.
     */
    public function hook( Hook &$hook ): void;
}
