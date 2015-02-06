<?php
/**
 * DatePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   http://addons.nette.org/radekdostal/nette-datetimepicker
 * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2014 - 2015 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Controls\TextInput;
use Nette\Utils\DateTime;

/**
 * DatePicker Input Control
 *
 * @author Radek Dostál
 */
class DatePicker extends TextInput
{
  /**
   * Default format
   *
   * @var string
   */
  private $format = 'd.m.Y';

  /** @var bool */
  private $readonly = true;
  
  /**
   * Initialization
   *
   * @param string $label label
   * @param int $cols width of element
   * @param int $maxLength maximum count of chars
   */
  public function __construct($label = NULL, $cols = NULL, $maxLength = NULL)
  {
    parent::__construct($label, $cols, $maxLength);
  }

  /**
   * Sets custom format
   *
   * @param string $format format
   * @return self
   */
  public function setFormat($format)
  {
    $this->format = $format;

    return $this;
  }

  /**
   * Returns date
   *
   * @return mixed
   */
  public function getValue()
  {
    if (strlen($this->value) > 0)
      return DateTime::createFromFormat($this->format, $this->value);

    return $this->value;
  }

  /**
   * Sets date
   *
   * @param string $value date
   * @return void
   */
  public function setValue($value)
  {
    if ($value instanceof \DateTime)
      $value = $value->format($this->format);

    parent::setValue($value);
  }
  

  /**
   * Set the date input box to read only and only allow change via the date picker,
   * or vice versa, allow changing the field value directly
   * 
   * @param bool $state
   */
  public function setReadOnly($state)
  {
    $this->readonly = !! $state;
  }


  /**
   * Generates control's HTML element
   *
   * @return \Nette\Utils\Html
   */
  public function getControl()
  {
    $control = parent::getControl();

    $control->class = 'datepicker form-control';
    $control->readonly = $this->readonly;

    return $control;
  }
}
