<?php
/**
 * DatePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   http://addons.nette.org/radekdostal/nette-datetimepicker
 * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2014 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Controls\TextInput;

/**
 * DatePicker Input Control
 *
 * @author Radek Dostál
 */
class DatePicker extends TextInput
{
  /**
   * Initialization
   *
   * @param string $label label
   * @param int $cols width of element
   * @param int $maxLength maximum count of chars
   */
  public function __construct($label, $cols = NULL, $maxLength = NULL)
  {
    parent::__construct($label, $cols, $maxLength);
  }

  /**
   * Returns date
   *
   * @return mixed
   */
  public function getValue()
  {
    if (strlen($this->value) > 0)
    {
      $date = preg_replace('~([[:space:]])~', '', $this->value);
      $date = explode('.', $date);

      // Database date format: Y-m-d
      return @$date[2].'-'.@$date[1].'-'.@$date[0];
    }

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
    $value = preg_replace('~([0-9]{4})-([0-9]{2})-([0-9]{2})~', '$3.$2.$1', $value);

    parent::setValue($value);
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
    $control->readonly = TRUE;

    return $control;
  }
}