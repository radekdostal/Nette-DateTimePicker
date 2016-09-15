<?php

namespace RadekDostal\NetteComponents\DateTimePicker\DI;

use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use RadekDostal\NetteComponents\DateTimePicker\DatePicker;

/**
 * DatePickerExtension
 */
class DatePickerExtension extends CompilerExtension
{
	const CONFIG_FORMAT = 'format';
	/** @var array */
	public $defaults = array(
		self::CONFIG_FORMAT => NULL
	);
	/**
	 * Adjusts DI container compiled to PHP class. Intended to be overridden by descendant.
	 *
	 * @return void
	 */
	public function afterCompile(ClassType $class)
	{
		parent::afterCompile($class);
		$config = $this->getConfig($this->defaults);
		$init = $class->methods['initialize'];
		$init->addBody(DatePicker::class . '::register(?);', [$config[self::CONFIG_FORMAT]]);
	}
}
