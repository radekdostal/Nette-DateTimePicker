<?php
 /**
  * Nette\Extras\DateTimePicker with jQuery 1.6.2 and jQuery UI 1.8.16 example
  *
  * @package   Nette\Extras\DateTimePicker
  * @example   http://addons.nette.org/datetimepicker
  * @version   $Id: DateTimePicker.test.php,v 1.2.0 2011/08/22 09:33:10 dostal Exp $
  * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
  * @copyright Copyright (c) 2010 - 2011 Radek Dostál
  * @license   GNU Lesser General Public License
  * @link      http://www.radekdostal.cz
  */

 use Nette\Diagnostics\Debugger,
     Nette\Forms,
     Nette\Extras;

 require_once('lib/Nette/loader.php');
 require_once('lib/Nette/Extras/DateTimePicker.php');

 Debugger::$strictMode = TRUE;
 Debugger::enable();

 function Form_addDateTimePicker(Forms\Form $_this, $name, $label, $cols = NULL, $maxLength = NULL)
 {
   return $_this[$name] = new Extras\DateTimePicker($label, $cols, $maxLength);
 }

 Forms\Form::extensionMethod('addDateTimePicker', 'Form_addDateTimePicker');

 $form = new Forms\Form();

 $form->addDateTimePicker('date_time', 'Date and time:', 16, 16)
      ->addRule($form::FILLED, 'Select date and time.');

 $form->addSubmit('send', 'Send');

 if ($form->isSubmitted())
 {
   if ($form->isValid())
   {
     echo '<h2>Form was submitted and successfully validated</h2>';

     Debugger::dump($form->values);

     exit;
   }
 }
 //else
   //$form->setDefaults(array('date_time' => date('Y-m-d H:i')));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="en" />
  <meta name="author" content="Radek Dostál" />
  <title>Nette\Extras\DateTimePicker with jQuery 1.6.2 and jQuery UI 1.8.16 example</title>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/jquery.ui.datepicker-en-GB.min.js"></script>
  <script type="text/javascript" src="js/timepicker.js"></script>
  <script type="text/javascript" src="js/netteForms.js"></script>
  <script type="text/javascript">
  <!-- <![CDATA[
    $(document).ready(function()
    {
      $('input.datetimepicker').datetimepicker(
      {
        duration: '',
        changeMonth: true,
        changeYear: true,
        yearRange: '2010:2020',
        stepMinute: 5
      });
    });
  //]]> -->
  </script>
  <style type="text/css">
  <!--
    body
    {
      font-family: 'Tahoma', 'Verdana', 'Arial';
      background-color: #FFFFFF;
      color: #000000;
      font-size: 70%;
    }

    input.datetimepicker
    {
      font-family: 'Tahoma', 'Verdana', 'Arial';
      font-size: 100%;
      border: 1px solid #C0C0C0;
      padding: 1.5pt 6pt 1.5pt 1.5pt;
      background: transparent url('img/calendar.png') no-repeat right;
    }

    input.button
    {
      font-family: 'Verdana', 'Tahoma', 'Arial';
      font-size: 100%;
    }
  //-->
  </style>
</head>
<body>
  <h1>Nette\Extras\DateTimePicker with jQuery 1.6.2 and jQuery UI 1.8.16 example</h1>
<?php
 echo $form;
?>
</body>
</html>