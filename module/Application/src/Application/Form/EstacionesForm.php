<?php 
namespace Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class EstacionesForm extends Form
{

    public $om;
    public $id;

    public function __construct(ObjectManager $objectManager,$id)
    {
        $this->om = $objectManager;
        $this->id = 1;
        parent::__construct('estaciones');

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
                    'id' => 'id_consulta',
                ),
            ));
      
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'NOMBRE',
                'options' => array(
                    'label' => 'Nombre de la estación:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cNombreEstacion',
                ),
            ));
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'LATITUD',
                'options' => array(
                    'label' => 'Latitud central:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cLatitud',
                ),
            ));
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'LONGITUD',
                'options' => array(
                    'label' => 'Longitud central:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cLongitud',
                ),
            ));
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'LATITUD2',
                'options' => array(
                    'label' => 'Latitud perimétrica:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cLatitud',
                ),
            ));
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'LONGITUD2',
                'options' => array(
                    'label' => 'Longitud perimétrica:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cLongitud2',
                ),
            ));
            $this->add(array(
                'type'    => 'Zend\Form\Element\Text',
                'name'    => 'LONGITUD2',
                'options' => array(
                    'label' => 'Longitud perimétrica:',
                ),
                'attributes' => array(
                    'class' => 'Input form-control',
                    'id' => 'cLongitud2',
                ),
            ));

            $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'USUARIOS',
             'options' => array(
                     'label' => '',
                     'disable_inarray_validator' => true,
                     'value_options' => $this->getEmpleados(),
             ),
             'attributes' => array(
                'multiple' => true,
                'id' => 'sUsuarios',
                'style' => 'margin-top:10px',
            ),
        ));
            
        // … add CSRF and submit elements …

        // Optionally set your validation group here
    }
    public function getEmpleados() {
        $query = $this->om->createQuery("SELECT e.ID,e.NOMBRE,e.APELLIDO_PATERNO,e.APELLIDO_MATERNO FROM CsnUser\Entity\Empleados e 
            JOIN CsnUser\Entity\Usuariosempleados u WHERE e.ID = u.EMPLEADO AND u.USUARIO = ".$this->id);
        $empleados = $query->getArrayResult();
        foreach($empleados as $emp){
            $opt[$emp['ID']] = $emp['NOMBRE'].' '.$emp['APELLIDO_PATERNO'].' '.$emp['APELLIDO_MATERNO'];
        }
        return $opt;
    }
}
 ?>