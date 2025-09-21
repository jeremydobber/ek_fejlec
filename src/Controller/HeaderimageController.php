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

namespace PrestaShop\Module\Ek_Fejlec\Controller;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Form\FormHandlerInterface;
use PrestaShopBundle\Controller\Admin\PrestaShopAdminController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HeaderimageController extends PrestaShopAdminController
{
    public function index(
        Request $request,
        #[Autowire(service: 'prestashop.module.ek_fejlec.form.headerimage_text_form_data_handler')]
        FormHandlerInterface $textFormDataHandler,
    ): Response {
        $textForm = $textFormDataHandler->getForm();
        $textForm->handleRequest($request);

        if ($textForm->isSubmitted() && $textForm->isValid()) {
            foreach (['index_image', 'about_image'] as $imageFile) {
                if (!is_null($textForm->get($imageFile)->getData())) {
                    $file = $textForm->get($imageFile)->getData();
                    $filePath = $this->upload($file, $imageFile);
                    $config_key = strtoupper($imageFile);
                    \Configuration::updateValue("EK_FEJLEC_{$config_key}", $filePath);
                }
            }

            /** You can return array of errors in form handler and they can be displayed to user with flashErrors */
            $errors = $textFormDataHandler->save($textForm->getData());

            if (empty($errors)) {
                $this->addFlash('success', $this->trans('Successful update.', [], 'Admin.Notifications.Success'));

                return $this->redirectToRoute('headerimage_conf_form');
            }

            $this->addFlashErrors($errors);
        }

        return $this->render('@Modules/ek_fejlec/views/templates/admin/headerimage_conf_form.html.twig', [
            'HeaderimageConfigurationForm' => $textForm->createView(),
        ]);
    }

    public function upload(UploadedFile $uploadedFile, string $form_field)
    {
        $newFilename = $form_field . '.' . $uploadedFile->guessExtension();
        $module_file_dir = 'images';
        $relpath = _MODULE_DIR_ . 'ek_fejlec' . DIRECTORY_SEPARATOR . $module_file_dir;
        $abspath = _PS_MODULE_DIR_ . 'ek_fejlec' . DIRECTORY_SEPARATOR . $module_file_dir;
        $images = glob($abspath . DIRECTORY_SEPARATOR . $form_field . '\..*', \GLOB_BRACE);
        foreach ($images as $image) {
            unlink($image);
        }

        $uploadedFile->move(
            $abspath,
            $newFilename,
        );

        return $relpath . DIRECTORY_SEPARATOR . $newFilename;
    }
}
