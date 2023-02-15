<?php
/**
 * RadekDostal\NetteComponents\DateTimePicker\Tb5DatePicker example
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   https://componette.com/radekdostal/nette-datetimepicker/
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright © 2023 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      https://www.radekdostal.cz
 */

use Nette\Forms\Form;
use Tracy\Debugger;

require '../vendor/autoload.php';

Debugger::$strictMode = TRUE;
Debugger::enable();

RadekDostal\NetteComponents\DateTimePicker\TbDatePicker::register();

$form = new Form();

$form->addTbDatePicker('date', 'Date:')
  //->setFormat('m/d/Y') // for en locale
  ->setRequired()
  //->addRule(Form::MIN, NULL, new DateTime('2016-09-01'))
  //->addRule(Form::MAX, NULL, new DateTime('2016-09-15'))
  //->addRule(Form::RANGE, NULL, [new DateTime('2016-09-01'), new DateTime('2016-09-15')])
  ->setHtmlAttribute('class', 'form-control datepicker-input')
  ->getLabelPrototype()
  ->setAttribute('class', 'form-label');

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
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Radek Dostál">
  <title>RadekDostal\NetteComponents\DateTimePicker\Tb5DatePicker example</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.1/dist/css/datepicker.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.1/dist/css/datepicker-bs5.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.1/dist/js/datepicker.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.1/dist/js/locales/cs.js"></script>
</head>
<body class="d-flex flex-column h-100">
  <main class="flex-shrink-0">
    <div class="container">
      <h1>RadekDostal\NetteComponents\DateTimePicker\Tb5DatePicker example</h1>
      <?php $form->render('begin'); ?>
      <?php if ($form->hasErrors() === TRUE): ?>
      <ul class="alert alert-danger list-unstyled">
        <?php foreach ($form->getErrors() as $error): ?>
        <li><?php echo htmlspecialchars($error) ?></li>
        <?php endforeach ?>
      </ul>
      <?php endif ?>
      <div class="row mb-3">
        <div class="col-sm-4">
          <?php echo $form['date']->getLabel(); ?>
          <div class="input-group">
            <?php echo $form['date']->getControl(); ?>
            <span class="input-group-text">
              <span class="bi bi-calendar"></span>
            </span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <?php echo $form['submit']->getControl(); ?>
        </div>
      </div>
      <?php $form->render('end'); ?>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript">
    const datepicker = new Datepicker(document.querySelector('input.datepicker-input'),
    {
      language: 'cs',
      format: 'd.m.y',  // m/d/y
      todayHighlight: true,
      autohide: true
    });
  </script>
</body>
</html>