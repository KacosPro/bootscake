# BootsCake

[![Build Status](https://travis-ci.org/KacosPro/bootscake.svg?branch=master)](https://travis-ci.org/KacosPro/bootscake)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

[Bootstrap 4][twbs4] plugin for [CakePHP 3.4][cakephp].

## Requirements

* CakePHP 3.4.x
* Bootstrap 4.0.0-alpha.6
* jQuery 1.9+
* Tether 1.4

## Description

More of a plugin is an adapter for current CakePHP's helpers. It's an absolutely WIP

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
\Cake\Core\Plugin::load('BootsCake');
```

or using CakePHP's console:

```
./bin/cake plugin load BootsCake
```

## Usage

First of all you should load Bootstrap by your favorite method. Then you will need to modify your `src/View/AppView`.

### AppView Setup


Your `src\View\AppView.php` will look something like the following:

```php
namespace App\View;

use Cake\View\View;
use BootsCake\View\Helper;

class AppView extends View
{
    public function initialize()
    {
        $this->loadHelper('BootsCakeForm', ['className' => 'BootsCake.BootsCakeForm']);
        $this->loadHelper('BootsCakePaginator', ['className' => 'BootsCake.BootsCakePaginator']);
        $this->loadHelper('BootsCakeFlash', ['className' => 'BootsCake.BootsCakeFlash']);
        $this->loadHelper('BootsCakeModal', ['className' => 'BootsCake.BootsCakeModal']);
    }
}
```

## Helper Usage

Form Helper. You only need to call BootsCakeForm on the View
```php
<?php
echo $this->BootsCakeForm->create($article);
echo $this->BootsCakeForm->control('title');
echo $this->BootsCakeForm->control('body');
echo $this->BootsCakeForm->button(__('Submit'));
echo $this->BootsCakeForm->end();
?>
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
- [ ] Add options for modal rendering.
- [ ] Create Html Helpers.
- [ ] Create a way to automatize Bootstrap instalation.

## License

Copyright (c) 2017, Carlos Proaño and licensed under [The MIT License][mit].

[cakephp]:https://cakephp.org
[composer]:http://getcomposer.org
[mit]:http://www.opensource.org/licenses/mit-license.php
[twbs4]:https://v4-alpha.getbootstrap.com/
