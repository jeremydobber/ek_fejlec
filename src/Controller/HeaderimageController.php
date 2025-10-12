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

namespace PrestaShop\Module\Headerbar\Controller;

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
    private $module_images_dir = 'images';

    public function index(
        Request $request,
        #[Autowire(service: 'prestashop.module.headerbar.form.headerimage_text_form_data_handler')]
        FormHandlerInterface $textFormDataHandler,
    ): Response {
        $textForm = $textFormDataHandler->getForm();
        $textForm->handleRequest($request);

        $module_images_abspath = _PS_MODULE_DIR_ . 'headerbar' . DIRECTORY_SEPARATOR . $this->module_images_dir;

        if ($textForm->isSubmitted() && $textForm->isValid()) {
            foreach (['index_image', 'about_image'] as $imageFile) {
                if (!is_null($textForm->get($imageFile)->getData())) {
                    $file = $textForm->get($imageFile)->getData();
                    $this->upload($file, $module_images_abspath, $imageFile);
                    $this->generateResponsiveImages($module_images_abspath, $imageFile);
                    $config_key = strtoupper($imageFile);
                    \Configuration::updateValue("HEADERBAR_{$config_key}", $imageFile);
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

        return $this->render('@Modules/headerbar/views/templates/admin/headerimage_conf_form.html.twig', [
            'HeaderimageConfigurationForm' => $textForm->createView(),
        ]);
    }

    private function upload(UploadedFile $uploadedFile, string $module_image_abspath, string $form_field)
    {
        $newFilename = $form_field . '.' . $uploadedFile->guessExtension();

        // Should force conversion to webp to use later in gd imagegeneration function below

        // Empying destination directory of old images.
        $images = glob($module_image_abspath . DIRECTORY_SEPARATOR . $form_field . '.*\..*', \GLOB_BRACE);
        foreach ($images as $image) {
            unlink($image);
        }

        $uploadedFile->move(
            $module_image_abspath,
            $newFilename,
        );

        return true;
    }

    private function generateResponsiveImages(string $module_images_abspath, string $fileName)
    {
        $sizes = [2560, 1920, 1280, 768];

        // Function is assuming image is in webp format
        $gd = imagecreatefromwebp($module_images_abspath . DIRECTORY_SEPARATOR . $fileName . '.webp');

        foreach ($sizes as $size) {
            $rescaled = imagescale($gd, $size);
            $newFileName = $fileName . '_' . $size . '.webp';
            imagewebp($rescaled, $module_images_abspath . DIRECTORY_SEPARATOR . $newFileName, 90);
        }
    }
}
