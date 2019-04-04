<?php
/**
 * Twitter Bootstrap DateTimePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright © 2014  - 2019 Radek Dostál
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
  /** @var string */
  protected $format = 'd.m.Y H:i';

  /** @return mixed */
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

    return parent::getValue();
  }

  public static function register(string $format = NULL): void
  {
    Container::extensionMethod('addTbDateTimePicker', function($container, $name, $label = NULL, int $maxLength = NULL) use ($format)
    {
      $picker = $container[$name] = new TbDateTimePicker($label, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });

    parent::setValidationMessages();
  }
}