<?
function ImportDataFromDomGosuslugi(){
    define ('ORG_IBLOCK_ID',123);
    $ch = curl_init();

    $headers = array(
        accept applicationjson; charset=utf-8,
        accept-language ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7,
        cache-control no-cache,
        if-modified-since 0,
        pragma no-cache,
        request-guid 72a3f5d1-e67d-4671-bdcc-f8d0f384afb5,
        sec-fetch-dest empty,
        sec-fetch-mode cors,
        sec-fetch-site same-origin,
        session-guid f1bf0dd1-287a-44a8-bada-bc38278fb9bb,
        state-guid org-info
    );

    curl_setopt($ch, CURLOPT_URL, httpsdom.gosuslugi.ruinformation-disclosureapirestservicesdisclosuresorgcommon9e96a547-3f89-449e-a3cc-4f8aa873f40e);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, GET);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $jsonArray = json_decode($response, true);
    $detailInfo = $jsonArray['detailInfo'];
    $el = new CIBlockElement;
    $PROP = array();
    $PROP['INFO_NAME_SHORT'] = $detailInfo['name'];
    $PROP['INFO_NAME_FULL'] = $detailInfo['fullName'];
    $PROP['INFO_OKOPF'] = $detailInfo['okopf'];
    $PROP['INFO_INN'] = $detailInfo['inn'];
    $PROP['INN'] = $detailInfo['inn'];
    $PROP['INFO_POST_ADDRESS'] = $detailInfo['postAddress'];
    $PROP['ADDRESS'] = $detailInfo['regAddress'];
    $PROP['PHONE'] = implode(',',$detailInfo['phones']);

    $arLoadOrgArray = Array(
        'MODIFIED_BY' = $GLOBALS['USER']-GetID(),  элемент изменен текущим пользователем
        'IBLOCK_SECTION_ID' = false,  элемент лежит в корне раздела
        'IBLOCK_ID' = ORG_IBLOCK_ID,
        'PROPERTY_VALUES' = $PROP,
        'NAME' =  $detailInfo['name'],
        'ACTIVE' = 'Y',  активен
    );

    $PRODUCT_ID = $el-Add($arLoadOrgArray);
    return ImportDataFromDomGosuslugi();;
}