<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type as Type;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', Type\TextType::class, [
                'label' => 'Nom du produit',
                'attr' => [
                    'placeholder' => 'Tappez le nom du produit'
                ]
            ])
            ->add('shortDescription', Type\TextareaType::class, [
                'label' => 'Description du produit',
                'attr' => [
                    'placeholder' => 'Tappez le nom la description'
                ]
            ])
            ->add('price', Type\MoneyType::class, [
                'label' => 'Prix du produit',
                'attr' => [
                    'placeholder' => 'Tappez le prix en €'
                ],
                'divisor' => 100
            ])
            ->add('picture', Type\FileType::class, [
                'label' => 'Image du produit',
                'data_class' => null,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ajoutez un fichier'
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'placeholder' => 'Choisir une catégory'
            ]);


            // $builder->get('price')->addModelTransformer(new CentimesTransformer);

            // $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event){
            //     /** @var Product */
            //     $product = $event->getData();

            //     if ($product->getPrice() !== null){
            //         $product->setPrice($product->getPrice() * 100);
            //     }
            // });

            // $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            //     $form = $event->getForm();

            //     /** @var Product */
            //     $product = $event->getData();

            //     if ($product->getPrice() !== null){
            //         $product->setPrice($product->getPrice() / 100);
            //     }
            // });
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
