# DateTimePicker for Nette Framework

DatePicker and DateTimePicker input controls for Nette Framework

- Author: Radek Dostál &lt;radek.dostal@gmail.com&gt;
- Copyright: Copyright (c) 2010 - 2019 [Radek Dostál](https://www.radekdostal.cz)
- Licence: [GNU Lesser General Public License](https://www.gnu.org/licenses/)
- Github: [radekdostal/Nette-DateTimePicker](https://github.com/radekdostal/Nette-DateTimePicker)

This add-on creates input box to select date or date and time.

## Requirements

- **[PHP](https://php.net)** 7.1 or later
- **[Nette Dependency Injection Container](https://github.com/nette/di)** 3.0 or later
- **[Nette Forms](https://github.com/nette/forms)** 3.0 or later
- **[Nette Utilities](https://github.com/nette/utils)** 3.0 or later

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

Form:

```php
$form->addTbDatePicker('date', 'Date')
  ->setNullable()
  ->setRequired(FALSE)
  ->addRule(self::RANGE, NULL, [new \DateTime('2016-09-01'), new \DateTime('2016-09-15')]);
```

Learn more in [examples](https://github.com/radekdostal/Nette-DateTimePicker/tree/master/examples).