<?php
/**
 * RadekDostal\NetteComponents\DateTimePicker\DatePicker example
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright © 2014 - 2019 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

use Nette\Forms\Form;
use Tracy\Debugger;

require '../vendor/autoload.php';

Debugger::$strictMode = TRUE;
Debugger::enable();

RadekDostal\NetteComponents\DateTimePicker\DatePicker::register();

$form = new Form();

$form->addDatePicker('date', 'Date:', 10)
  //->setFormat('m/d/Y') // for datepicker option dateFormat: 'mm/dd/yy'
  //->setReadOnly(FALSE)
  ->setRequired()
  //->addRule(Form::MIN, NULL, new DateTime('2016-09-01'))
  //->addRule(Form::MAX, NULL, new DateTime('2016-09-15'))
  //->addRule(Form::RANGE, NULL, [new DateTime('2016-09-01'), new DateTime('2016-09-15')])
  ->setHtmlAttribute('size', 10);

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
    'date' => new \DateTime()
  ]);
}*/
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Radek Dostál">
  <title>RadekDostal\NetteComponents\DateTimePicker\DatePicker example</title>
  <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
  <script type="text/javascript">
    <!-- <![CDATA[
    $(document).ready(function()
    {
      $('input.datepicker').datepicker(
      {
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd.mm.yy',  // mm/dd/yy
        yearRange: '2010:2020'
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

    input.datepicker
    {
      border: 1px solid #C0C0C0;
      padding: 2pt;
      background: transparent url('img/calendar.png') no-repeat right;
    }
    -->
  </style>
</head>
<body>
  <h1>RadekDostal\NetteComponents\DateTimePicker\DatePicker example</h1>
<?php
  echo $form;
?>
</body>
</html>