# DateTimePicker for Nette Framework

DatePicker and DateTimePicker input controls for Nette Framework

- Author: Radek Dostál &lt;radek.dostal@gmail.com&gt;
- Copyright: Copyright (c) 2010 - 2017 [Radek Dostál](https://www.radekdostal.cz)
- Licence: [GNU Lesser General Public License](https://www.gnu.org/licenses/)
- Github: [radekdostal/Nette-DateTimePicker](https://github.com/radekdostal/Nette-DateTimePicker)

This add-on creates input box to select date or date and time.

## Requirements

- **[PHP](https://php.net)** 5.3 or later
- **[Nette Dependency Injection](https://github.com/nette/di)** 2.2 or later
- **[Nette Forms: greatly facilitates secure web forms](https://github.com/nette/forms)** 2.2 or later
- **[Nette Utilities and Core Classes](https://github.com/nette/utils)** 2.2 or later
- **[jQuery](https://jquery.com)** 1.9.1 or later
- **[jQuery UI](https://jqueryui.com)** 1.10.2 or later (DatePicker and DateTimePicker only)
- **[jQuery Timepicker Addon](http://trentrichardson.com/examples/timepicker)** 1.2 or later (DateTimePicker only)
- **[Bootstrap datetimepicker](https://github.com/smalot/bootstrap-datetimepicker)** 3.1.2 or later (TbDatePicker and TbDateTimePicker only)

## GNU Lesser General Public License

LGPL licenses are very very long, so instead of including them here we offer you URLs with full text:

- [LGPL version 2.1](https://www.gnu.org/licenses/lgpl-2.1.html)
- [LGPL version 3](https://www.gnu.org/licenses/lgpl-3.0.html)

## Example of using DI extension

config.neon:

```php
extensions:
  tbDatePicker: RadekDostal\NetteComponents\DateTimePicker\TbDatePicker\DI\TbDatePickerExtension
 
tbDatePicker:
  format: j. n. Y
```

Part of form definition where date is optional (**Nette 2.4**):

```php
$this->addTbDatePicker('date', 'Date')
  ->setRequired(FALSE)
  ->addRule(self::RANGE, NULL, array(new \DateTime('2016-09-01'), new \DateTime('2016-09-15')));
```

Part of form definition where date is optional (**Nette &lt; 2.4**):
```php
$this->addTbDatePicker('date', 'Date')
  ->addConditionalRule(self::RANGE, NULL, array(new \DateTime('2016-09-01'), new \DateTime('2016-09-15')));
```

Learn more in [examples](https://github.com/radekdostal/Nette-DateTimePicker/tree/master/examples).