<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    private $parent;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->parent = $options['parent'];

        $builder->add(
            'name'
        );

        if ($this->parent){
            $builder->add('parent', EntityType::class, [
                'class' => Category::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.parent is Null');
                },
                'data' => $this->parent,
                'choice_label' => 'name',
            ]);
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
            'parent' => null
        ]);
    }
}
