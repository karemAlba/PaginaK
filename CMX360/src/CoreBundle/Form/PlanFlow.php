<?php

namespace CoreBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class PlanFlow extends FormFlow
{
    protected function loadStepsConfig()
    {
        return array(
            array(
                'label' => 'g',
                'form_type' => 'CoreBundle\Form\PlanType',
            ),
            array(
                'label' => 'e',
                'form_type' => 'CoreBundle\Form\PlanType',
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 2 && !$flow->getFormData()->getCondicionescomerciales();
                },
            ),
            array(
                'label' => 'c',
            ),
        );
    }

}
