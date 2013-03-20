<?php
/**
 * RadekDostal\NetteComponents\DateTimePicker with jQuery and jQuery UI example
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   http://addons.nette.org/datetimepicker
 * @version   $Id: DateTimePicker.test.php,v 1.2.1 2013/03/20 11:42:00 dostal Exp $
 * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2010 - 2013 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

use Nette\Diagnostics\Debugger;
use Nette\Forms\Form;

require_once('lib/Nette/nette.min.php');
require_once('lib/NetteComponents/DateTimePicker/DateTimePicker.php');

Debugger::$strictMode = TRUE;
Debugger::enable();

Form::extensionMethod('addDateTimePicker', function(Form $_this, $name, $label, $cols = NULL, $maxLength = NULL)
{
  return $_this[$name] = new RadekDostal\NetteComponents\DateTimePicker($label, $cols, $maxLength);
});

$form = new Form();

$form->addDateTimePicker('datetime', 'Date and time:', 16, 16)
  ->addRule($form::FILLED, 'Please select date and time.');

$form->addSubmit('submit', 'Send');

if ($form->isSubmitted())
{
  if ($form->isValid())
  {
    echo '<h2>Form was submitted and successfully validated</h2>';

    Debugger::dump($form->values);
    exit;
  }
}
/*else
  $form->setDefaults(array(
    'datetime' => date('Y-d-m H:i')
  ));*/
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Radek Dostál">
  <title>RadekDostal\NetteComponents\DateTimePicker with jQuery and jQuery UI example</title>
  <link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" type="text/css" href="js/jquery-ui/datetimepicker/timepicker.css">
  <script type="text/javascript" src="js/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui/datetimepicker/timepicker.js"></script>
  <script type="text/javascript" src="js/nette/netteForms.js"></script>
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
      font-family: Tahoma, Verdana, Arial, sans-serif;
      background-color: #FFFFFF;
      color: #000000;
    }

    input.datetimepicker
    {
      border: 1px solid #C0C0C0;
      padding: 2pt;
      background: transparent url('img/calendar.png') no-repeat right;
    }
    -->
  </style>
</head>
<body>
  <h1>RadekDostal\NetteComponents\DateTimePicker with jQuery and jQuery UI example</h1>
<?php
  echo $form;
?>
</body>
</html>