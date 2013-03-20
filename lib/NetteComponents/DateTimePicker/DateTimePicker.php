<?php
/**
 * DateTimePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   http://addons.nette.org/datetimepicker
 * @version   $Id: DateTimePicker.php,v 1.2.1 2013/03/20 10:59:00 dostal Exp $
 * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2010 - 2013 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents;

use Nette\Forms\Controls\TextInput;

class DateTimePicker extends TextInput
{
  /**
   * Initialization
   *
   * @access public
   * @param string $label label
   * @param int $cols width of element
   * @param int $maxLength maximum count of chars
   * @since 1.0.0
   */
  public function __construct($label, $cols = NULL, $maxLength = NULL)
  {
    parent::__construct($label, $cols, $maxLength);
  }

  /**
   * Returns date and time
   *
   * @access public
   * @return mixed
   * @since 1.0.0
   */
  public function getValue()
  {
    if (strlen($this->value))
    {
      $tmp = explode(' ', $this->value);
      $date = explode('/', $tmp[0]);

      // Database datetime format: Y-m-d H:i:s
      return @$date[2].'-'.@$date[1].'-'.@$date[0].' '.@$tmp[1];
    }

    return $this->value;
  }

  /**
   * Sets date and time
   *
   * @access public
   * @param string $value date and time
   * @return void
   * @since 1.0.0
   */
  public function setValue($value)
  {
    $value = preg_replace('~([0-9]{4})-([0-9]{2})-([0-9]{2})~', '$3/$2/$1', $value);

    parent::setValue($value);
  }

  /**
   * Generates control's HTML element
   *
   * @access public
   * @return \Nette\Utils\Html
   * @since 1.0.0
   */
  public function getControl()
  {
    $control = parent::getControl();

    $control->class = 'datetimepicker';
    $control->readonly = TRUE;

    return $control;
  }
}