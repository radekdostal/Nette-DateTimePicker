<?php
/**
 * DateTimePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2010 - 2018 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Container;
use Nette\Utils\DateTime;

/**
 * DateTimePicker Input Control
 *
 * @author Radek Dostál
 */
class DateTimePicker extends AbstractDateTimePicker
{
  /**
   * Default format
   *
   * @var string
   */
  protected $format = 'd.m.Y H:i';

  /**
   * State
   *
   * @var bool
   */
  private $readonly = TRUE;

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
   * Sets the date input box to read only and only allow change via the date
   * picker or vice versa, allow changing the field value directly
   *
   * @param bool $state
   * @return self
   */
  public function setReadOnly($state)
  {
    $this->readonly = (bool) $state;

    return $this;
  }

  /**
   * Generates control's HTML element
   *
   * @return \Nette\Utils\Html
   */
  public function getControl()
  {
    $control = parent::getControl();

    $control->class = 'datetimepicker form-control';
    $control->readonly = $this->readonly;

    return $control;
  }

  /**
   * Registers this control
   *
   * @param string $format format
   * @return self
   */
  public static function register($format = NULL)
  {
    Container::extensionMethod('addDateTimePicker', function($container, $name, $label = NULL, $maxLength = NULL) use ($format)
    {
      $picker = $container[$name] = new DateTimePicker($label, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });

    parent::setValidationMessages();
  }
}