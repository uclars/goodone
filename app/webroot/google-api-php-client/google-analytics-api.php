    <?php
    //google-analytics-api.php
     
    require_once __DIR__ . '/src/Google_Client.php';
    require_once __DIR__ . '/src/contrib/Google_AnalyticsService.php';
     
    //クライアントID
    define('CLIENT_ID', '115386042064-g0ff7bsq47rjr0eubiou0fbiqpue937u.apps.googleusercontent.com');
    //メールアドレス
    define('SERVICE_ACCOUNT_NAME', '115386042064-g0ff7bsq47rjr0eubiou0fbiqpue937u@developer.gserviceaccount.com');
    //秘密鍵
    define('KEY_FILE', __DIR__ . '/f1bdd1d7b0accd1e9a48e02d862b70e9fe8dec58-privatekey.p12');
    //ビューID
    define('PROFILE_ID', '72256721');
     
    $client = new Google_Client();
    $client->setApplicationName("Google Analytics PHP Starter Application");
    $client->setClientId(CLIENT_ID);
    $client->setAssertionCredentials(new Google_AssertionCredentials(
    SERVICE_ACCOUNT_NAME,
    array('https://www.googleapis.com/auth/analytics'),
    file_get_contents(KEY_FILE)
    ));
     
    $service = new Google_AnalyticsService($client);
    $result = $service->data_ga->get(
    'ga:' . PROFILE_ID,
    '2014-01-01', //開始日
    '2014-01-31', //終了日
    'ga:pageviews',
    array(
    'dimensions' => 'ga:pageTitle,ga:pagePath',
    'sort' => '-ga:pageviews',
    'max-results' => '7' //件数
    )
    );
     
    print_r($result['rows']);
?>
