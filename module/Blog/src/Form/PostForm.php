<?php

namespace Blog\Form;


use Zend\Filter\StringTrim;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\NotEmpty;

class PostForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'POST');

        $this->add([
            'name' => 'title',
            'options' => [
                'label' => 'Tytuł:'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Tutaj wpisz tytuł posta..'
            ],
            'type' => Text::class
        ]);

        $this->add([
            'name' => 'description',
            'options' => [
                'label' => 'Opis:'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Tutaj wpisz opis posta..'
            ],
            'type' => Textarea::class
        ]);

        $this->add([
            'name' => 'content',
            'options' => [
                'label' => 'Treść posta:'
            ],
            'attributes' => [
                'class' => 'form-control post-content',
                'placeholder' => 'Tutaj wpisz treść posta..'
            ],
            'type' => Textarea::class
        ]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'value' => 'Dodaj post',
                'class' => 'btn btn-default btn-block'
            ],
            'type' => Submit::class
        ]);

        $this->add([
            'name' => 'active',
            'options' => [
                'label' => 'Czy post aktywny:',
                'value_options' => [
                    '1' => 'Tak',
                    '0' => 'Nie',
                ],
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
            'type' => Select::class
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class]
                ],
                'validators' => [
                    ['name' => NotEmpty::class]
                ]
            ],
            'description' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class]
                ],
                'validators' => [
                    ['name' => NotEmpty::class]
                ]
            ],
            'content' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class]
                ],
                'validators' => [
                    ['name' => NotEmpty::class]
                ]
            ],
            'active' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class]
                ],
                'validators' => [
                    ['name' => NotEmpty::class]
                ]
            ]
        ];
    }
}