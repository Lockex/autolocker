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
    	$query = $this->getObjectManager()->createQuery("SELECT em.NOMBRE,em.APELLIDO_PATERNO,em.APELLIDO_MATERNO,em.STATUS,em.ID FROM 
            CsnUser\Entity\Empleados em WHERE em.JEFE =".$this->identity()->getId());
    	$empleados = $query->getArrayResult();
    	$resultado = array('empleados' => $empleados);
    	return new ViewModel($resultado);
    }

    public function nuevoempleadoAction() {
        $em = $this->getObjectManager();
        $this->layout('layout/vacio');
        $form = new EmpleadosForm($em);
        $id = $this->params()->fromRoute('id');
        $resultado = array('form' => $form);
        if($id) {
          $queryEmpleado = $em->createQuery("SELECT e FROM CsnUser\Entity\Empleados e WHERE e.ID = $id");
          $empleadoresult = $query->getArrayResult();
          $form->get('NOMBRE')->setAttribute('value',$empleadoresult[0]['NOMBRE']);
          $form->get('APELLIDO_PATERNO')->setAttribute('value',$empleadoresult[0]['APELLIDO_PATERNO']);
          $form->get('APELLIDO_MATERNO')->setAttribute('value',$empleadoresult[0]['APELLIDO_MATERNO']);
          $form->get('NUMERO')->setAttribute('value',$empleadoresult[0]['NUMERO']);  
        }
        if($this->request->isPost()) {
            $form->setData($this->request->getPost());
            if($form->isValid()) {
                $hydrator = new DoctrineObject($this->getObjectManager(),'CsnUser\Entity\Empleados');
                $empleado = new Empleados();
                $data = $form->getData(FormInterface::VALUES_AS_ARRAY);
                $empleado = $hydrator->hydrate($data,$empleado);
                $empleado->setJEFE($em->find('CsnUser\Entity\User',$this->identity()->getId()));
                if($id) {
                    $empleado->setID($id);
                    $em->merge($empleado);
                } else {
                    $em->persist($empleado);
                }
                $em->flush();

            }
        }
        return new ViewModel($resultado);
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
