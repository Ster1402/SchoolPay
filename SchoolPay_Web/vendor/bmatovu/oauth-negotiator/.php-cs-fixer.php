<?php

// https://mlocati.github.io/php-cs-fixer-configurator
// https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/v3.0.0/UPGRADE-v3.md

declare(strict_types=1);

$excludes = [
    'docs',
    'example',
    'logs',
    'tests',
    'vendor',
];

$finder = PhpCsFixer\Finder::create()
    ->ignoreDotFiles(false)
    ->ignoreVCSIgnored(true)
    ->exclude($excludes)
    ->in(__DIR__);

$rules = [
    '@PSR2' => true,

    // Arrays
    'binary_operator_spaces' => true,

    // phpdocs
    'phpdoc_types' => true,
    'phpdoc_indent' => true,
    'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_align' => true,
    'phpdoc_summary' => true,
    'phpdoc_separation' => true,
    'phpdoc_scalar' => true,
    'phpdoc_order' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_return_self_reference' => true,
    'phpdoc_var_without_name' => true,
    'phpdoc_var_annotation_correct_order' => true,
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'phpdoc_add_missing_param_annotation' => [
        'only_untyped' => false,
    ],
];

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setFinder($finder);

return $config;
