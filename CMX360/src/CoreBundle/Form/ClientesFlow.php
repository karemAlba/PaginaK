<?php

namespace CoreBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class ClientesFlow extends FormFlow
{
    protected function loadStepsConfig()
    {
        return array(
            array(
                'label' => 'g',
                'form_type' => 'CoreBundle\Form\ClientesType',
            ),
            array(
                'label' => 'd',
                'form_type' => 'CoreBundle\Form\ClientesType',
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->getNumeroPermiso();
                },
            ),
            array(
                'label' => 'e',
                'form_type' => 'CoreBundle\Form\ClientesType',
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->getNumeroPermiso();
                },
            ),
            array(
                'label' => 'c',
            ),
        );
    }

}
