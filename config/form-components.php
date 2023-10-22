<?php

use ProtoneMedia\LaravelFormComponents\Components;
use App\View\Components\FormComponents;

return [
    'prefix' => '',

    /** tailwind | tailwind-2 | tailwind-forms-simple | bootstrap-4 | bootstrap-5 */
#    'framework' => 'tailwind',
    'framework' => 'bootstrap-5',

    'use_eloquent_date_casting' => true,

    /** bool | string */
    'default_wire' => false,

    'components' => [
        'form' => [
            'view'  => 'form-components::{framework}.form',
            'class' => Components\Form::class,
        ],

        'form-checkbox' => [
            'view'  => 'form-components::{framework}.form-checkbox',
            'class' => Components\FormCheckbox::class,
        ],

        'form-icon-checkbox' => [
            'view'  => 'form-components::{framework}.form-icon-checkbox',
            'class' => FormComponents\FormIconCheckbox::class,
        ],
        'form-icon-radio' => [
            'view'  => 'form-components::{framework}.form-icon-radio',
            'class' => FormComponents\FormIconRadio::class,
        ],

        'form-errors' => [
            'view'  => 'form-components::{framework}.form-errors',
            'class' => Components\FormErrors::class,
        ],

        'form-group' => [
            'view'  => 'form-components::{framework}.form-group',
            'class' => Components\FormGroup::class,
        ],

        'form-input' => [
            'view'  => 'form-components::{framework}.form-input',
            'class' => Components\FormInput::class,
        ],

        'form-input-group' => [
            'view'  => 'form-components::{framework}.form-input-group',
            'class' => Components\FormInputGroup::class,
        ],

        'form-input-group-text' => [
            'view'  => 'form-components::{framework}.form-input-group-text',
            'class' => Components\FormInputGroupText::class,
        ],

        'form-label' => [
            'view'  => 'form-components::{framework}.form-label',
            'class' => Components\FormLabel::class,
        ],

        'form-radio' => [
            'view'  => 'form-components::{framework}.form-radio',
            'class' => Components\FormRadio::class,
        ],

        'form-range' => [
            'view'  => 'form-components::{framework}.form-range',
            'class' => Components\FormRange::class,
        ],

        'form-select' => [
            'view'  => 'form-components::{framework}.form-select',
            'class' => Components\FormSelect::class,
        ],

        'form-submit' => [
            'view'  => 'form-components::{framework}.form-submit',
            'class' => Components\FormSubmit::class,
        ],

        'form-textarea' => [
            'view'  => 'form-components::{framework}.form-textarea',
            'class' => Components\FormTextarea::class,
        ],

        'form-location' => [
            'view'  => 'form-components::{framework}.form-location',
            'class' => FormComponents\FormLocation::class,
        ],

        'form-map' => [
            'view'  => 'form-components::{framework}.form-map',
            'class' => FormComponents\FormMap::class,
        ],
    ],
];
