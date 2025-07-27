<?php
/**
 * Copyright since 2025 Jeremy Dobberman
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future. If you wish to customize it for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    Jeremy Dobberman <yellowyankee@proton.me>
 * @copyright Since 2025 Jeremy Dobberman
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
declare(strict_types=1);

namespace PrestaShop\Module\Ek_Fejlec\Form;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class HeaderimageFormType extends TranslatorAwareType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => $this->trans('Cím', 'Modules.Ek_Fejlec.Admin'),
                'help' => $this->trans('Fakultatív', 'Modules.Ek_Fejlec.Admin'),
                'required' => false,
            ])
            ->add('subtitle', TextType::class, [
                'label' => $this->trans('Szöveg', 'Modules.Ek_Fejlec.Admin'),
                'help' => $this->trans('Fakultatív', 'Modules.Ek_Fejlec.Admin'),
                'required' => false,
            ])
            ->add('imageFile', FileType::class, [
                'help' => $this->trans('Elfogadott formátumok: webp, png, jpeg/jpg.', 'Modules.Ek_Fejlec.Admin'),
                'constraints' => [new File(extensions: ['webp', 'png', 'jpg', 'JPEG', 'jpeg', 'PNG', 'JPG'])],
                'mapped' => false,
                'required' => false,
            ]);
    }
}
