<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

use Zend\Form\FormInterface;

use Application\Form\EmpleadosForm;

use CsnUser\Entity\Empleados;
use CsnUser\Entity\Usuariosempleados;


class EmpleadosController extends AbstractActionController
{

	/**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function empleadosAction()
    {
        return new ViewModel();
    }

    public function listaempleadosAction() 
    {
    	$this->layout('layout/vacio');
    	$query = $this->getObjectManager()->createQuery("SELECT em FROM 
            CsnUser\Entity\Empleados em WHERE em.JEFE =".$this->identity()->getId());
    	$empleados = $query->getArrayResult();
      $objEmpleados = json_encode($empleados);
    	$resultado = array('empleados' => $empleados, 'objEmpleados' => $objEmpleados);
    	return new ViewModel($resultado);
    }

    public function nuevoempleadoAction() {
        $em = $this->getObjectManager();
        $this->layout('layout/vacio');
        $form = new EmpleadosForm($em);
        $id = $this->params()->fromRoute('id');
        $resultado = array('form' => $form,'id'=>$id);
        if($id) {
          $queryEmpleado = $em->createQuery("SELECT e FROM CsnUser\Entity\Empleados e WHERE e.ID = $id");
          $empleadoresult = $queryEmpleado->getArrayResult();
          $form->get('NOMBRE')->setAttribute('value',$empleadoresult[0]['NOMBRE']);
          $form->get('APELLIDO_PATERNO')->setAttribute('value',$empleadoresult[0]['APELLIDO_PATERNO']);
          $form->get('APELLIDO_MATERNO')->setAttribute('value',$empleadoresult[0]['APELLIDO_MATERNO']);
          $form->get('NUMERO')->setAttribute('value',$empleadoresult[0]['NUMERO']);
          if($empleadoresult[0]['LUNES'] == 1) $form->get('LUNES')->setAttribute('checked',true);
          if($empleadoresult[0]['MARTES'] == 1) $form->get('MARTES')->setAttribute('checked',true);
          if($empleadoresult[0]['MIERCOLES'] == 1) $form->get('MIERCOLES')->setAttribute('checked',true);
          if($empleadoresult[0]['JUEVES'] == 1) $form->get('JUEVES')->setAttribute('checked',true);
          if($empleadoresult[0]['VIERNES'] == 1) $form->get('VIERNES')->setAttribute('checked',true);
          if($empleadoresult[0]['SABADO'] == 1) $form->get('SABADO')->setAttribute('checked',true);
          if($empleadoresult[0]['DOMINGO'] == 1) $form->get('DOMINGO')->setAttribute('checked',true);
          $form->get('I_LUNES')->setAttribute('value',$empleadoresult[0]['I_LUNES']);
          $form->get('F_LUNES')->setAttribute('value',$empleadoresult[0]['F_LUNES']);
          $form->get('I_MARTES')->setAttribute('value',$empleadoresult[0]['I_MARTES']);
          $form->get('F_MARTES')->setAttribute('value',$empleadoresult[0]['F_MARTES']);
          $form->get('I_MIERCOLES')->setAttribute('value',$empleadoresult[0]['I_MIERCOLES']);
          $form->get('F_MIERCOLES')->setAttribute('value',$empleadoresult[0]['F_MIERCOLES']);
          $form->get('I_JUEVES')->setAttribute('value',$empleadoresult[0]['I_JUEVES']);
          $form->get('F_JUEVES')->setAttribute('value',$empleadoresult[0]['F_JUEVES']);
          $form->get('I_VIERNES')->setAttribute('value',$empleadoresult[0]['I_VIERNES']);
          $form->get('F_VIERNES')->setAttribute('value',$empleadoresult[0]['F_VIERNES']);
          $form->get('I_SABADO')->setAttribute('value',$empleadoresult[0]['I_SABADO']);
          $form->get('F_SABADO')->setAttribute('value',$empleadoresult[0]['F_SABADO']);
          $form->get('I_DOMINGO')->setAttribute('value',$empleadoresult[0]['I_DOMINGO']);
          $form->get('F_DOMINGO')->setAttribute('value',$empleadoresult[0]['F_DOMINGO']);
        }
        if($this->request->isPost()) {
            $form->setData($this->request->getPost());
            if($form->isValid()) {
                $hydrator = new DoctrineObject($this->getObjectManager(),'CsnUser\Entity\Empleados');
                $empleado = new Empleados();
                $data = $form->getData(FormInterface::VALUES_AS_ARRAY);
                $empleado = $hydrator->hydrate($data,$empleado);
                $empleado->setJEFE($em->find('CsnUser\Entity\User',$this->identity()->getId()));
                $empleado->setSTATUS(0);
                if($id) {
                    $empleado->setID($id);
                    $em->merge($empleado);
                } else {
                    $em->persist($empleado);
                }
                $em->flush();

            }
          return new JsonModel(array('errores' => $form->getMessages()));
        } else {
          return new ViewModel($resultado);
        }
    }
    
     /**
     * get entityManager
     *
     * @return Doctrine\ORM\EntityManager
     */   
    protected function getObjectManager()
    {
          if (!$this->em) {
              $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
          }

          return $this->em;
    }
}
