# WP Hook

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

### Advanced usage

This library also provides an interface `Stringth\WPHook\Contract\WithHook`. Any class that implements this must implement the hook method that will accept the `Stringth\WPHook\Hook` object. It may also help inforcing a clear structure when adding WordPress hook on a class.

```php
namespace Stringth\WPHook\Hook;

use Stringth\WPHook\Hook\Contract\WithHook;

class Feature implements WithHook
{

	/**
	 * Add WordPress hooks.
	 */
	public function hook( Hook &$hook ): void
	{
		$hook->addAction( 'init', 'initialise' );
	}
}

$hook = new Hook();

$feature = new Feature();
$feature->hook( $hook );

$hook->run();
```

## References

- [WordPress Plugin Boilerplate](https://wppb.me/)
- [Maximum function nesting level of '100' reached, aborting!](https://wordpress.stackexchange.com/questions/147505/wp-insert-posts-fatal-error-maximum-function-nesting-level-of-100-reached-ab)
- [PHP OOP: Introduction](https://phptherightway.com/#object-oriented-programming)
