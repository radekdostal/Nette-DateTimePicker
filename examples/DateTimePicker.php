<?php
/**
 * RadekDostal\NetteComponents\DateTimePicker\DateTimePicker example
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright © 2010 - 2024 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

use Nette\Forms\Form;
use Tracy\Debugger;

require '../vendor/autoload.php';

Debugger::$strictMode = TRUE;
Debugger::enable();

RadekDostal\NetteComponents\DateTimePicker\DateTimePicker::register();

$form = new Form();

$form->addDateTimePicker('datetime', 'Date and time:', 16)
  //->setFormat('m/d/Y H:i') // for datetimepicker option dateFormat: 'mm/dd/yy'
  //->setReadOnly(FALSE)
  ->setRequired()
  //->addRule(Form::Min, NULL, new DateTime('2016-09-01 13:20'))
  //->addRule(Form::Max, NULL, new DateTime('2016-09-15 15:30'))
  //->addRule(Form::Range, NULL, [new DateTime('2016-09-01 13:20'), new DateTime('2016-09-15 15:30')])
  ->setHtmlAttribute('size', 16);

$form->addSubmit('submit', 'Send');

if ($form->isSuccess() === TRUE)
{
  echo '<h2>Form was submitted and successfully validated</h2>';

  Debugger::dump($form->getValues());
  exit;
}
/*else
{
  $form->setDefaults([
    'datetime' => new \DateTime()
  ]);
}*/
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Radek Dostál">
  <title>RadekDostal\NetteComponents\DateTimePicker\DateTimePicker example</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
  <script>
    $(function()
    {
      $('input.datetimepicker').datetimepicker(
      {
        duration: '',
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd.mm.yy',  // mm/dd/yy
        yearRange: '2010:2020',
        stepMinute: 5
      });
    });
  </script>
  <style>
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