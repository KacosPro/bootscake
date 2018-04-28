# BootsCake

[![Build Status](https://travis-ci.org/KacosPro/bootscake.svg?branch=master)](https://travis-ci.org/KacosPro/bootscake)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

[Bootstrap 4][twbs4] plugin for [CakePHP ^3.4][cakephp].

## Requirements

* CakePHP ^3.4.0
* Bootstrap ^4.0.0
* jQuery 1.9.1 - 3,
* Popper.js ^1.14.0

## Description

Adapter of current CakePHP's helpers. While I feel it is getting pretty close to a stable version :smile: it is possible that breaking changes ocurre

## Includes

* FormHelper
* PaginatorHelper
* ModalHelper
* FlashHelper

## Installing Using [Composer][composer]

```
composer require kacospro/bootscake
```

Load the plugin by adding the following to your app's `config/boostrap.php`:

```php
Plugin::load('BootsCake');
```

or using CakePHP's console:

```
bin/cake plugin load BootsCake
```

## Setup

First of all you should load Bootstrap by your favorite method.

Then in your `src/View/AppView.php` load the helpers you need:

```php
public function initialize()
{
    $this->loadHelper('BootsCake.BootsCakeFlash');
    $this->loadHelper('BootsCake.BootsCakeForm');
    $this->loadHelper('BootsCake.BootsCakeModal');
    $this->loadHelper('BootsCake.BootsCakePaginator');
}
```

## Helper Usage

Form Helper. You only need to call BootsCakeForm on the View
```php
<?php
echo $this->BootsCakeForm->create($article);
echo $this->BootsCakeForm->control('title');
echo $this->BootsCakeForm->control('body');
echo $this->BootsCakeForm->control(__('Submit'), ['type' => 'submit']);
echo $this->BootsCakeForm->end();
?>
```
**Wait**! What if I need different form sizes?
<br>
I got your back! You can pass size as an option it could be `sm` or `lg`:

```php
<?= $this->BootsCakeForm->control(
    'email',
    [
        'placeholder' => 'carlos@example.com',
        'size' => 'sm',
    ]
) ?>
```

Also if you pass the option `'type' => 'submit'` it supports a [color][twbs-colors] to render the submit button

```php
<?= $this->BootsCakeForm->control('Submit', ['type' => 'submit', 'color' => 'primary']) ?>

```
Flash Helper.
```php
<?= $this->BootsCakeFlash->render() ?>
```
Paginator Helper.
```php
<nav>
    <ul class="pagination">
        <?php
        echo $this->BootsCakePaginator->first();
        echo $this->BootsCakePaginator->prev();
        echo $this->BootsCakePaginator->numbers();
        echo $this->BootsCakePaginator->next();
        echo $this->BootsCakePaginator->last();
        ?>
    </ul>
</nav>
```
Modal. It only renders the skeleton of the Modal Component, I use it primary for rendering a delete modal
This is the delete button code:
```php
<?=
$this->BootsCakeForm->postLink(__('Delete'),
[
  'action' => 'delete',
  $article->id
], [
  'data-name' => $article->id,
  'escape' => false,
  'title' => 'Eliminar usuario'
])
?>
```
Then call the Modal skeleton:
```php
<?= $this->element('BootsCake.modal/default') ?>

```
or
```php
<?= $this->BootsCakeModal->render() ?>

```
Alongside this javascript code:
```javascript
$('#modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('name');
    var formName = button.data('form-name');
    $('#confirm').attr('onClick', 'document.' + formName + '.submit();');
    var modal = $(this);
    modal.find('.modal-title').html(
        '<p class="text-danger">Eliminar <i class="fa fa-exclamation-circle" aria-hidden="true"></i></p>'
    )
    modal.find('.modal-body').html(
        '<p>¿Desea eliminar a ' +
        recipient +
        '?</p>' +
        '<br>' +
        'La información no se podrá recuperar'
    );
});

```

## TODO
- [ ] Improve Docs.
- [ ] Handle configurations.
- [x] Add options for size (sm, md, lg).
- [ ] Add options for modal rendering.
- [ ] Create Html Helpers.
- [ ] Create a way to automatize Bootstrap instalation.

## License

Copyright (c) 2018, Carlos Proaño and licensed under [The MIT License][mit].

[cakephp]: https://cakephp.org
[composer]: http://getcomposer.org
[mit]: http://www.opensource.org/licenses/mit-license.php
[twbs4]: https://getbootstrap.com/
[twbs-colors]: https://getbootstrap.com/docs/4.0/utilities/colors/
