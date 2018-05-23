<?php
/**
 * Abstract DateTime Picker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2016 - 2018 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Controls\TextInput;
use Nette\Forms\Form;
use Nette\Forms\IControl;
use Nette\Forms\Rules;
use Nette\Forms\Validator;

/**
 * Abstract DateTime Picker Input Control
 *
 * @author Radek Dostál
 */
abstract class AbstractDateTimePicker extends TextInput
{
  /**
   * Default format
   *
   * @var string
   */
  protected $format = '';

  /**
   * Range
   *
   * @var array
   */
  protected $range = array(
    'min' => NULL,
    'max' => NULL
  );

  /**
   * Validation message
   *
   * @var string
   */
  protected $message = NULL;

  /**
   * Initialization
   *
   * @param string $label label
   * @param int $maxLength maximum count of chars
   */
  public function __construct($label = NULL, $maxLength = NULL)
  {
    parent::__construct($label, $maxLength);
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
   * Sets date and time
   *
   * @param string $value date and time
   * @return void
   */
  public function setValue($value)
  {
    if ($value instanceof \DateTime || $value instanceof \DateTimeImmutable)
      $value = $value->format($this->format);

    if ($this->message !== NULL && $this->value !== NULL)
    {
      if ($this->range['min'] !== NULL && $this->range['max'] !== NULL)
        $this->addRule(Form::RANGE, $this->message, array($this->range['min'], $this->range['max']));
      elseif ($this->range['min'] !== NULL)
        $this->addRule(Form::MIN, $this->message, $this->range['min']);
      else
        $this->addRule(Form::MAX, $this->message, $this->range['max']);
    }

    parent::setValue($value);
  }

  /**
   * Adds a validation rule
   *
   * @param mixed $validator rule type
   * @param string $message message to display for invalid data
   * @param mixed $arg optional rule arguments
   * @return self
   */
  public function addRule($validator, $message = NULL, $arg = NULL)
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

    return parent::addRule($validator, $message, $arg);
  }

  /**
   * Adds a conditional validation rule
   *
   * @param mixed $validator rule type
   * @param string $message message to display for invalid data
   * @param mixed $arg optional rule arguments
   * @return self
   */
  public function addConditionalRule($validator, $message, $arg)
  {
    if (in_array($validator, array(Form::MIN, Form::MAX, Form::RANGE)) === TRUE)
    {
      if (method_exists($this->getForm(), 'getPresenter') === TRUE)
      {
        $this->message = $message;

        switch ($validator)
        {
          case Form::MIN:
            $this->range['min'] = $arg;
            break;

          case Form::MAX:
            $this->range['max'] = $arg;
            break;

          case Form::RANGE:
            $this->range['min'] = $arg[0];
            $this->range['max'] = $arg[1];
            break;

          default:
            break;
        }

        return $this;
      }
    }

    return $this->getValue() instanceof \DateTime || $this->getValue() instanceof \DateTimeImmutable ? $this->addRule($validator, $message, $arg) : $this;
  }

  /**
   * Validates minimum date and time
   *
   * @param \Nette\Forms\IControl $control control
   * @param mixed $minimum minimum date and time
   * @return bool
   */
  public static function validateMin(IControl $control, $minimum)
  {
    if ($control->getValue() !== '')
      return $control->getValue() >= $control->range['min'];

    return TRUE;
  }

  /**
   * Validates maximum date and time
   *
   * @param \Nette\Forms\IControl $control control
   * @param mixed $maximum maximum date and time
   * @return bool
   */
  public static function validateMax(IControl $control, $maximum)
  {
    if ($control->getValue() !== '')
      return $control->getValue() <= $control->range['max'];

    return TRUE;
  }

  /**
   * Validates range
   *
   * @param \Nette\Forms\IControl $control control
   * @param array $range minimum and maximum dates and times
   * @return bool
   */
  public static function validateRange(IControl $control, $range)
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

  /**
   * Sets validation messages
   *
   * @return void
   */
  protected static function setValidationMessages()
  {
    $class = get_called_class();
    $valueErrorMessage = 'Please enter a valid datetime format.';

    // Nette >= 2.3
    if (class_exists('\Nette\Forms\Validator') === TRUE)
    {
      Validator::$messages[$class.'::validateMin'] = Validator::$messages[Form::MIN];
      Validator::$messages[$class.'::validateMax'] = Validator::$messages[Form::MAX];
      Validator::$messages[$class.'::validateRange'] = Validator::$messages[Form::RANGE];
      Validator::$messages[$class.'::valueError'] = $valueErrorMessage;
    }
    else
    {
      Rules::$defaultMessages[$class.'::validateMin'] = Rules::$defaultMessages[Form::MIN];
      Rules::$defaultMessages[$class.'::validateMax'] = Rules::$defaultMessages[Form::MAX];
      Rules::$defaultMessages[$class.'::validateRange'] = Rules::$defaultMessages[Form::RANGE];
      Rules::$defaultMessages[$class.'::valueError'] = $valueErrorMessage;
    }
  }

  /**
   * Gets value error message
   *
   * @return string
   */
  protected function getValueErrorMessage()
  {
    $class = get_called_class();

    // Nette >= 2.3
    if (class_exists('\Nette\Forms\Validator') === TRUE)
      $msg = Validator::$messages[$class.'::valueError'];
    else
      $msg = Rules::$defaultMessages[$class.'::valueError'];

    return sprintf($msg);
  }
}