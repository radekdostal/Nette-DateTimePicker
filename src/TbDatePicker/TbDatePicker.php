<?php
/**
 * Twitter Bootstrap DatePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2014 - 2016 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Container;
use Nette\Forms\Controls\TextInput;
use Nette\Forms\Form;
use Nette\Forms\IControl;
use Nette\Forms\Rules;
use Nette\Forms\Validator;
use Nette\Utils\DateTime;

/**
 * Twitter Bootstrap DatePicker Input Control
 *
 * @author Radek Dostál
 */
class TbDatePicker extends TextInput
{
  /**
   * Default format
   *
   * @var string
   */
  private $format = 'd.m.Y';

  /**
   * Range
   *
   * @var array
   */
  private $range = array(
    'min' => NULL,
    'max' => NULL
  );

  /**
   * Minimum date
   *
   * @var \DateTime
   */
  private $minDate;

  /**
   * Maximum date
   *
   * @var \DateTime
   */
  private $maxDate;

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
   * Returns date
   *
   * @return mixed
   */
  public function getValue()
  {
    if (strlen($this->value) > 0)
    {
      $date = DateTime::createFromFormat($this->format, $this->value);

      if ($date === FALSE)
      {
        $this->addError($this->getValueErrorMessage());

        return FALSE;
      }

      return $date->setTime(0, 0, 0);
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
    if ($value instanceof \DateTime)
      $value = $value->format($this->format);

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
    if ($validator === Form::MIN)
    {
      $this->minDate = $arg;

      $arg = $arg->format($this->format);

      $validator = __CLASS__.'::validateMin';
    }
    else if ($validator === Form::MAX)
    {
      $this->maxDate = $arg;

      $arg = $arg->format($this->format);

      $validator = __CLASS__.'::validateMax';
    }
    else if ($validator === Form::RANGE)
    {
      $this->range['min'] = $arg[0];
      $this->range['max'] = $arg[1];

      $arg[0] = $arg[0]->format($this->format);
      $arg[1] = $arg[1]->format($this->format);

      $validator = __CLASS__.'::validateRange';
    }

    return parent::addRule($validator, $message, $arg);
  }

  /**
   * Validates minimum date
   *
   * @param \Nette\Forms\IControl $control control
   * @param mixed $minimum minimum date
   * @return bool
   */
  public static function validateMin(IControl $control, $minimum)
  {
    return $control->getValue() >= $control->minDate;
  }

  /**
   * Validates maximum date
   *
   * @param \Nette\Forms\IControl $control control
   * @param mixed $maximum maximum date
   * @return bool
   */
  public static function validateMax(IControl $control, $maximum)
  {
    return $control->getValue() <= $control->maxDate;
  }

  /**
   * Validates range
   *
   * @param \Nette\Forms\IControl $control control
   * @param array $range minimum and maximum dates
   * @return bool
   */
  public static function validateRange(IControl $control, $range)
  {
    if ($control->range['min'] !== NULL)
    {
      if ($control->range['min'] > $control->getValue())
        return FALSE;
    }

    if ($control->range['max'] !== NULL)
    {
      if ($control->range['max'] < $control->getValue())
        return FALSE;
    }

    return TRUE;
  }

  /**
   * Registers this control
   *
   * @param string $format format
   * @return self
   */
  public static function register($format = NULL)
  {
    Container::extensionMethod('addTbDatePicker', function($container, $name, $label = NULL, $maxLength = NULL) use ($format)
    {
      $picker = $container[$name] = new TbDatePicker($label, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });

    $valueErrorMessage = 'Please enter a valid date format.';

    // Nette >= 2.3
    if (class_exists('\Nette\Forms\Validator') === TRUE)
    {
      Validator::$messages[__CLASS__.'::validateMin'] = Validator::$messages[Form::MIN];
      Validator::$messages[__CLASS__.'::validateMax'] = Validator::$messages[Form::MAX];
      Validator::$messages[__CLASS__.'::validateRange'] = Validator::$messages[Form::RANGE];
      Validator::$messages[__CLASS__.'::valueError'] = $valueErrorMessage;
    }
    else
    {
      Rules::$defaultMessages[__CLASS__.'::validateMin'] = Rules::$defaultMessages[Form::MIN];
      Rules::$defaultMessages[__CLASS__.'::validateMax'] = Rules::$defaultMessages[Form::MAX];
      Rules::$defaultMessages[__CLASS__.'::validateRange'] = Rules::$defaultMessages[Form::RANGE];
      Rules::$defaultMessages[__CLASS__.'::valueError'] = $valueErrorMessage;
    }
  }

  /**
   * Gets value error message
   *
   * @return string
   */
  protected function getValueErrorMessage()
  {
    // Nette >= 2.3
    if (class_exists('\Nette\Forms\Validator') === TRUE)
      $msg = Validator::$messages[__CLASS__.'::valueError'];
    else
      $msg = Rules::$defaultMessages[__CLASS__.'::valueError'];

    return sprintf($msg);
  }
}