# WP Hook

[![PHP](https://github.com/stringth/wp-hook/actions/workflows/php.yml/badge.svg)](https://github.com/stringth/wp-hook/actions/workflows/php.yml)

> A library containing a small utility class, forked from [WordPress Plugin Boilerplate](https://wppb.me/), to register actions and filters with Object-oriented Programming (OOP).

## Why?

One common pitfall that I often encounter when managing a large complex site with the plugins and themes is that we could easily fall into nesting multiple hooks:

```php
add_action( 'init', 'initialise' );

function initialise(): void
{
	add_action( 'after_setup_theme', 'hello_world' );
}

function hello_world(): void
{
    echo "Hello World";
}
```

The problem with the above example is that WordPress may never execute the `hello_world` function since the `after_setup_theme` would have already done executing before the `init` hook. In some extreme cases, nested hooks [may cause an error](https://wordpress.stackexchange.com/questions/147505/wp-insert-posts-fatal-error-maximum-function-nesting-level-of-100-reached-ab).

The class in this library aims to help minimising this pitfall by maintaining the list of hooks and run them in one batch hence avoid _nesting_ in the first place.

## Usage

**This library assumes that you develop your WordPress site, plugin, or theme with OOP** as it may not quite fit in the functional programming paradigm. Assuming you're already familiar with the OOP concept in PHP, usage should be pretty straightforward:

```php
namespace Stringth\WPHook\Hook;

$hook = new Hook();

// Add action hooks.
$hook->add_action( 'init', 'initialise' );
$hook->add_action( 'after_setup_theme', 'hello_world' );

// Alternately, if you prefer camelCase format.
$hook->addAction( 'init', 'initialise' );
$hook->addFilter( 'after_setup_theme', 'hello_world' );

// Run once to register all added hooks on the list.
$hook->run();
```

For a more advanced usage, check out **[the Wiki page](https://github.com/stringth/wp-hook/wiki)**.

## References

- [WordPress Plugin Boilerplate](https://wppb.me/)
- [Maximum function nesting level of '100' reached, aborting!](https://wordpress.stackexchange.com/questions/147505/wp-insert-posts-fatal-error-maximum-function-nesting-level-of-100-reached-ab)
- [PHP OOP: Introduction](https://phptherightway.com/#object-oriented-programming)
