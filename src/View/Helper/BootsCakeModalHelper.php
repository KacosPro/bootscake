<?php
namespace BootsCake\View\Helper;

use Cake\View\Helper;
use UnexpectedValueException;

/**
 * FlashHelper class to render flash messages.
 *
 * After setting messages in your controllers with FlashComponent, you can use
 * this class to output your flash messages in your views.
 */
class BootsCakeModalHelper extends Helper
{

    /**
     * Used to render a Modal Component
     *
     *
     * @param array $options Additional options to use for the creation of this flash message.
     *    Supports the 'params', and 'element' keys that are used in the helper.
     * @return string|null Rendered Modal
     */
    public function render(array $options = [])
    {
        $out = '';
        $out .= $this->_View->element('BootsCake.Modal/default');

        return $out;
    }
}
