<?php
/**
 * RadekDostal\NetteComponents\DateTimePicker\TbDateTimePicker example
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2014 - 2017 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

use Nette\Forms\Form;
use Tracy\Debugger;

require '../vendor/autoload.php';

Debugger::$strictMode = TRUE;
Debugger::enable();

RadekDostal\NetteComponents\DateTimePicker\TbDateTimePicker::register();

$form = new Form();

$form->getElementPrototype()->class('form-horizontal');

$form->addTbDateTimePicker('date', 'Date and time:')
  //->setFormat('m/d/Y H:i') // for en locale
  ->setRequired()
  //->addRule(Form::MIN, NULL, new DateTime('2016-09-01 13:20'))
  //->addRule(Form::MAX, NULL, new DateTime('2016-09-15 15:30'))
  //->addRule(Form::RANGE, NULL, array(new DateTime('2016-09-01 13:20'), new DateTime('2016-09-15 15:30')))

  // Nette < 2.4 where date and time is optional
  //->addConditionalRule(Form::MIN, NULL, new DateTime('2016-09-01 13:20'))
  //->addConditionalRule(Form::MAX, NULL, new DateTime('2016-09-15 15:30'))
  //->addConditionalRule(Form::RANGE, NULL, array(new DateTime('2016-09-01 13:20'), new DateTime('2016-09-15 15:30')))

  ->setAttribute('class', 'form-control')
  ->getLabelPrototype()
  ->setAttribute('class', 'control-label col-sm-3');

$form->addSubmit('submit', 'Send')
  ->setAttribute('class', 'btn btn-default');

if ($form->isSuccess() === TRUE)
{
  echo '<h2>Form was submitted and successfully validated</h2>';

  Debugger::dump($form->getValues());
  exit;
}
/*else
{
  $form->setDefaults(array(
    'date' => new \DateTime()
  ));
}*/
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Radek Dostál">
  <title>RadekDostal\NetteComponents\DateTimePicker\TbDateTimePicker example</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/smalot-bootstrap-datetimepicker/2.4.4/css/bootstrap-datetimepicker.min.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-3.2.1.min.js"></script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/smalot-bootstrap-datetimepicker/2.4.4/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/smalot-bootstrap-datetimepicker/2.4.4/js/locales/bootstrap-datetimepicker.cs.js"></script>
  <script type="text/javascript">
    <!-- <![CDATA[
    $(document).ready(function()
    {
      $('.datetimepicker').datetimepicker(
      {
        language: 'cs',  // en
        format: 'dd.mm.yyyy hh:ii',  // mm/dd/yyyy hh:ii
        autoclose: true,
        todayBtn: true
      });
    });
    //]]> -->
  </script>
</head>
<body>
  <h1>RadekDostal\NetteComponents\DateTimePicker\TbDateTimePicker example</h1>
  <?php $form->render('begin'); ?>
  <?php if ($form->hasErrors() === TRUE): ?>
  <ul class="error">
    <?php foreach ($form->getErrors() as $error): ?>
    <li><?php echo htmlspecialchars($error) ?></li>
    <?php endforeach ?>
  </ul>
  <?php endif ?>
  <div class="form-group">
    <?php echo $form['date']->getLabel(); ?>
    <div class="col-sm-4 col-md-2">
      <div class="input-group date datetimepicker">
        <?php echo $form['date']->getControl(); ?>
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
        </span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <?php echo $form['submit']->getControl(); ?>
    </div>
  </div>
  <?php $form->render('end'); ?>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>