<?php

namespace AppBundle\Form;

use AppBundle\Entity\Adherent;
use AppBundle\Membership\AdherentEmailSubscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Choice;

class AdherentEmailSubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emails_subscriptions', ChoiceType::class, [
                'label' => false,
                'choices' => AdherentEmailSubscription::SUBSCRIPTIONS,
                'constraints' => new All([
                    'constraints' => [new Choice([
                        'choices' => AdherentEmailSubscription::getMergedSubscriptions(),
                        'strict' => true,
                    ])],
                ]),
                'expanded' => true,
                'multiple' => true,
                'error_bubbling' => true,
            ])
            ->add('citizenProjectCreationEmailSubscriptionRadius', ChoiceType::class, [
                'choices' => AdherentEmailSubscription::CITIZEN_PROJECT_DISTANCE_NOTIFICATION,
                'label' => false,
                'attr' => [
                    'style' => 'display: none;',
                ],
                'error_bubbling' => true,
            ])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer les modifications'])
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $formData = $event->getData();
            $form = $event->getForm();
            if (!\in_array(AdherentEmailSubscription::SUBSCRIBED_EMAILS_CITIZEN_PROJECT_CREATION, $formData['emails_subscriptions'] ?? [], true)) {
                $form->add('citizenProjectCreationEmailSubscriptionRadius', ChoiceType::class, [
                    'choices' => array_merge(AdherentEmailSubscription::CITIZEN_PROJECT_DISTANCE_NOTIFICATION, ['Désactivé' => Adherent::DISABLED_CITIZEN_PROJECT_EMAIL]),
                ]);
                $formData['citizenProjectCreationEmailSubscriptionRadius'] = -1;
                $event->setData($formData);
            }
        });
    }
}
