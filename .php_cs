<?php

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->fixers([
        'ordered_use',
        'unused_use',
        'concat_with_spaces',
        'header_comment',
        'newline_after_open_tag',
        'phpdoc_order',
        'short_array_syntax'
    ])
    ->finder(
        Symfony\CS\Finder\DefaultFinder::create()
            ->in(['src', 'app', 'bin', 'tests/behat', 'tests/unit'])
    )
;
