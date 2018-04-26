<?php
$header = <<<'EOF'
Bittrex PHP Client Wrapper.

(c) Edson Medina <edsonmedina@gmail.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;
$config = PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(
        [
            '@PHP56Migration' => true,
            '@PHPUnit60Migration:risky' => true,
            '@Symfony' => true,
            '@Symfony:risky' => true,
            'align_multiline_comment' => true,
            'array_syntax' => ['syntax' => 'short'],
            'blank_line_before_statement' => true,
            'combine_consecutive_issets' => true,
            'combine_consecutive_unsets' => true,
            'compact_nullable_typehint' => true,
            'escape_implicit_backslashes' => true,
            'explicit_indirect_variable' => true,
            'explicit_string_variable' => true,
            'final_internal_class' => true,
            'header_comment' => ['header' => $header],
            'heredoc_to_nowdoc' => true,
            'list_syntax' => ['syntax' => 'long'],
            'method_chaining_indentation' => true,
            'method_argument_space' => ['ensure_fully_multiline' => true],
            'no_null_property_initialization' => true,
            'no_short_echo_tag' => true,
            'no_superfluous_elseif' => true,
            'no_unneeded_curly_braces' => true,
            'no_unneeded_final_method' => true,
            'no_unreachable_default_argument_value' => true,
            'no_useless_else' => true,
            'no_useless_return' => true,
            'ordered_class_elements' => true,
            'ordered_imports' => true,
            'php_unit_strict' => true,
            'php_unit_test_annotation' => true,
            'php_unit_test_class_requires_covers' => true,
            'phpdoc_add_missing_param_annotation' => true,
            'phpdoc_order' => true,
            'phpdoc_types_order' => true,
            'semicolon_after_instruction' => true,
            'single_line_comment_style' => true,
            'strict_comparison' => true,
            'strict_param' => true,
            'yoda_style' => true,
        ]
    )
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
    );

return $config;
