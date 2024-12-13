<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests');

return (new Config())
    ->setRules([
        '@PSR12' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_trailing_comma_in_singleline_array' => true,
        'trim_array_spaces' => true,
        'single_quote' => true,
        'blank_line_after_namespace' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
                'property' => 'one',
            ],
        ],
        'function_declaration' => ['closure_function_spacing' => 'none'],
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'visibility_required' => ['elements' => ['property', 'method', 'const']],

        'binary_operator_spaces' => ['default' => 'align_single_space_minimal'],
        'cast_spaces' => ['space' => 'single'],
        'concat_space' => ['spacing' => 'one'],

        'control_structure_continuation_position' => ['position' => 'same_line'],
        'curly_braces_position' => [
            'control_structures_opening_brace' => 'same_line',
            'functions_opening_brace' => 'next_line_unless_newline_at_signature_end',
            'classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
        ],

        'phpdoc_align' => ['align' => 'vertical'],
        'phpdoc_order' => true,
        'phpdoc_scalar' => true,
        'return_type_declaration' => ['space_before' => 'none'],
        'declare_strict_types' => false,
        'no_blank_lines_after_phpdoc' => true,
        'no_extra_blank_lines' => ['tokens' => ['curly_brace_block', 'extra']],
        'no_trailing_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'semicolon_after_instruction' => true,
    ])
    ->setFinder($finder)
    ->setIndent("    ")
    ->setLineEnding("\n");
