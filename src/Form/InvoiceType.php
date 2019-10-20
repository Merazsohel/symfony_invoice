<?php


namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('billNumber')
            ->add('billDate', DateType::class, ['widget' => 'single_text'])
            ->add('customer')
            ->add('remarks')
            ->add('subtotal',null,[
                'attr' => ['class' => 'subtotal'],
            ])
            ->add('vat',null,[
                'attr' => ['class' => 'vat','readonly' =>'true'],
            ])
            ->add('discount',null,[
                'attr' => ['class' => 'discount']
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'

                ]
            ]);

        $builder->add('invoiceDetails', CollectionType::class, [
            'entry_type' => InvoiceDetailType::class,
            'entry_options' => ['label' => false],
            'by_reference' => false,
            'allow_add' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}