<?php

/**
 * parent class to provide language
 *
 * @since 2.2.0
 *
 * @package Redaxscript
 * @category Language
 * @author Henry Ruhs
 */

class Redaxscript_Language
{
	/**
	 * instance of the class
	 *
	 * @var object
	 */

	protected static $_instance = null;

	/**
	 * array of language values
	 *
	 * @var array
	 */

	protected static $_values = array();

	/**
	 * constructor of the class
	 *
	 * @since 2.2.0
	 */

	public function __construct()
	{
	}

	/**
	 * init the class
	 *
	 * @since 2.2.0
	 */

	public static function init($language = 'en')
	{
		self::load('languages/en.json');

		/* merge another language */

		if ($language !== 'en')
		{
			self::load('languages/' . $language . '.json');
		}
	}

	/**
	 * get item from language
	 *
	 * @since 2.2.0
	 *
	 * @param string $key key of the item
	 * @param string $index index of the key array
	 *
	 * @return string
	 */

	public static function get($key = null, $index = null)
	{
		/* handle index */

		if ($index && is_array(self::$_values[$index]))
		{
			$values = self::$_values[$index];
		}
		else
		{
			$values = self::$_values;
		}

		/* key from values */

		if (array_key_exists($key, $values))
		{
			if (function_exists('mb_convert_encoding'))
			{
				$output = mb_convert_encoding($values[$key], s('charset'), 'utf-8, latin1');
			}
			else
			{
				$output = $values[$key];
			}
		}
		else
		{
			$output = null;
		}
		return $output;
	}

	/**
	 * get all language values
	 *
	 * @since 2.2.0
	 *
	 * @return array
	 */

	public static function getAll()
	{
		return self::$_values;
	}

	/**
	 * load from language files
	 *
	 * @since 2.2.0
	 *
	 * @param string|array $json single or multiple language paths
	 */

	public static function load($json = null)
	{
		if (!is_array($json))
		{
			$json = array($json);
		}

		/* merge language files */

		foreach ($json as $file)
		{
			if (file_exists($file))
			{
				$values = json_decode(file_get_contents($file), true);
				if (is_array($values))
				{
					self::$_values = array_merge(self::$_values, $values);
				}
			}
		}
	}

	/**
	 * instance of the class
	 *
	 * @since 2.2.0
	 *
	 * @return object
	 */

	public static function instance()
	{
		if (self::$_instance === null)
		{
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	/**
	 * reset the instance
	 *
	 * @since 2.2.0
	 *
	 * @return object
	 */

	public static function reset()
	{
		self::$_instance = null;
	}
}