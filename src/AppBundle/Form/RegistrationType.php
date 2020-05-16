<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use AppBundle\Entity\civilite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('adresse',TextType::class, array('required'=> false))
            ->add('code_postal',TextType::class, array('required'=> false))
            ->add('ville',TextType::class, array('required'=> false))
            ->add('civilite',EntityType::class, [
        'class' => 'AppBundle\Entity\civilite',
        'choice_label' => 'sexe',
    ])
            ->add('role',EntityType::class, [
        'class' => 'AppBundle\Entity\Role',
        'choice_label' => 'role',
    ]);

    }


    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

    }


}