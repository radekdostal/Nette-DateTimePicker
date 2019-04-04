<?php
/**
 * RadekDostal\NetteComponents\DateTimePicker\TbDateTimePicker example
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

RadekDostal\NetteComponents\DateTimePicker\TbDateTimePicker::register();

$form = new Form();

$form->getElementPrototype()->class('form-horizontal');

$form->addTbDateTimePicker('date', 'Date and time:')
  //->setFormat('m/d/Y H:i') // for en locale
  ->setRequired()
  //->addRule(Form::MIN, NULL, new DateTime('2016-09-01 13:20'))
  //->addRule(Form::MAX, NULL, new DateTime('2016-09-15 15:30'))
  //->addRule(Form::RANGE, NULL, [new DateTime('2016-09-01 13:20'), new DateTime('2016-09-15 15:30')])
  ->setHtmlAttribute('class', 'form-control datetimepicker')
  ->setHtmlAttribute('id', 'datetime')
  ->setHtmlAttribute('data-toggle', 'datetimepicker')
  ->setHtmlAttribute('data-target', '#datetime')
  ->getLabelPrototype()
  ->setAttribute('class', 'col-sm-3 col-form-label');

$form->addSubmit('submit', 'Send')
  ->setHtmlAttribute('class', 'btn btn-primary');

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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Radek Dostál">
  <title>RadekDostal\NetteComponents\DateTimePicker\TbDateTimePicker example</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>
  <script type="text/javascript">
    <!-- <![CDATA[
    $(document).ready(function()
    {
      $('.datetimepicker').datetimepicker(
      {
        locale: 'cs',  // en
        format: 'D.M.YYYY HH:mm',  // MM/DD/YYYY HH:mm
        useCurrent: false
      });
    });
    //]]> -->
  </script>
</head>
<body>
  <h1>RadekDostal\NetteComponents\DateTimePicker\TbDateTimePicker example</h1>
  <?php $form->render('begin'); ?>
  <?php if ($form->hasErrors() === TRUE): ?>
  <ul class="alert alert-danger list-unstyled">
    <?php foreach ($form->getErrors() as $error): ?>
    <li><?php echo htmlspecialchars($error) ?></li>
    <?php endforeach ?>
  </ul>
  <?php endif ?>
  <div class="form-group row">
    <?php echo $form['date']->getLabel(); ?>
    <div class="col-sm-4 col-md-2">
      <div class="input-group">
        <?php echo $form['date']->getControl(); ?>
        <div class="input-group-append">
          <span class="input-group-text">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-sm-3 col-sm-9">
      <?php echo $form['submit']->getControl(); ?>
    </div>
  </div>
  <?php $form->render('end'); ?>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>