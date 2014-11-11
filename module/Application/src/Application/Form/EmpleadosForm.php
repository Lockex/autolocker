<?php 
namespace Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class EmpleadosForm extends Form
{

    public $om;

    public function __construct(ObjectManager $objectManager)
    {
        $this->om = $objectManager;
        parent::__construct('empleados');

        // The form will hydrate an object of type "BlogPost"
        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
         
            $this->add(array(
                 'name' => 'env',
                 'attributes' => array(
                     'type' => 'submit',
                     'value' => 'Guardar',
                     'class' => 'btn btn-primary',
                 ),
             ));
            $this->add(array(
                 'name' => 'res',
                 'attributes' => array(
                     'type' => 'reset',
                     'value' => 'Reset',
                     'class' => 'btn btn-default',
                 ),
             ));
            $this->add(array(
                'type' => 'Zend\Form\Element\Hidden',
                'name' => 'ID',
                'attributes' => array(
                    'id' => 'id_empleado',
                ),
            ));
      
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'NOMBRE',
                'options' => array(
                    'label' => 'Nombre:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cNombre',
                ),
            ));
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'APELLIDO_PATERNO',
                'options' => array(
                    'label' => 'Apellido Paterno:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cApellido1',
                ),
            ));
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'APELLIDO_MATERNO',
                'options' => array(
                    'label' => 'Apellido Materno:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cApellido2',
                ),
            ));
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'NUMERO',
                'options' => array(
                    'label' => 'Numero de empleado:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cNumero',
                ),
            ));
           
            $this->add(array(
                'type' => 'Zend\Form\Element\Checkbox',
                'name' => 'LUNES',
                'options' => array(
                     'label' => 'Lunes: ',
                     'use_hidden_element' => false,
                ),
                'attributes' => array(
                    'id' => 'LUNES',
                    'class' => 'check',
                ),
            ));
            $this->add(array(
                'required' => false,
                'type' => 'Zend\Form\Element\Checkbox',
                'name' => 'MARTES',
                'options' => array(
                     'label' => 'Martes: ',
                     'use_hidden_element' => false,
                ),
                'attributes' => array(
                    'id' => 'MARTES',
                    'class' => 'check',
                ),
            ));
            $this->add(array(
                'type' => 'Zend\Form\Element\Checkbox',
                'name' => 'MIERCOLES',
                'options' => array(
                     'label' => 'Miércoles: ',
                     'use_hidden_element' => false,
                ),
                'attributes' => array(
                    'id' => 'MIERCOLES',
                    'class' => 'check',
                ),
            ));
            $this->add(array(
                'type' => 'Zend\Form\Element\Checkbox',
                'name' => 'JUEVES',
                'options' => array(
                     'label' => 'Jueves: ',
                     'use_hidden_element' => false,
                ),
                'attributes' => array(
                    'id' => 'JUEVES',
                    'class' => 'check',
                ),
            ));
            $this->add(array(
                'type' => 'Zend\Form\Element\Checkbox',
                'name' => 'VIERNES',
                'options' => array(
                     'label' => 'Viernes: ',
                     'use_hidden_element' => false,
                ),
                'attributes' => array(
                    'id' => 'VIERNES',
                    'class' => 'check',
                ),
            ));
            $this->add(array(
                'type' => 'Zend\Form\Element\Checkbox',
                'name' => 'SABADO',
                'options' => array(
                     'label' => 'Sábado: ',
                     'use_hidden_element' => false,
                ),
                'attributes' => array(
                    'id' => 'SABADO',
                    'class' => 'check',
                ),
            ));
            $this->add(array(
                'type' => 'Zend\Form\Element\Checkbox',
                'name' => 'DOMINGO',
                'options' => array(
                     'label' => 'Domingo: ',
                     'use_hidden_element' => false,
                ),
                'attributes' => array(
                    'id' => 'DOMINGO',
                    'class' => 'check',
                ),
            ));
            
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'I_LUNES',
                 'options'=> array(
                         'label' => 'Entrada:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'I_LUNES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'F_LUNES',
                 'options'=> array(
                         'label' => 'Salida:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'F_LUNES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'I_MARTES',
                 'options'=> array(
                         'label' => 'Entrada:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'I_MARTES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'F_MARTES',
                 'options'=> array(
                         'label' => 'Salida:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'F_MARTES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'I_MIERCOLES',
                 'options'=> array(
                         'label' => 'Entrada:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'I_MIERCOLES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'F_MIERCOLES',
                 'options'=> array(
                         'label' => 'Salida:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'F_MIERCOLES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'I_JUEVES',
                 'options'=> array(
                         'label' => 'Entrada:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'I_JUEVES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'F_JUEVES',
                 'options'=> array(
                         'label' => 'Salida:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'F_JUEVES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'I_VIERNES',
                 'options'=> array(
                         'label' => 'Entrada:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'I_VIERNES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'F_VIERNES',
                 'options'=> array(
                         'label' => 'Salida:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'F_VIERNES', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'I_SABADO',
                 'options'=> array(
                         'label' => 'Entrada:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'I_SABADO', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'F_SABADO',
                 'options'=> array(
                         'label' => 'Salida:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'F_SABADO', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'I_DOMINGO',
                 'options'=> array(
                         'label' => 'Entrada:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'I_DOMINGO', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->add(array(
                 'type' => 'Zend\Form\Element\Time',
                 'name' => 'F_DOMINGO',
                 'options'=> array(
                         'label' => 'Salida:'
                 ),
                 'attributes' => array(
                         'min' => '00:00:00',
                         'max' => '23:59:59',
                         'step' => '60', 'class' => 'form-control',
                         'id' => 'F_DOMINGO', // seconds; default step interval is 60 seconds
                 )
             ));
            $this->agregarFiltro();
        // … add CSRF and submit elements …

        // Optionally set your validation group here
    }

    private function agregarFiltro() {
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'LUNES',
            'required' => false,
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'I_LUNES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'F_LUNES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'MARTES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'I_MARTES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'F_MARTES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'MIERCOLES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'I_MIERCOLES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'F_MIERCOLES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'JUEVES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'I_JUEVES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'F_JUEVES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'VIERNES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'I_VIERNES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'F_VIERNES',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'SABADO',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'I_SABADO',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'F_SABADO',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'DOMINGO',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'I_DOMINGO',
            'required' => false,
            
        )));
        $this->getInputFilter()->add($this->getInputFilter()->getFactory()->createInput(array(
            'name'     => 'F_DOMINGO',
            'required' => false,
            
        )));
    }
    
}
 ?>