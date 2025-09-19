<?php
/**
 * Twitter Bootstrap DatePicker Input Control
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

/**
 * Twitter Bootstrap DatePicker Input Control
 *
 * @author Radek Dostál
 */
class TbDatePicker extends AbstractDateTimePicker
{
  protected string $format = 'd.m.Y';

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

  public static function register(?string $format = NULL): void
  {
    Container::extensionMethod('addTbDatePicker', function($container, $name, $label = NULL, ?int $maxLength = NULL) use ($format): TbDatePicker
    {
      $picker = $container[$name] = new TbDatePicker($label, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });

    parent::setValidationMessages();
  }
}