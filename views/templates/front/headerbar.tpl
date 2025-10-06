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

{if {$page.page_name} === "index"}
    <div id="headerbar_block_home" class="block">
        {if isset($headerbar_index_image)}
            <img src="{$headerbar_index_image}">
        {/if}
        <div class="text_block">
            <h4>{$headerbar_index_title}</h4>
            <p>{$headerbar_index_subtitle}</p>
        </div>
    </div>
{else if {$page.body_classes["cms-id-4"]} == {true}}
    <div id="headerbar_block_home" class="block">
        {if isset($headerbar_about_image)}
            <img src="{$headerbar_about_image}">
        {/if}
        <div class="text_block">
            <h4>{$headerbar_about_title}</h4>
            <p>{$headerbar_index_subtitle}</p>
        </div>
    </div>
{/if}
