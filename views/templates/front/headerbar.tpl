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
            <img srcset="
                /modules/headerbar/images/{$headerbar_index_image}_2560.webp 2560w,
                /modules/headerbar/images/{$headerbar_index_image}_1920.webp 1920w,
                /modules/headerbar/images/{$headerbar_index_image}_1280.webp 1280w,
                /modules/headerbar/images/{$headerbar_index_image}_768.webp 768w"
                sizes="(width <= 768) 768px, (width > 768 and width <= 1280) 1280px, (width > 1280 and width <= 1920) 1920px, (width > 1920 and width <= 2560) 2560px"
                src="/modules/headerbar/images/{$headerbar_index_image}.webp">
        {/if}
        <div class="text_block">
            <h4>{$headerbar_index_title}</h4>
            <p>{$headerbar_index_subtitle}</p>
        </div>
    </div>
{else if {$page.body_classes["cms-id-4"]} == {true}}
    <div id="headerbar_block_home" class="block">
        {if isset($headerbar_about_image)}
            <img srcset="
                /modules/headerbar/images/{$headerbar_about_image}_2560.webp 2560w,
                /modules/headerbar/images/{$headerbar_about_image}_1920.webp 1920w,
                /modules/headerbar/images/{$headerbar_about_image}_1280.webp 1280w,
                /modules/headerbar/images/{$headerbar_about_image}_768.webp 768w"
                sizes="(width <= 768) 768px, (width > 768 and width <= 1280) 1280px, (width > 1280 and width <= 1920) 1920px, (width > 1920 and width <= 2560) 2560px"
                src="/modules/headerbar/images/{$headerbar_about_image}.webp">
        {/if}
        <div class="text_block">
            <h4>{$headerbar_about_title}</h4>
            <p>{$headerbar_index_subtitle}</p>
        </div>
    </div>
{/if}