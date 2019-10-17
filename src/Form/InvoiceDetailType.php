<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\InvoiceDetail;
use App\Entity\Product;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity',null,[
                'attr' => ['class' => 'quantity'],
            ]);

        $builder->add('product', EntityType::class, [
            'class' => Product::class,
            'choice_label' => 'name',
            'attr' => ['class' => 'product'],
            'placeholder' => "Select"
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InvoiceDetail::class,
        ]);
    }
}
