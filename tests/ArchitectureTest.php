<?php

declare(strict_types=1);

arch('Not debugging statements are left in our code.')
    ->expect(['dd', 'dump', 'ray', 'rd', 'die', 'eval', 'sleep'])
    ->not->toBeUsed();

arch()
    ->preset()
    ->php();
arch()
    ->preset()
    ->security();
