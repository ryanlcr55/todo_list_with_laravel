<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude([
        'vendor',
        'node_modules',
        'storage',
        'bootstrap/cache',
    ])
    ->notPath('_ide_helper.php')
    ->notPath('_ide_helper_models.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'binary_operator_spaces' => true,
        'braces' => [
            'allow_single_line_closure' => false,
            'allow_single_line_anonymous_class_with_empty_body' => true,
            'position_after_anonymous_constructs' => 'same',
            'position_after_control_structures' => 'same',
            'position_after_functions_and_oop_constructs' => 'next',
        ],
        'concat_space' => ['spacing' => 'one'],
        'no_extra_blank_lines' => false,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_trailing_whitespace' => true,
        'no_whitespace_before_comma_in_array' => true,
        'ordered_class_elements' => [
            'order' => ['use_trait']
        ],
        'single_import_per_statement' => false,
        'space_after_semicolon' => [
            'remove_in_empty_for_expressions' => true,
        ],
        'unary_operator_spaces' => true,
        'visibility_required' => [
            'elements' => ['const', 'method', 'property']
        ],
        'whitespace_after_comma_in_array' => true,

        'function_typehint_space' => true,
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline'
        ],
        'no_empty_statement' => true,
        'no_leading_namespace_whitespace' => true,
        'no_whitespace_in_blank_line' => true,

        'no_unused_imports' => true,
        'include' => true,
        'no_trailing_comma_in_list_call' => true,
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'fully_qualified_strict_types' => true,
        'single_quote' => true,
        'array_indentation' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,

        'strict_comparison' => true,
    ])
    ->setUsingCache(false)
    ->setFinder($finder);
