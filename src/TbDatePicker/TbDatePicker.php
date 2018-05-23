<?php
/**
 * Twitter Bootstrap DatePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2014 - 2018 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Container;
use Nette\Utils\DateTime;

/**
 * Twitter Bootstrap DatePicker Input Control
 *
 * @author Radek Dostál
 */
class TbDatePicker extends AbstractDateTimePicker
{
  /**
   * Default format
   *
   * @var string
   */
  protected $format = 'd.m.Y';

  /**
   * Returns date
   *
   * @return mixed
   */
  public function getValue()
  {
    if (strlen($this->value) > 0)
    {
      $date = DateTime::createFromFormat($this->format.'|', $this->value);

      if ($date === FALSE)
      {
        $this->addError($this->getValueErrorMessage());

        return FALSE;
      }

      return $date;
    }

    return $this->value;
  }

  /**
   * Registers this control
   *
   * @param string $format format
   * @return self
   */
  public static function register($format = NULL)
  {
    Container::extensionMethod('addTbDatePicker', function($container, $name, $label = NULL, $maxLength = NULL) use ($format)
    {
      $picker = $container[$name] = new TbDatePicker($label, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });

    parent::setValidationMessages();
  }
}