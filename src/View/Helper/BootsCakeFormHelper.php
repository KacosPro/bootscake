<?php
namespace BootsCake\View\Helper;

use Cake\View\Helper\FormHelper;

/**
 * BootsCake Form Helper library.
 *
 * Inherits from Cake's Form Helper to render Bootstrap Components as necessary.
 */
class BootsCakeFormHelper extends FormHelper
{
    protected $_defaultConfig = [
        'idPrefix' => null,
        'errorClass' => 'form-error',
        'typeMap' => [
            'string' => 'text', 'datetime' => 'datetime', 'boolean' => 'checkbox',
            'timestamp' => 'datetime', 'text' => 'textarea', 'time' => 'time',
            'date' => 'date', 'float' => 'number', 'integer' => 'number',
            'decimal' => 'number', 'binary' => 'file', 'uuid' => 'string'
        ],
        'templates' => [
            'button' => '<button{{attrs}}>{{text}}</button>',
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            'checkboxFormGroup' => '{{label}}',
            'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
            'dateWidget' => '{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}',
            'error' => '<span class="form-control-feedback">{{content}}</span>',
            'errorList' => '<ul>{{content}}</ul>',
            'errorItem' => '<li>{{text}}</li>',
            'file' => '<input type="file" name="{{name}}"{{attrs}}>',
            'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            'formStart' => '<form{{attrs}}>',
            'formEnd' => '</form>',
            'formGroup' => '{{label}}{{input}}',
            'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
            'inputSubmit' => '<input type="{{type}}"{{attrs}}/>',
            'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
            'inputContainerError' => '<div class="input {{type}}{{required}} form-group has-danger">{{content}}{{error}}</div>',
            'label' => '<label class="form-control-label" {{attrs}}>{{text}}</label>',
            'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>',
            'legend' => '<legend>{{text}}</legend>',
            'multicheckboxTitle' => '<legend>{{text}}</legend>',
            'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
            'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
            'select' => '<select class="form-control" name="{{name}}"{{attrs}} class="form-control">{{content}}</select>',
            'selectMultiple' => '<select name="{{name}}[]" multiple="multiple"{{attrs}} class="form-control">{{content}}</select>',
            'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
            'radioWrapper' => '{{label}}',
            'textarea' => '<textarea name="{{name}}"{{attrs}} class="form-control">{{value}}</textarea>',
            'submitContainer' => '<div class="submit">{{content}}</div>',
        ]
    ];

    /**
     * Creates a `<button>` tag.
     *
     *
     * @param string $title The button's caption. Not automatically HTML encoded
     * @param array $options Array of options and HTML attributes.
     * @return string A HTML button tag.
     */
    public function button($title, array $options = [])
    {
        $options += ['type' => 'submit', 'class' => 'btn btn-primary', 'escape' => false, 'secure' => false];
        $options['text'] = $title;

        return $this->widget('button', $options);
    }

    /**
     * Creates an HTML link, but access the URL using the method you specify
     * (defaults to POST). Requires javascript to be enabled in browser.
     *
     * This method creates a `<form>` element. If you want to use this method inside of an
     * existing form, you must use the `block` option so that the new form is being set to
     * a view block that can be rendered outside of the main form.
     *
     * I adapted this method so it renders a Modal Component from Bootstrap, instead a alert
     * it's primary used to render a delete button
     *
     * @param string $title The content to be wrapped by <a> tags.
     * @param string|array|null $url Cake-relative URL or array of URL parameters, or
     *   external URL (starts with http://)
     * @param array $options Array of HTML attributes.
     * @return string An `<a />` element.
     */
    public function postLink($title, $url = null, array $options = [])
    {
        $options += ['block' => null, 'confirm' => null];

        $requestMethod = 'POST';
        if (!empty($options['method'])) {
            $requestMethod = strtoupper($options['method']);
            unset($options['method']);
        }

        $formName = str_replace('.', '', uniqid('post_', true));
        $formOptions = [
            'name' => $formName,
            'style' => 'display:none;',
            'method' => 'post',
        ];
        if (isset($options['target'])) {
            $formOptions['target'] = $options['target'];
            unset($options['target']);
        }
        $templater = $this->templater();

        $restoreAction = $this->_lastAction;
        $this->_lastAction($url);

        $action = $templater->formatAttributes([
            'action' => $this->Url->build($url),
            'escape' => false
        ]);

        $out = $this->formatTemplate('formStart', [
            'attrs' => $templater->formatAttributes($formOptions) . $action
        ]);
        $out .= $this->hidden('_method', [
            'value' => $requestMethod,
            'secure' => static::SECURE_SKIP
        ]);
        $out .= $this->_csrfField();

        $fields = [];
        if (isset($options['data']) && is_array($options['data'])) {
            foreach (Hash::flatten($options['data']) as $key => $value) {
                $fields[$key] = $value;
                $out .= $this->hidden($key, ['value' => $value, 'secure' => static::SECURE_SKIP]);
            }
            unset($options['data']);
        }
        $out .= $this->secure($fields);
        $out .= $this->formatTemplate('formEnd', []);
        $this->_lastAction = $restoreAction;

        if ($options['block']) {
            if ($options['block'] === true) {
                $options['block'] = __FUNCTION__;
            }
            $this->_View->append($options['block'], $out);
            $out = '';
        }
        unset($options['block']);

        $options['data-toggle'] = 'modal';
        $options['data-target'] = '#modal';
        $options['data-form-name'] = $formName;

        if (!isset($options['data-name'])) {
            $options['data-name'] = '';
        }

        $url = '/#';

        $out .= $this->Html->link($title, $url, $options);

        return $out;
    }

    /**
     * Generates a form control element complete with label and wrapper div.
     * It´s based on Cake's FormHelper control
     *
     * @param string $fieldName This should be "modelname.fieldname"
     * @param array $options Each type of input takes different options.
     * @return string Completed form widget.
     */
    public function control($fieldName, array $options = [])
    {
        $options += [
            'type' => null,
            'label' => null,
            'error' => null,
            'required' => null,
            'options' => null,
            'templates' => ['input' => '<input type="{{type}}" class="form-control" name="{{name}}"{{attrs}}/>'],
            'templateVars' => [],
            'labelOptions' => true
        ];
        $options = $this->_parseOptions($fieldName, $options);
        $options += ['id' => $this->_domId($fieldName)];

        $templater = $this->templater();
        $newTemplates = $options['templates'];

        if ($newTemplates) {
            $templater->push();
            $templateMethod = is_string($options['templates']) ? 'load' : 'add';
            $templater->{$templateMethod}($options['templates']);
        }
        unset($options['templates']);

        $error = null;
        $errorSuffix = '';
        if ($options['type'] !== 'hidden' && $options['error'] !== false) {
            if (is_array($options['error'])) {
                $error = $this->error($fieldName, $options['error'], $options['error']);
            } else {
                $error = $this->error($fieldName, $options['error']);
            }
            $errorSuffix = empty($error) ? '' : 'Error';
            unset($options['error']);
        }

        $label = $options['label'];
        unset($options['label']);

        $nestedInput = false;
        if ($options['type'] === 'checkbox') {
            $nestedInput = true;
        }
        $nestedInput = isset($options['nestedInput']) ? $options['nestedInput'] : $nestedInput;

        if ($nestedInput === true && $options['type'] === 'checkbox' && !array_key_exists('hiddenField', $options) && $label !== false) {
            $options['hiddenField'] = '_split';
        }

        $input = $this->_getInput($fieldName, $options);
        if ($options['type'] === 'hidden' || $options['type'] === 'submit') {
            if ($newTemplates) {
                $templater->pop();
            }

            return $input;
        }

        $label = $this->_getLabel($fieldName, compact('input', 'label', 'error', 'nestedInput') + $options);
        $result = $this->_groupTemplate(compact('input', 'label', 'error', 'options'));
        $result = $this->_inputContainerTemplate([
            'content' => $result,
            'error' => $error,
            'errorSuffix' => $errorSuffix,
            'options' => $options
        ]);

        if ($newTemplates) {
            $templater->pop();
        }

        return $result;
    }
}
