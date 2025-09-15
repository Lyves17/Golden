<?php

$header = <<<'EOF'
This file is part of the GoldenAxe project.

(c) GoldenAxe Team <contact@goldenaxe.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('node_modules')
    ->exclude('storage')
    ->exclude('bootstrap/cache')
    ->exclude('public/build')
    ->name('*.php')
    ->notName('_ide_helper.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@PSR12:risky' => true,
        '@PHPUnit75Migration:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => [
            'default' => 'align_single_space_minimal',
        ],
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => [
            'statements' => [
        ],
        'class_definition' => [
            'space_before_parenthesis' => true,
            'single_line' => false,
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'declare_strict_types' => true,
        'function_typehint_space' => true,
        'line_ending' => true,
        'lowercase_cast' => true,
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
            'keep_multiple_spaces_after_comma' => false,
        ],
        'native_function_casing' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'case',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'square_brace_block',
                'throw',
                'use',
                'use_trait',
            ],
        ],
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => [
            'use' => 'echo',
        ],
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_short_bool_cast' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_around_offset' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unused_imports' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'object_operator_without_whitespace' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],
        'phpdoc_align' => [
            'align' => 'left',
        ],
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_indent' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_package' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_order' => true,
        'phpdoc_scalar' => true,
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_var_without_name' => true,
        'return_type_declaration' => [
            'space_before' => 'none',
        ],
        'semicolon_after_instruction' => true,
        'short_scalar_cast' => true,
        'single_blank_line_before_namespace' => true,
        'single_quote' => true,
        'space_after_semicolon' => true,
        'standardize_not_equals' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => [
            'elements' => ['arrays'],
        ],
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'whitespace_after_comma_in_array' => true,
        
        // Additional rules for Laravel
        'no_unused_lambda_imports' => true,
        'not_operator_with_successor_space' => true,
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                'constant_public',
                'constant_protected',
                'constant_private',
                'property_public_static',
                'property_protected_static',
                'property_private_static',
                'property_public',
                'property_protected',
                'property_private',
                'construct',
                'destruct',
                'magic',
                'phpunit',
                'method_public_static',
                'method_protected_static',
                'method_private_static',
                'method_public',
                'method_protected',
                'method_private',
            ],
            'sort_algorithm' => 'alpha',
        ],
        'single_line_throw' => false,
        'yoda_style' => [
            'equal' => false,
            'identical' => false,
            'less_and_greater' => false,
        ],
        'method_chaining_indentation' => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],
        'no_alternative_syntax' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_superfluous_elseif' => true,
        'no_unneeded_curly_braces' => true,
        'no_unneeded_final_method' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'operator_linebreak' => [
            'only_booleans' => true,
            'position' => 'end',
        ],
        'php_unit_method_casing' => [
            'case' => 'snake_case',
        ],
        'php_unit_test_class_requires_covers' => false,
        'phpdoc_add_missing_param_annotation' => [
            'only_untyped' => false,
        ],
        'phpdoc_no_empty_return' => false,
        'phpdoc_order_by_value' => [
            'annotations' => [
                'covers',
                'coversNothing',
                'dataProvider',
                'depends',
                'group',
                'internal',
                'method',
                'mixin',
                'property',
                'property-read',
                'property-write',
                'requires',
                'throws',
                'uses',
            ],
        ],
        'phpdoc_to_param_type' => true,
        'phpdoc_to_return_type' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'return_assignment' => false,
        'single_line_comment_style' => [
            'comment_types' => ['hash'],
        ],
        'single_line_throw' => false,
        'strict_comparison' => false,
        'strict_param' => false,
        'void_return' => false,
        'yoda_style' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);
