<?php
/**
 * DateTimePicker Input Control extension
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2016 - 2018 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker\DateTimePicker\DI;

use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;

/**
 * DateTimePicker Input Control extension
 *
 * @author Radek Dostál
 */
class DateTimePickerExtension extends CompilerExtension
{
  const CONFIG_FORMAT = 'format';

  /** @var array */
  public $defaults = array(
    self::CONFIG_FORMAT => NULL
  );

  /**
   * Adjusts DI container compiled to PHP class. Intended to be overridden by descendant.
   *
   * @param \Nette\PhpGenerator\ClassType $class class, interface, trait description
   * @return void
   */
  public function afterCompile(ClassType $class)
  {
    parent::afterCompile($class);

    $config = $this->getConfig($this->defaults);

    $initialize = $class->methods['initialize'];
    $initialize->addBody('RadekDostal\NetteComponents\DateTimePicker\DateTimePicker::register(?);', array($config[self::CONFIG_FORMAT]));
  }
}