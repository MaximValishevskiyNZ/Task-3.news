<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="section-nav">
   <form action="<?= $APPLICATION->GetCurPage() ?>">
      <button class="btn btn-warning" type="submit">
         Все новости
      </button>
   </form>

   <? foreach ($arResult["ITEMS"] as $key => $arItem) : ?>
      <form action="<?= $APPLICATION->GetCurPage() ?>" method="GET">
         <button class="btn btn-warning" type="submit" name="ID_SECTION" value="<?= $arItem['IBLOCK_SECTION_ID'] ?>">
            <? $res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
            if ($ar_res = $res->GetNext())
               echo $ar_res['NAME']; ?>
         </button>
      </form>
   <? endforeach ?>
</div>

<? foreach ($arResult["ITEMS"] as $key => $arItem) : ?>
   <?
   if (($arItem["IBLOCK_SECTION_ID"] == $_GET["ID_SECTION"]) || (!isset($_GET["ID_SECTION"]))) {
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
   ?>

      <? if ($key % 2 == 0) : ?>

         <section class="col-md-12 wow fadeIn">
            <div class="post big">
               <div class="row">
                  <div class="col-md-6 media">
                     <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" class="img-responsive">
                  </div>
                  <div class="col-md-6 caption">
                     <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><span><?= $arItem["NAME"] ?>
                           <?= $arItem["DISPLAY_PROPERTIES"]["TAG"]["DISPLAY_VALUE"]; ?>
                        </span></a>
                     <p class="post-description">
                        <?= $arItem["PROPERTIES"]["news_desc"]["VALUE"]["TEXT"] ?>
                     </p>
                     <p class="post-description">
                        <?= $arItem["PROPERTIES"]["news_date"]["VALUE"] ?>
                     </p>
                  </div>
               </div>
            </div>
         </section>

      <? else : ?>

         <section class="col-md-12 wow fadeIn">
            <div class="post big">
               <div class="row">
                  <div class="col-md-6 caption">
                     <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                        <span>
                           <?= $arItem["NAME"] ?>
                           <?= $arItem["DISPLAY_PROPERTIES"]["TAG"]["DISPLAY_VALUE"]; ?>
                        </span>
                     </a>
                     <p class="post-description">
                        <?= $arItem["PROPERTIES"]["news_desc"]["VALUE"]["TEXT"] ?>
                     </p>
                     <p class="post-description">
                        <?= $arItem["PROPERTIES"]["news_date"]["VALUE"] ?>
                     </p>
                  </div>
                  <div class="col-md-6 media">
                     <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" class="img-responsive">
                  </div>
               </div>
            </div>
         </section>

   <? endif;
   } ?>

<? endforeach; ?>
