{*
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
 *}

<!-- Block ek_fejlec -->
<div id="ek_fejlec_block_home" class="block">
    <img src="{$urls.base_url}{$ek_fejlec_image}">
    <div class="text_block">
        <h4>{l s={$ek_fejlec_title} mod='ek_fejlec'}</h4>
        <div class="block_content">
            <p> {if isset($ek_fejlec_subtitle)}
                    {$ek_fejlec_subtitle}
                {/if}
            </p>
        </div>
    </div>
</div>
<!-- /Block ek_fejlec -->