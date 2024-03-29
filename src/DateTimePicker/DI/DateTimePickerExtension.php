<?php
/**
 * DateTimePicker Input Control extension
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright © 2016 - 2019 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker\DateTimePicker\DI;

use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

/**
 * DateTimePicker Input Control extension
 *
 * @author Radek Dostál
 */
class DateTimePickerExtension extends CompilerExtension
{
  private const CONFIG_FORMAT = 'format';

  public function getConfigSchema(): Schema
  {
    return Expect::structure([
      self::CONFIG_FORMAT => Expect::string()->dynamic()
    ])->castTo('array');
  }

  public function afterCompile(ClassType $class): void
  {
    parent::afterCompile($class);

    $config = $this->getConfig();

    $initialize = $class->getMethod('initialize');
    $initialize->addBody('RadekDostal\NetteComponents\DateTimePicker\DateTimePicker::register(?);', [$config[self::CONFIG_FORMAT]]);
  }
}
