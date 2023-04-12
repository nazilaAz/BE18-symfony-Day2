<?php
namespace App\Form\Type;

use App\Entity\Destinations;
use App\Entity\Status;
// use App\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class destinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl outline-none mt-3',
                    'placeholder' => 'Enter New City...',
                ),
                'label' => 'City',])
            ->add('picture', TextType::class,[
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl outline-none mt-3',
                    'placeholder' => 'Insert Image...',
                ),
                'label' => 'Image',])
            ->add('price', MoneyType::class,[
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl outline-none mt-3',
                    'placeholder' => 'Price/day...',
                ),
                'label' => 'Price',])
            ->add('description', TextareaType::class,[
                'attr' => array(
                    'class' => 'bg-transparent block mt-10 border-b-2 w-full h-60 text-6xl outline-none mt-3',
                    'placeholder' => 'Enter Description...'
                ),
                'label' => 'Descrition',
                'required' => false,
            ])
            ->add('fk_status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'name',
                'label' => 'Status'
            ])
            ->add('save', SubmitType::class,  ['attr' => array('class'=>'btn btn-warning mt-3','label' => 'Create New Destination')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Destinations::class,
        ]);
    }
}