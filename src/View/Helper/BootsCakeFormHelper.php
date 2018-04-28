<?php
/**
 * BoostCake
 *
 * Bootstrap helpers for CakePHP 3.x
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.md
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     Carlos Proaño <c@rlos.pro>
 * @copyright  2018 Carlos Proaño
 * @license    https://opensource.org/licenses/MIT MIT License
 * @link       https://github.com/KacosPro/bootscake
 * @since      File available since Release 0.0.4
 */
namespace BootsCake\View\Helper;

use Cake\View\Helper\FormHelper;

/**
 * BootsCake Form Helper library.
 *
 * Inherits from Cake's Form Helper to render Bootstrap Components as necessary.
 */
class BootsCakeFormHelper extends FormHelper
{

    /**
     * Default config for the helper.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'idPrefix' => null,
        'errorClass' => 'form-error',
        'typeMap' => [
            'string' => 'text',
            'text' => 'textarea',
            'uuid' => 'string',
            'datetime' => 'datetime',
            'timestamp' => 'datetime',
            'date' => 'date',
            'time' => 'time',
            'boolean' => 'checkbox',
            'float' => 'number',
            'integer' => 'number',
            'tinyinteger' => 'number',
            'smallinteger' => 'number',
            'decimal' => 'number',
            'binary' => 'file',
        ],
        'templates' => [
            // Used for button elements in button().
            'button' => '<button{{attrs}}>{{text}}</button>',
            // Used for checkboxes in checkbox() and multiCheckbox().
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            // Input group wrapper for checkboxes created via control().
            'checkboxFormGroup' => '{{label}}',
            // Wrapper container for checkboxes.
            'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
            // Widget ordering for date/time/datetime pickers.
            'dateWidget' => '{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}',
            // Error message wrapper elements.
            'error' => '<div class="error-message">{{content}}</div>',
            // Container for error items.
            'errorList' => '<ul>{{content}}</ul>',
            // Error item wrapper.
            'errorItem' => '<li>{{text}}</li>',
            // File input used by file().
            'file' => '<input type="file" name="{{name}}"{{attrs}}>',
            // Fieldset element used by allControls().
            'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            // Open tag used by create().
            'formStart' => '<form{{attrs}}>',
            // Close tag used by end().
            'formEnd' => '</form>',
            // General grouping container for control(). Defines input/label ordering.
            'formGroup' => '{{label}}{{input}}',
            // Wrapper content used to hide other content.
            'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
            // Generic input element.
            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
            // Submit input element.
            'inputSubmit' => '<input type="{{type}}"{{attrs}}/>',
            // Container element used by control().
            'inputContainer' => '<div class="input form-group {{type}}{{required}}">{{content}}</div>',
            // Container element used by control() when a field has an error.
            'inputContainerError' => '<div class="input {{type}}{{required}} error">{{content}}{{error}}</div>',
            // Label element when inputs are not nested inside the label.
            'label' => '<label{{attrs}}>{{text}}</label>',
            // Label element used for radio and multi-checkbox inputs.
            'nestingLabel' => '<div class="form-check{{inline}}">{{hidden}}{{input}}{{text}}</div>',
            // Legends created by allControls()
            'legend' => '<legend>{{text}}</legend>',
            // Multi-Checkbox input set title element.
            'multicheckboxTitle' => '<legend>{{text}}</legend>',
            // Multi-Checkbox wrapping container.
            'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            // Option element used in select pickers.
            'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
            // Option group element used in select pickers.
            'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
            // Select element,
            'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>',
            // Multi-select element,
            'selectMultiple' => '<select name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
            // Radio input element,
            'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
            // Wrapping container for radio input/label,
            'radioWrapper' => '{{label}}',
            // Textarea input element,
            'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
            // Container for submit buttons.
            'submitContainer' => '<div class="form-group">{{content}}</div>',
        ]
    ];

    /**
     * Returns an HTML form element.
     *
     * ### Options:
     *
     * - `type` Form method defaults to autodetecting based on the form context. If
     *   the form context's isCreate() method returns false, a PUT request will be done.
     * - `method` Set the form's method attribute explicitly.
     * - `action` The controller action the form submits to, (optional). Use this option if you
     *   don't need to change the controller from the current request's controller. Deprecated since 3.2, use `url`.
     * - `url` The URL the form submits to. Can be a string or a URL array. If you use 'url'
     *    you should leave 'action' undefined.
     * - `encoding` Set the accept-charset encoding for the form. Defaults to `Configure::read('App.encoding')`
     * - `enctype` Set the form encoding explicitly. By default `type => file` will set `enctype`
     *   to `multipart/form-data`.
     * - `templates` The templates you want to use for this form. Any templates will be merged on top of
     *   the already loaded templates. This option can either be a filename in /config that contains
     *   the templates you want to load, or an array of templates to use.
     * - `context` Additional options for the context class. For example the EntityContext accepts a 'table'
     *   option that allows you to set the specific Table class the form should be based on.
     * - `idPrefix` Prefix for generated ID attributes.
     * - `valueSources` The sources that values should be read from. See FormHelper::setValueSources()
     * - `templateVars` Provide template variables for the formStart template.
     *
     * @param mixed $context The context for which the form is being defined.
     *   Can be a ContextInterface instance, ORM entity, ORM resultset, or an
     *   array of meta data. You can use false or null to make a context-less form.
     * @param array $options An array of html attributes and options.
     * @return string An formatted opening FORM tag.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#Cake\View\Helper\FormHelper::create
     */
    public function create($context = null, array $options = [])
    {
        return parent::create($context, $options);
    }

    /**
     * Returns a formatted error message for given form field, '' if no errors.
     *
     * Uses the `error`, `errorList` and `errorItem` templates. The `errorList` and
     * `errorItem` templates are used to format multiple error messages per field.
     *
     * ### Options:
     *
     * - `escape` boolean - Whether or not to html escape the contents of the error.
     *
     * @param string $field A field name, like "modelname.fieldname"
     * @param string|array|null $text Error message as string or array of messages. If an array,
     *   it should be a hash of key names => messages.
     * @param array $options See above.
     * @return string Formatted errors or ''.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#displaying-and-checking-errors
     */
    public function error($field, $text = null, array $options = [])
    {
        return parent::error($field, $text, $options);
    }

    /**
     * Returns a formatted LABEL element for HTML forms.
     *
     * Will automatically generate a `for` attribute if one is not provided.
     *
     * ### Options
     *
     * - `for` - Set the for attribute, if its not defined the for attribute
     *   will be generated from the $fieldName parameter using
     *   FormHelper::_domId().
     *
     * Examples:
     *
     * The text and for attribute are generated off of the fieldname
     *
     * ```
     * echo $this->Form->label('published');
     * <label for="PostPublished">Published</label>
     * ```
     *
     * Custom text:
     *
     * ```
     * echo $this->Form->label('published', 'Publish');
     * <label for="published">Publish</label>
     * ```
     *
     * Custom attributes:
     *
     * ```
     * echo $this->Form->label('published', 'Publish', [
     *   'for' => 'post-publish'
     * ]);
     * <label for="post-publish">Publish</label>
     * ```
     *
     * Nesting an input tag:
     *
     * ```
     * echo $this->Form->label('published', 'Publish', [
     *   'for' => 'published',
     *   'input' => $this->text('published'),
     * ]);
     * <label for="post-publish">Publish <input type="text" name="published"></label>
     * ```
     *
     * If you want to nest inputs in the labels, you will need to modify the default templates.
     *
     * @param string $fieldName This should be "modelname.fieldname"
     * @param string|null $text Text that will appear in the label field. If
     *   $text is left undefined the text will be inflected from the
     *   fieldName.
     * @param array $options An array of HTML attributes.
     * @return string The formatted LABEL element
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-labels
     */
    public function label($fieldName, $text = null, array $options = [])
    {
        return parent::label($fieldName, $text, $options);
    }

    /**
     * Wrap a set of inputs in a fieldset
     *
     * @param string $fields the form inputs to wrap in a fieldset
     * @param array $options Options array. Valid keys are:
     * - `fieldset` Set to false to disable the fieldset. You can also pass an array of params to be
     *    applied as HTML attributes to the fieldset tag. If you pass an empty array, the fieldset will
     *    be enabled
     * - `legend` Set to false to disable the legend for the generated input set. Or supply a string
     *    to customize the legend text.
     * @return string Completed form inputs.
     */
    public function fieldset($fields = '', array $options = [])
    {
        return parent::fieldset($fields, $options);
    }

    /**
     * Generates a form control element complete with label and wrapper div.
     *
     * ### Options
     *
     * See each field type method for more information. Any options that are part of
     * $attributes or $options for the different **type** methods can be included in `$options` for input().
     * Additionally, any unknown keys that are not in the list below, or part of the selected type's options
     * will be treated as a regular HTML attribute for the generated input.
     *
     * - `type` - Force the type of widget you want. e.g. `type => 'select'`
     * - `label` - Either a string label, or an array of options for the label. See FormHelper::label().
     * - `options` - For widgets that take options e.g. radio, select.
     * - `error` - Control the error message that is produced. Set to `false` to disable any kind of error reporting (field
     *    error and error messages).
     * - `empty` - String or boolean to enable empty select box options.
     * - `nestedInput` - Used with checkbox and radio inputs. Set to false to render inputs outside of label
     *   elements. Can be set to true on any input to force the input inside the label. If you
     *   enable this option for radio buttons you will also need to modify the default `radioWrapper` template.
     * - `templates` - The templates you want to use for this input. Any templates will be merged on top of
     *   the already loaded templates. This option can either be a filename in /config that contains
     *   the templates you want to load, or an array of templates to use.
     * - `labelOptions` - Either `false` to disable label around nestedWidgets e.g. radio, multicheckbox or an array
     *   of attributes for the label tag. `selected` will be added to any classes e.g. `class => 'myclass'` where
     *   widget is checked
     *
     * @param string $fieldName This should be "modelname.fieldname"
     * @param array $options Each type of input takes different options.
     * @return string Completed form widget.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-form-inputs
     */
    public function control($fieldName, array $options = [])
    {
        $baseClass = 'form-control';
        $sizeClass = '';

        if (!empty($options['type']) && $options['type'] === 'submit') {
            $color = !empty($options['color']) ? $options['color'] : 'primary';
            $baseClass = sprintf('btn btn-%s', $color);
        }

        if (!empty($options['type']) && $options['type'] === 'file') {
            $baseClass = 'form-control-file';
        }

        if (!empty($options['type']) && in_array($options['type'], ['checkbox', 'radio'])) {
            $baseClass = 'form-check-input';
            $options['label']['class'] = 'form-check-label';
        }

        if (!empty($options['plaintext']) && $options['plaintext']) {
            $baseClass = 'form-control-plaintext';
        }

        if (!empty($options['size']) && in_array($options['size'], ['sm', 'lg'])) {
            $sizeClass = ' form-control-' . $options['size'];
            if (!empty($options['type']) && $options['type'] === 'submit') {
                $sizeClass = ' btn-' . $options['size'];
            }
        }

        $class = !empty($options['class']) ? ' ' . $options['class'] : '';
        $options['class'] = $baseClass . $sizeClass . $class;

        $inputType = $this->_inputType($fieldName, $options);

        if ($inputType !== 'select') {
            unset($options['size']);
        }

        return parent::control($fieldName, $options);
    }

    /**
     * Creates a checkbox input widget.
     *
     * ### Options:
     *
     * - `value` - the value of the checkbox
     * - `checked` - boolean indicate that this checkbox is checked.
     * - `hiddenField` - boolean to indicate if you want the results of checkbox() to include
     *    a hidden input with a value of ''.
     * - `disabled` - create a disabled input.
     * - `default` - Set the default value for the checkbox. This allows you to start checkboxes
     *    as checked, without having to check the POST data. A matching POST data value, will overwrite
     *    the default value.
     *
     * @param string $fieldName Name of a field, like this "modelname.fieldname"
     * @param array $options Array of HTML attributes.
     * @return string|array An HTML text input element.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-checkboxes
     */
    public function checkbox($fieldName, array $options = [])
    {
        return parent::checkbox($fieldName, $options);
    }

    /**
     * Creates a set of radio widgets.
     *
     * ### Attributes:
     *
     * - `value` - Indicates the value when this radio button is checked.
     * - `label` - Either `false` to disable label around the widget or an array of attributes for
     *    the label tag. `selected` will be added to any classes e.g. `'class' => 'myclass'` where widget
     *    is checked
     * - `hiddenField` - boolean to indicate if you want the results of radio() to include
     *    a hidden input with a value of ''. This is useful for creating radio sets that are non-continuous.
     * - `disabled` - Set to `true` or `disabled` to disable all the radio buttons. Use an array of
     *   values to disable specific radio buttons.
     * - `empty` - Set to `true` to create an input with the value '' as the first option. When `true`
     *   the radio label will be 'empty'. Set this option to a string to control the label value.
     *
     * @param string $fieldName Name of a field, like this "modelname.fieldname"
     * @param array|\Traversable $options Radio button options array.
     * @param array $attributes Array of attributes.
     * @return string Completed radio widget set.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-radio-buttons
     */
    public function radio($fieldName, $options = [], array $attributes = [])
    {
        return parent::radio($fieldName, $options, $attributes);
    }

    /**
     * Creates a textarea widget.
     *
     * ### Options:
     *
     * - `escape` - Whether or not the contents of the textarea should be escaped. Defaults to true.
     *
     * @param string $fieldName Name of a field, in the form "modelname.fieldname"
     * @param array $options Array of HTML attributes, and special options above.
     * @return string A generated HTML text input element
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-textareas
     */
    public function textarea($fieldName, array $options = [])
    {
        return parent::textarea($fieldName, $options);
    }

    /**
     * Creates a hidden input field.
     *
     * @param string $fieldName Name of a field, in the form of "modelname.fieldname"
     * @param array $options Array of HTML attributes.
     * @return string A generated hidden input
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-hidden-inputs
     */
    public function hidden($fieldName, array $options = [])
    {
        return parent::hidden($fieldName, $options);
    }

    /**
     * Creates file input widget.
     *
     * @param string $fieldName Name of a field, in the form "modelname.fieldname"
     * @param array $options Array of HTML attributes.
     * @return string A generated file input.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-file-inputs
     */
    public function file($fieldName, array $options = [])
    {
        return parent::file($fieldName, $options);
    }

    /**
     * Creates a `<button>` tag.
     *
     * The type attribute defaults to `type="submit"`
     * You can change it to a different value by using `$options['type']`.
     *
     * ### Options:
     *
     * - `escape` - HTML entity encode the $title of the button. Defaults to false.
     * - `confirm` - Confirm message to show. Form execution will only continue if confirmed then.
     *
     * @param string $title The button's caption. Not automatically HTML encoded
     * @param array $options Array of options and HTML attributes.
     * @return string A HTML button tag.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-button-elements
     */
    public function button($title, array $options = [])
    {
        return parent::button($title, $options);
    }

    /**
     * Create a `<button>` tag with a surrounding `<form>` that submits via POST as default.
     *
     * This method creates a `<form>` element. So do not use this method in an already opened form.
     * Instead use FormHelper::submit() or FormHelper::button() to create buttons inside opened forms.
     *
     * ### Options:
     *
     * - `data` - Array with key/value to pass in input hidden
     * - `method` - Request method to use. Set to 'delete' or others to simulate
     *   HTTP/1.1 DELETE (or others) request. Defaults to 'post'.
     * - `form` - Array with any option that FormHelper::create() can take
     * - Other options is the same of button method.
     * - `confirm` - Confirm message to show. Form execution will only continue if confirmed then.
     *
     * @param string $title The button's caption. Not automatically HTML encoded
     * @param string|array $url URL as string or array
     * @param array $options Array of options and HTML attributes.
     * @return string A HTML button tag.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-standalone-buttons-and-post-links
     */
    public function postButton($title, $url, array $options = [])
    {
        return parent::postButton($title, $url, $options);
    }

    /**
     * Creates an HTML link, but access the URL using the method you specify
     * (defaults to POST). Requires javascript to be enabled in browser.
     *
     * This method creates a `<form>` element. If you want to use this method inside of an
     * existing form, you must use the `block` option so that the new form is being set to
     * a view block that can be rendered outside of the main form.
     *
     * If all you are looking for is a button to submit your form, then you should use
     * `FormHelper::button()` or `FormHelper::submit()` instead.
     *
     * ### Options:
     *
     * - `data` - Array with key/value to pass in input hidden
     * - `method` - Request method to use. Set to 'delete' to simulate
     *   HTTP/1.1 DELETE request. Defaults to 'post'.
     * - `confirm` - Confirm message to show. Form execution will only continue if confirmed then.
     * - `block` - Set to true to append form to view block "postLink" or provide
     *   custom block name.
     * - Other options are the same of HtmlHelper::link() method.
     * - The option `onclick` will be replaced.
     *
     * @param string $title The content to be wrapped by <a> tags.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $options Array of HTML attributes.
     * @return string An `<a />` element.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-standalone-buttons-and-post-links
     */
    public function postLink($title, $url = null, array $options = [])
    {
        return parent::postLink($title, $url, $options);
    }

    /**
     * Creates a submit button element. This method will generate `<input />` elements that
     * can be used to submit, and reset forms by using $options. image submits can be created by supplying an
     * image path for $caption.
     *
     * ### Options
     *
     * - `type` - Set to 'reset' for reset inputs. Defaults to 'submit'
     * - `templateVars` - Additional template variables for the input element and its container.
     * - Other attributes will be assigned to the input element.
     *
     * @param string|null $caption The label appearing on the button OR if string contains :// or the
     *  extension .jpg, .jpe, .jpeg, .gif, .png use an image if the extension
     *  exists, AND the first character is /, image is relative to webroot,
     *  OR if the first character is not /, image is relative to webroot/img.
     * @param array $options Array of options. See above.
     * @return string A HTML submit button
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-buttons-and-submit-elements
     */
    public function submit($caption = null, array $options = [])
    {
        return parent::submit($caption, $options);
    }

    /**
     * Returns a formatted SELECT element.
     *
     * ### Attributes:
     *
     * - `multiple` - show a multiple select box. If set to 'checkbox' multiple checkboxes will be
     *   created instead.
     * - `empty` - If true, the empty select option is shown. If a string,
     *   that string is displayed as the empty element.
     * - `escape` - If true contents of options will be HTML entity encoded. Defaults to true.
     * - `val` The selected value of the input.
     * - `disabled` - Control the disabled attribute. When creating a select box, set to true to disable the
     *   select box. Set to an array to disable specific option elements.
     *
     * ### Using options
     *
     * A simple array will create normal options:
     *
     * ```
     * $options = [1 => 'one', 2 => 'two'];
     * $this->Form->select('Model.field', $options));
     * ```
     *
     * While a nested options array will create optgroups with options inside them.
     * ```
     * $options = [
     *  1 => 'bill',
     *     'fred' => [
     *         2 => 'fred',
     *         3 => 'fred jr.'
     *     ]
     * ];
     * $this->Form->select('Model.field', $options);
     * ```
     *
     * If you have multiple options that need to have the same value attribute, you can
     * use an array of arrays to express this:
     *
     * ```
     * $options = [
     *     ['text' => 'United states', 'value' => 'USA'],
     *     ['text' => 'USA', 'value' => 'USA'],
     * ];
     * ```
     *
     * @param string $fieldName Name attribute of the SELECT
     * @param array|\Traversable $options Array of the OPTION elements (as 'value'=>'Text' pairs) to be used in the
     *   SELECT element
     * @param array $attributes The HTML attributes of the select element.
     * @return string Formatted SELECT element
     * @see \Cake\View\Helper\FormHelper::multiCheckbox() for creating multiple checkboxes.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-select-pickers
     */
    public function select($fieldName, $options = [], array $attributes = [])
    {
        unset($attributes['size']);
        return parent::select($fieldName, $options, $attributes);
    }

    /**
     * Creates a set of checkboxes out of options.
     *
     * ### Options
     *
     * - `escape` - If true contents of options will be HTML entity encoded. Defaults to true.
     * - `val` The selected value of the input.
     * - `class` - When using multiple = checkbox the class name to apply to the divs. Defaults to 'checkbox'.
     * - `disabled` - Control the disabled attribute. When creating checkboxes, `true` will disable all checkboxes.
     *   You can also set disabled to a list of values you want to disable when creating checkboxes.
     * - `hiddenField` - Set to false to remove the hidden field that ensures a value
     *   is always submitted.
     * - `label` - Either `false` to disable label around the widget or an array of attributes for
     *   the label tag. `selected` will be added to any classes e.g. `'class' => 'myclass'` where
     *   widget is checked
     *
     * Can be used in place of a select box with the multiple attribute.
     *
     * @param string $fieldName Name attribute of the SELECT
     * @param array|\Traversable $options Array of the OPTION elements
     *   (as 'value'=>'Text' pairs) to be used in the checkboxes element.
     * @param array $attributes The HTML attributes of the select element.
     * @return string Formatted SELECT element
     * @see \Cake\View\Helper\FormHelper::select() for supported option formats.
     */
    public function multiCheckbox($fieldName, $options, array $attributes = [])
    {
        return parent::multiCheckbox($fieldName, $options, $attributes);
    }

    /**
     * Returns a set of SELECT elements for a full datetime setup: day, month and year, and then time.
     *
     * ### Date Options:
     *
     * - `empty` - If true, the empty select option is shown. If a string,
     *   that string is displayed as the empty element.
     * - `value` | `default` The default value to be used by the input. A value in `$this->data`
     *   matching the field name will override this value. If no default is provided `time()` will be used.
     * - `monthNames` If false, 2 digit numbers will be used instead of text.
     *   If an array, the given array will be used.
     * - `minYear` The lowest year to use in the year select
     * - `maxYear` The maximum year to use in the year select
     * - `orderYear` - Order of year values in select options.
     *   Possible values 'asc', 'desc'. Default 'desc'.
     *
     * ### Time options:
     *
     * - `empty` - If true, the empty select option is shown. If a string,
     * - `value` | `default` The default value to be used by the input. A value in `$this->data`
     *   matching the field name will override this value. If no default is provided `time()` will be used.
     * - `timeFormat` The time format to use, either 12 or 24.
     * - `interval` The interval for the minutes select. Defaults to 1
     * - `round` - Set to `up` or `down` if you want to force rounding in either direction. Defaults to null.
     * - `second` Set to true to enable seconds drop down.
     *
     * To control the order of inputs, and any elements/content between the inputs you
     * can override the `dateWidget` template. By default the `dateWidget` template is:
     *
     * `{{month}}{{day}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}`
     *
     * @param string $fieldName Prefix name for the SELECT element
     * @param array $options Array of Options
     * @return string Generated set of select boxes for the date and time formats chosen.
     * @link https://book.cakephp.org/3.0/en/views/helpers/form.html#creating-date-and-time-inputs
     */
    public function dateTime($fieldName, array $options = [])
    {
        return parent::dateTime($fieldName, $options);
    }

    /**
     * Generate time inputs.
     *
     * ### Options:
     *
     * See dateTime() for time options.
     *
     * @param string $fieldName Prefix name for the SELECT element
     * @param array $options Array of Options
     * @return string Generated set of select boxes for time formats chosen.
     * @see \Cake\View\Helper\FormHelper::dateTime() for templating options.
     */
    public function time($fieldName, array $options = [])
    {
        return parent::time($fieldName, $options);
    }

    /**
     * Generate date inputs.
     *
     * ### Options:
     *
     * See dateTime() for date options.
     *
     * @param string $fieldName Prefix name for the SELECT element
     * @param array $options Array of Options
     * @return string Generated set of select boxes for time formats chosen.
     * @see \Cake\View\Helper\FormHelper::dateTime() for templating options.
     */
    public function date($fieldName, array $options = [])
    {
        return parent::date($fieldName, $options);
    }
}
