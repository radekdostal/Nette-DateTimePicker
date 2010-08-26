<?php
 /**
  * DateTimePicker input control
  *
  * @package   Nette\Extras\DateTimePicker
  * @example   http://nettephp.com/extras/datetimepicker
  * @version   $Id: DateTimePicker.php,v 1.0.0 2010/08/25 22:26:50 dostal Exp $
  * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
  * @copyright Copyright (c) 2010 Radek Dostál
  * @license   GNU Lesser General Public License
  * @link      http://www.radekdostal.cz
  */

 //require_once(LIBS_DIR.'/Nette/Forms/Controls/TextInput.php');

 class DateTimePicker extends /*Nette\Forms\*/TextInput
 {
   /**
    * Konstruktor
    *
    * @access public
    * @param string $label label
    * @param int $cols šířka elementu input
    * @param int $maxLength parametr maximální počet znaků
    * @return void
    * @since 1.0.0
    */
   public function __construct($label, $cols = NULL, $maxLenght = NULL)
   {
     parent::__construct($label, $cols, $maxLenght);
   }

   /**
    * Vrácení hodnoty pole
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
       $date = explode('.', $tmp[0]);

       // Formát pro databázi: Y-m-d H:i:s
       // Doplněny zavináče (pole nemusí mít přesný počet prvků)
       return @$date[2].'-'.@$date[1].'-'.@$date[0].' '.@$tmp[1];
     }

     return $this->value;
   }

   /**
    * Nastavení hodnoty pole
    *
    * @access public
    * @param string $value hodnota
    * @return void
    * @since 1.0.0
    */
   public function setValue($value)
   {
     $value = preg_replace('~([0-9]{4})-([0-9]{2})-([0-9]{2})~', '$3.$2.$1', $value);

     parent::setValue($value);
   }

   /**
    * Generování HTML elementu
    *
    * @access public
    * @return Html
    * @since 1.0.0
    */
   public function getControl()
   {
     $control = parent::getControl();

     $control->class = 'datetimepicker';

     return $control;
   }
 }
?>