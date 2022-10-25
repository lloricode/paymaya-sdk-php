<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ]+json_decode(<<<JSON
{
        "align_multiline_comment": true,
        "array_indentation": true,
        "array_syntax": true,
        "assign_null_coalescing_to_coalesce_equal": true,
        "binary_operator_spaces": true,
        "blank_line_before_statement": {
            "statements": [
                "break",
                "continue",
                "declare",
                "return",
                "throw",
                "try"
            ]
        },
        "cast_spaces": true,
        "class_attributes_separation": {
            "elements": {
                "method": "one"
            }
        },
        "clean_namespace": true,
        "combine_consecutive_issets": true,
        "combine_consecutive_unsets": true,
        "declare_strict_types": true,
        "doctrine_annotation_indentation": true,
        "doctrine_annotation_spaces": true,
        "fully_qualified_strict_types": true,
        "function_typehint_space": true,
        "global_namespace_import": true,
        "heredoc_indentation": true,
        "include": true,
        "lambda_not_used_import": true,
        "linebreak_after_opening_tag": true,
        "list_syntax": true,
        "magic_constant_casing": true,
        "magic_method_casing": true,
        "method_argument_space": {
            "on_multiline": "ensure_fully_multiline",
            "keep_multiple_spaces_after_comma": true
        },
        "method_chaining_indentation": true,
        "multiline_comment_opening_closing": true,
        "multiline_whitespace_before_semicolons": true,
        "native_function_casing": true,
        "native_function_type_declaration_casing": true,
        "no_alias_language_construct_call": true,
        "no_alternative_syntax": true,
        "no_empty_comment": true,
        "no_empty_statement": true,
        "no_extra_blank_lines": true,
        "no_leading_namespace_whitespace": true,
        "no_mixed_echo_print": true,
        "no_multiline_whitespace_around_double_arrow": true,
        "no_multiple_statements_per_line": true,
        "no_singleline_whitespace_before_semicolons": true,
        "no_spaces_around_offset": true,
        "no_unneeded_import_alias": true,
        "no_unused_imports": true,
        "no_whitespace_before_comma_in_array": true,
        "no_whitespace_in_blank_line": true,
        "not_operator_with_space": true,
        "not_operator_with_successor_space": true,
        "php_unit_fqcn_annotation": true,
        "phpdoc_line_span": {
            "const": "single",
            "method": "single",
            "property": "single"
        },
        "phpdoc_scalar": true,
        "phpdoc_single_line_var_spacing": true,
        "phpdoc_var_without_name": true,
        "simple_to_complex_string_variable": true,
        "simplified_if_return": true,
        "single_quote": true,
        "standardize_not_equals": true,
        "trailing_comma_in_multiline": true,
        "trim_array_spaces": true,
        "types_spaces": true,
        "unary_operator_spaces": true,
        "whitespace_after_comma_in_array": true
    }
JSON
, true))
    ->setFinder($finder);
