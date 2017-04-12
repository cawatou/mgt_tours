<style>
    .checkme {
        width: 11px;
        display: inline-block;
        height: 11px;
        border: 1px solid #d9d9d9;
        border-radius: 3px;
        margin-right: 10px;
        cursor: pointer;
    }

    .checkeds {
        width: 11px;
        display: inline-block;
        height: 11px;
        background: #db3636;
        color: #fff;
        border-radius: 3px;
        margin-right: 10px;
        font-size: 10px;
        line-height: 11px;
        overflow: hidden;
    }

    .hidecheck {
        display: none;
    }
</style>
<div class="modal fade" id="myTown" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Где вы находитесь:</h4>
        </div>
        <p>Ваш город: <b class="myTown">Санкт Петербург</b></p>
        <button type="button" class="closethis  btnformmodalwhite">ОК</button>
        <button type="button" class="change btnformmodalwhite">Изменить</button>
        <div class="clearfix"></div>
    </div>
</div>
</div>

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <? $APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth", Array(
                "REGISTER_URL" => "/auth/",
                "PROFILE_URL" => "/personal/profile/"
                )
                ); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addrewiev" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Добавить отзыв</h4>
            </div>
            <form id="addRewv" enctype="multipart/form-data">
             <div class="modal-body">
                 <? if(!CSite::InGroup(array(1,5,10))){?>
                 <div class="row">
                   <div class="col-md-12 col-xs-12">
                      <div class="form-group ">
                         <input name="imya" class="form-control" placeholder="Имя" />
                     </div>
                     <div class="form-group ">
                         <input name="phone" class="form-control" placeholder="Телефон" />
                     </div>
                     <div class="form-group ">
                         <input name="email" class="form-control" placeholder="Почта" />
                     </div>
                 </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-xs-12">
                  <input type="file" name="upload" id="upload" onchange="getName(this.value);" />
                  <a href="#" class="redbot loadpic">Ваше фото</a> <span id="fileformlabel"></span>
              </div>
          </div>
          <?}?>
          <div class="row">
           <div class="col-md-12 col-xs-12">
              <textarea name="more" class="form-control" placeholder="Ваш Отзыв (не более 500 символов)" ></textarea>
          </div>
      </div>
      <div class="row">
       <div class="col-md-12 col-xs-12">
          <a href="#" class="bigbtn submt">Отправить отзыв</a>
      </div>
  </div>
</div>
</form>
</div>
</div>
</div>
<div class="modal fade" id="registar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?$APPLICATION->IncludeComponent(
               "bitrix:main.register",
               "tourreg",
               Array(
                  "SEF_MODE" => "N", 
                  "SHOW_FIELDS" => Array("NAME","LAST_NAME","EMAIL","PERSONAL_PHONE","PERSONAL_BIRTHDAY","PERSONAL_CITY","PERSONAL_PHOTO"), 
                  "REQUIRED_FIELDS" => Array("NAME","LAST_NAME","PERSONAL_CITY","EMAIL","PERSONAL_PHONE"), 
                  "AUTH" => "Y", 
                  "USE_BACKURL" => "Y", 
                  "SUCCESS_PAGE" => "/lk/", 
                  "SET_TITLE" => "N", 
                  "CACHE_TYPE" => "A", 
                  "CACHE_TIME" => "3600" 
                  )
                  );?>
              </div>
          </div>
      </div>
      <div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?$APPLICATION->IncludeComponent(
                  "bitrix:system.auth.forgotpasswd",
                  "",
                  Array(
                     "SHOW_ERRORS"=>"Y"
                     ) 
                     );?>
                 </div>
             </div>
         </div>
         <div class="modal fade" id="question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <? $APPLICATION->IncludeComponent("bitrix:form.result.new", "question", Array(
                        "SEF_MODE" => "N",
                        "WEB_FORM_ID" => 2,
                        "EDIT_URL" => "",
                        "CHAIN_ITEM_TEXT" => "",
                        "CHAIN_ITEM_LINK" => "",
                        "IGNORE_CUSTOM_TEMPLATE" => "Y",
                        "SUCCESS_URL" => "",
                        "COMPONENT_TEMPLATE" => "question",
                        "LIST_URL" => "result.php",
                        "USE_EXTENDED_ERRORS" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "VARIABLE_ALIASES" => Array("RESULT_ID" => "RESULT_ID", "WEB_FORM_ID" => "WEB_FORM_ID")
                        )
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="orderfor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <? $APPLICATION->IncludeComponent("bitrix:form.result.new", "orderfor", Array(
                            "SEF_MODE" => "N",
                            "WEB_FORM_ID" => 2,
                            "EDIT_URL" => "",
                            "CHAIN_ITEM_TEXT" => "",
                            "CHAIN_ITEM_LINK" => "",
                            "IGNORE_CUSTOM_TEMPLATE" => "Y",
                            "SUCCESS_URL" => "",
                            "COMPONENT_TEMPLATE" => "orderfor",
                            "LIST_URL" => "result.php",
                            "USE_EXTENDED_ERRORS" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "VARIABLE_ALIASES" => Array("RESULT_ID" => "RESULT_ID", "WEB_FORM_ID" => "WEB_FORM_ID")
                            )
                            ); ?>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="soc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <? $APPLICATION->IncludeComponent("bitrix:form.result.new", "soc", Array(
                                "SEF_MODE" => "N",
                                "WEB_FORM_ID" => 9,
                                "EDIT_URL" => "",
                                "CHAIN_ITEM_TEXT" => "",
                                "CHAIN_ITEM_LINK" => "",
                                "IGNORE_CUSTOM_TEMPLATE" => "Y",
                                "SUCCESS_URL" => "",
                                "COMPONENT_TEMPLATE" => "question",
                                "LIST_URL" => "result.php",
                                "USE_EXTENDED_ERRORS" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "VARIABLE_ALIASES" => Array("RESULT_ID" => "RESULT_ID", "WEB_FORM_ID" => "WEB_FORM_ID")
                                )
                                ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="callback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <? $APPLICATION->IncludeComponent("bitrix:form.result.new", "question", Array(
                                    "SEF_MODE" => "N",
                                    "WEB_FORM_ID" => 3,
                                    "EDIT_URL" => "",
                                    "CHAIN_ITEM_TEXT" => "",
                                    "CHAIN_ITEM_LINK" => "",
                                    "IGNORE_CUSTOM_TEMPLATE" => "Y",
                                    "SUCCESS_URL" => "",
                                    "USE_EXTENDED_ERRORS" => "Y",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "3600",
                                    "VARIABLE_ALIASES" => Array("RESULT_ID" => "RESULT_ID", "WEB_FORM_ID" => "WEB_FORM_ID")
                                    )
                                    ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="answer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="showmap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                 <div style="text-align:center;"><img src="/bitrix/templates/tour/images/89.gif" /></div>
                             </div>
                         </div>
                     </div>
                     <a href="#" id="scroller" class="fa fa-angle-up"></a>
                     <script>
                        var officeForCity = "<?=$officeForCity?>";
                        var reqID = "<?=$_REQUEST['req']?>";
                        var userCity = "<?=$User_city['city']?>";
                        var ajaxLicKey = "<?= md5('ajax_' . LICENSE_KEY)?>";

                        var inGroup = <?if(CSite::InGroup(array(1,10))){?>"y";<?}else{?>"n";<?}?>
                    </script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                    crossorigin="anonymous"></script>
                    <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.fullPage.min.js"></script>
                    <script src="<?= SITE_TEMPLATE_PATH ?>/js/fullPage.ext.js"></script>
                    <? if ($APPLICATION->GetCurPage(false) !== '/'): ?>
                    <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/moment-with-locales.min.js"></script>
                <? endif; ?>
                <? if ($APPLICATION->GetCurPage(false) === '/'): ?>
                <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <? endif; ?>
            <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/bootstrap-datetimepicker.js?<?= time() ?>"></script>
            <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <script src="/video/plyr.js"></script>
            <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.liColl.js"></script>
            <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/masonry.pkgd.min.js"></script>
            <script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/owl.carousel.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.ui.touch-punch.min.js"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/js/all.js?<?= time() ?>"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/js/mask.js"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.jscrollpane.min.js"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.mousewheel.js"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery.formstyler.js?<?= time() ?>"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/adaptive.script.fordesktops.paladdin.js"></script>
            <script src="<?= SITE_TEMPLATE_PATH ?>/js/script.js?<?= time() ?>"></script>
        </body>
        </html>