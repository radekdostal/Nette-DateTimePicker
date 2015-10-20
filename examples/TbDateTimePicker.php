<?php
/**
 * RadekDostal\NetteComponents\DateTimePicker\TbDateTimePicker example
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   http://addons.nette.org/radekdostal/nette-datetimepicker
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2014 - 2015 Radek Dostál
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
  ->setAttribute('class', 'form-control datetimepicker');

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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript">
    <!-- <![CDATA[
    $(document).ready(function()
    {
      $('.datetimepicker').datetimepicker(
      {
        locale: 'cs',  // en
        format: 'DD.MM.YYYY H:mm'  // MM/DD/YYYY H:mm
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
    <label for="date" class="control-label col-sm-3"><?php echo $form['date']->getLabel(); ?></label>
    <div class="col-sm-4 col-md-2">
      <div class="input-group">
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>