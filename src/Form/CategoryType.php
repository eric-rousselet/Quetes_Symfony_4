<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 12/11/18
 * Time: 11:02
 */

namespace App\Form;

use App\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entity\Category::class,
        ]);
    }
}