<?php


namespace Blog\Form;


use Zend\Filter\StringTrim;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\NotEmpty;

class LoginForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'POST');

        $this->add([
            'name' => 'login',
            'options' => [
                'label' => 'Login:'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Tutaj wpisz swój login..'
            ],
            'type' => Text::class
        ]);

        $this->add([
            'name' => 'password',
            'options' => [
                'label' => 'Hasło:'
            ],
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => 'Tutaj wpisz swoje hasło..'
            ],
            'type' => Password::class
        ]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'value' => 'Zaloguj',
                'class' => 'btn btn-default btn-block'
            ],
            'type' => Submit::class
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'login' => [
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class]
                ],
                'validators' => [
                    ['name' => NotEmpty::class]
                ]
            ],
            'password' => [
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