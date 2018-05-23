<?php
/**
 * Twitter Bootstrap DateTimePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2014  - 2018 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Container;
use Nette\Utils\DateTime;

/**
 * Twitter Bootstrap DateTimePicker Input Control
 *
 * @author Radek Dostál
 */
class TbDateTimePicker extends AbstractDateTimePicker
{
  /**
   * Default format
   *
   * @var string
   */
  protected $format = 'd.m.Y H:i';

  /**
   * Returns date and time
   *
   * @return mixed
   */
  public function getValue()
  {
    if (strlen($this->value) > 0)
    {
      $datetime = DateTime::createFromFormat($this->format.'|', $this->value);

      if ($datetime === FALSE)
      {
        $this->addError($this->getValueErrorMessage());

        return FALSE;
      }

      return $datetime;
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
    Container::extensionMethod('addTbDateTimePicker', function($container, $name, $label = NULL, $maxLength = NULL) use ($format)
    {
      $picker = $container[$name] = new TbDateTimePicker($label, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });

    parent::setValidationMessages();
  }
}