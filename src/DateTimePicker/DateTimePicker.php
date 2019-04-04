<?php
/**
 * DateTimePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright © 2010 - 2019 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Container;
use Nette\Utils\DateTime;
use Nette\Utils\Html;

/**
 * DateTimePicker Input Control
 *
 * @author Radek Dostál
 */
class DateTimePicker extends AbstractDateTimePicker
{
  /** @var string */
  protected $format = 'd.m.Y H:i';

  /** @var bool */
  private $readonly = TRUE;

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

  /** @return static */
  public function setReadOnly(bool $state)
  {
    $this->readonly = $state;

    return $this;
  }

  public function getControl(): Html
  {
    $control = parent::getControl();

    $control->class = 'datetimepicker form-control';
    $control->readonly = $this->readonly;

    return $control;
  }

  public static function register(string $format = NULL): void
  {
    Container::extensionMethod('addDateTimePicker', function($container, $name, $label = NULL, int $maxLength = NULL) use ($format)
    {
      $picker = $container[$name] = new DateTimePicker($label, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });

    parent::setValidationMessages();
  }
}