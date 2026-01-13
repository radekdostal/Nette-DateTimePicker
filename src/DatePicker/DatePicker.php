<?php
/**
 * DatePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright © 2014 - 2024 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Container;
use Nette\Utils\DateTime;
use Nette\Utils\Html;

/**
 * DatePicker Input Control
 *
 * @author Radek Dostál
 */
class DatePicker extends AbstractDateTimePicker
{
  protected string $format = 'd.m.Y';
  private bool $readonly = TRUE;

  public function getValue(): mixed
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

    return parent::getValue();
  }

  public function setReadOnly(bool $state): static
  {
    $this->readonly = $state;

    return $this;
  }

  public function getControl(): Html
  {
    $control = parent::getControl();

    $control->class = 'datepicker form-control';
    $control->readonly = $this->readonly;

    return $control;
  }

  public static function register(?string $format = NULL): void
  {
    Container::extensionMethod('addDatePicker', function($container, $name, $label = NULL, ?int $maxLength = NULL) use ($format): DatePicker
    {
      $picker = $container[$name] = new DatePicker($label, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });

    parent::setValidationMessages();
  }
}