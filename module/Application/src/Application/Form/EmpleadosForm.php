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
           
            
            
        // … add CSRF and submit elements …

        // Optionally set your validation group here
    }
    
}
 ?>