<?php
/**
 * Abstract DateTime Picker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright © 2016 - 2024 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Control;
use Nette\Forms\Controls\TextInput;
use Nette\Forms\Form;
use Nette\Forms\Validator;

/**
 * Abstract DateTime Picker Input Control
 *
 * @author Radek Dostál
 */
abstract class AbstractDateTimePicker extends TextInput
{
  protected string $format = '';

  protected array $range = [
    'min' => NULL,
    'max' => NULL
  ];

  protected ?string $errorMessage = NULL;

  public function __construct($label = NULL, ?int $maxLength = NULL)
  {
    parent::__construct($label, $maxLength);
  }

  public function setFormat(string $format): static
  {
    $this->format = $format;

    return $this;
  }

  public function setValue($value): void
  {
    if ($value instanceof \DateTimeInterface)
      $value = $value->format($this->format);

    if ($this->errorMessage !== NULL && $this->value !== NULL)
    {
      if ($this->range['min'] !== NULL && $this->range['max'] !== NULL)
        $this->addRule(Form::RANGE, $this->errorMessage, [$this->range['min'], $this->range['max']]);
      elseif ($this->range['min'] !== NULL)
        $this->addRule(Form::MIN, $this->errorMessage, $this->range['min']);
      else
        $this->addRule(Form::MAX, $this->errorMessage, $this->range['max']);
    }

    parent::setValue($value);
  }

  public function addRule($validator, $errorMessage = NULL, $arg = NULL): static
  {
    $class = get_called_class();

    switch ($validator)
    {
      case Form::MIN:
        $this->range['min'] = $arg;
        $arg = $arg->format($this->format);
        $validator = $class.'::validateMin';
        break;

      case Form::MAX:
        $this->range['max'] = $arg;
        $arg = $arg->format($this->format);
        $validator = $class.'::validateMax';
        break;

      case Form::RANGE:
        $this->range['min'] = $arg[0];
        $this->range['max'] = $arg[1];

        $arg[0] = $arg[0]->format($this->format);
        $arg[1] = $arg[1]->format($this->format);

        $validator = $class.'::validateRange';
        break;

      default:
        break;
    }

    return parent::addRule($validator, $errorMessage, $arg);
  }

  public static function validateMin(Control $control, string $minimum): bool
  {
    if ($control->getValue() !== '')
      return $control->getValue() >= $control->range['min'];

    return TRUE;
  }

  public static function validateMax(Control $control, string $maximum): bool
  {
    if ($control->getValue() !== '')
      return $control->getValue() <= $control->range['max'];

    return TRUE;
  }

  public static function validateRange(Control $control, array $range): bool
  {
    if ($control->getValue() !== '')
    {
      if ($control->range['min'] !== NULL)
      {
        if ($control->getValue() < $control->range['min'])
          return FALSE;
      }

      if ($control->range['max'] !== NULL)
      {
        if ($control->getValue() > $control->range['max'])
          return FALSE;
      }
    }

    return TRUE;
  }

  protected static function setValidationMessages(): void
  {
    $class = get_called_class();

    Validator::$messages[$class.'::validateMin'] = Validator::$messages[Form::MIN];
    Validator::$messages[$class.'::validateMax'] = Validator::$messages[Form::MAX];
    Validator::$messages[$class.'::validateRange'] = Validator::$messages[Form::RANGE];
    Validator::$messages[$class.'::valueError'] = 'Please enter a valid datetime format.';
  }

  protected function getValueErrorMessage(): string
  {
    $class = get_called_class();
    $msg = Validator::$messages[$class.'::valueError'];

    return sprintf($msg);
  }
}