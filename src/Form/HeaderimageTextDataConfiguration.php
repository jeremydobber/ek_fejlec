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

namespace PrestaShop\Module\Headerbar\Form;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;

/**
 * Configuration is used to save data to configuration table and retrieve from it.
 */
final class HeaderimageTextDataConfiguration implements DataConfigurationInterface
{
    public const HEADERBAR_INDEX_TITLE = 'HEADERBAR_INDEX_TITLE';
    public const HEADERBAR_INDEX_SUBTITLE = 'HEADERBAR_INDEX_SUBTITLE';
    public const HEADERBAR_INDEX_IMAGE = 'HEADERBAR_INDEX_IMAGE';
    public const HEADERBAR_ABOUT_TITLE = 'HEADERBAR_ABOUT_TITLE';
    public const HEADERBAR_ABOUT_SUBTITLE = 'HEADERBAR_ABOUT_SUBTITLE';
    public const HEADERBAR_ABOUT_IMAGE = 'HEADERBAR_ABOUT_IMAGE';
    public const CONFIG_MAXLENGTH = 32;

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration(): array
    {
        $return = [];

        $return['index_title'] = $this->configuration->get(static::HEADERBAR_INDEX_TITLE);
        $return['index_subtitle'] = $this->configuration->get(static::HEADERBAR_INDEX_SUBTITLE);
        $return['about_title'] = $this->configuration->get(static::HEADERBAR_ABOUT_TITLE);
        $return['about_subtitle'] = $this->configuration->get(static::HEADERBAR_ABOUT_SUBTITLE);

        return $return;
    }

    public function updateConfiguration(array $configuration): array
    {
        $errors = [];

        if ($this->validateConfiguration($configuration)) {
            if (isset($configuration['index_title'])) {
                if (strlen($configuration['index_title']) <= static::CONFIG_MAXLENGTH) {
                    $this->configuration->set(static::HEADERBAR_INDEX_TITLE, $configuration['index_title']);
                } else {
                    $errors[] = 'Home page title value is too long';
                }
            }
            if (isset($configuration['index_subtitle'])) {
                if (strlen($configuration['index_subtitle']) <= static::CONFIG_MAXLENGTH) {
                    $this->configuration->set(static::HEADERBAR_INDEX_SUBTITLE, $configuration['index_subtitle']);
                } else {
                    $errors[] = 'Home page subtitle value is too long';
                }
            }
            if (isset($configuration['about_title'])) {
                if (strlen($configuration['about_title']) <= static::CONFIG_MAXLENGTH) {
                    $this->configuration->set(static::HEADERBAR_ABOUT_TITLE, $configuration['about_title']);
                } else {
                    $errors[] = 'About page title value is too long';
                }
            }
            if (isset($configuration['about_subtitle'])) {
                if (strlen($configuration['about_subtitle']) <= static::CONFIG_MAXLENGTH) {
                    $this->configuration->set(static::HEADERBAR_ABOUT_SUBTITLE, $configuration['about_subtitle']);
                } else {
                    $errors[] = 'About page subtitle value is too long';
                }
            }
        }

        /* Errors are returned here. */
        return $errors;
    }

    /**
     * Ensure the parameters passed are valid.
     *
     * @return bool Returns true if no exception are thrown
     */
    public function validateConfiguration(array $configuration): bool
    {
        return
            isset($configuration['index_title'])
            || isset($configuration['index_subtitle'])
            || isset($configuration['about_title'])
            || isset($configuration['about_subtitle']);
    }
}
