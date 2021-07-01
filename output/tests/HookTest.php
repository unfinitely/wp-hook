<?php

namespace Stringth\WPHook\Tests;

use Stringth\WPHook\Hook;

/**
 * Test the main `\Stringth\WPHook\Hook` class.
 */
class HookTest extends TestCase
{

	/**
	 * The `\Stringth\WPHook\Hook` instance to test.
	 *
	 * @var \Stringth\WPHook\Hook
	 */
	private $instance;

	/**
	 * To be called before each test.
	 */
	public function setUp(): void
	{
		parent::setUp();

		$this->instance = new Hook();
	}

	/**
	 * Test adding an action hook.
	 */
	public function testAddAction(): void
	{

		$func = static function (): bool {
			return true;
		};

		$this->instance->addAction( 'init', $func );
		$this->instance->add_action( 'admin_init', $func );
		$this->instance->run();

		$actual = has_action( 'init', $func );
		$expect = 10;

		$this->assertEquals( $expect, $actual );

		$actual = has_action( 'admin_init', $func );
		$expect = 10;

		$this->assertEquals( $expect, $actual );
	}

	/**
	 * Test adding an action filter.
	 */
	public function testAddFilter(): void
	{

		$func = static function ( $value ) {
			return $value;
		};

		$this->instance->addFilter( 'all_plugins', $func );
		$this->instance->add_filter( 'all_themes', $func );
		$this->instance->run();

		$actual = has_filter( 'all_plugins', $func );
		$expect = 10;

		$this->assertEquals( $expect, $actual );

		$actual = has_filter( 'all_themes', $func );
		$expect = 10;

		$this->assertEquals( $expect, $actual );
	}
}
