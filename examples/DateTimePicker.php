<?php
/**
 * RadekDostal\NetteComponents\DateTimePicker\DateTimePicker example
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   http://addons.nette.org/radekdostal/nette-datetimepicker
 * @author    Ing. Radek Dostál <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2010 - 2015 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

use Nette\Forms\Form;
use Tracy\Debugger;

require '../vendor/autoload.php';

Debugger::$strictMode = TRUE;
Debugger::enable();

Form::extensionMethod('addDateTimePicker', function(Form $_this, $name, $label = NULL, $cols = NULL, $maxLength = NULL)
{
  return $_this[$name] = new RadekDostal\NetteComponents\DateTimePicker\DateTimePicker($label, $cols, $maxLength);
});

$form = new Form();

$form->addDateTimePicker('datetime', 'Date and time:', 16, 16)
  //->setFormat('m/d/Y H:i') // for datetimepicker option dateFormat: 'mm/dd/yy'
  ->setRequired();

$form->addSubmit('submit', 'Send');

if ($form->isSuccess())
{
  echo '<h2>Form was submitted and successfully validated</h2>';

  Debugger::dump($form->getValues());
  exit;
}
/*else
{
  $form->setDefaults(array(
    'datetime' => new \DateTime()
  ));
}*/
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Radek Dostál">
  <title>RadekDostal\NetteComponents\DateTimePicker\DateTimePicker example</title>
  <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
  <script type="text/javascript">
    <!-- <![CDATA[
    $(document).ready(function()
    {
      $('input.datetimepicker').datetimepicker(
      {
        duration: '',
        changeMonth: true,
        changeYear: true,
        //dateFormat: 'mm/dd/yy',
        dateFormat: 'dd.mm.yy',
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
  <h1>RadekDostal\NetteComponents\DateTimePicker\DateTimePicker example</h1>
<?php
  echo $form;
?>
</body>
</html>