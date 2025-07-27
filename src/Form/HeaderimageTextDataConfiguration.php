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

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;

/**
 * Configuration is used to save data to configuration table and retrieve from it.
 */
final class HeaderimageTextDataConfiguration implements DataConfigurationInterface
{
    public const EK_FEJLEC_TITLE = 'EK_FEJLEC_TITLE';
    public const EK_FEJLEC_SUBTITLE = 'EK_FEJLEC_SUBTITLE';
    public const EK_FEJLEC_IMAGE = 'EK_FEJLEC_IMAGE';
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

        $return['title'] = $this->configuration->get(static::EK_FEJLEC_TITLE);
        $return['subtitle'] = $this->configuration->get(static::EK_FEJLEC_SUBTITLE);

        return $return;
    }

    public function updateConfiguration(array $configuration): array
    {
        $errors = [];

        if ($this->validateConfiguration($configuration)) {
            if (isset($configuration['title'])) {
                if (strlen($configuration['title']) <= static::CONFIG_MAXLENGTH) {
                    $this->configuration->set(static::EK_FEJLEC_TITLE, $configuration['title']);
                } else {
                    $errors[] = 'EK_FEJLEC_TITLE value is too long';
                }
            }
            if (isset($configuration['subtitle'])) {
                if (strlen($configuration['subtitle']) <= static::CONFIG_MAXLENGTH) {
                    $this->configuration->set(static::EK_FEJLEC_SUBTITLE, $configuration['subtitle']);
                } else {
                    $errors[] = 'EK_FEJLEC_SUBTITLE value is too long';
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
        return isset($configuration['title']) || isset($configuration['subtitle']);
    }
}
