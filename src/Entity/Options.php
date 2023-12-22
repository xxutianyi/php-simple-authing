<?php

namespace SimpleAuthing\Entity;

class Options
{
    public string $appHost = "https://core.authing.cn";
    public string $protocol = "oidc";
    public string $tokenEndPointAuthMethod = "client_secret_post";
    public string $introspectionEndPointAuthMethod = "client_secret_post";
    public string $revocationEndPointAuthMethod = "client_secret_post";
    public string $appId;
    public string $appSecret;
    public string $responseType = "code";
    public string $redirectUri;
    public string $scope = "openid profile";
    public string $prompt = "none";
    public string $responseMode = "query";
    public ?string $tenantId = null;
    public ?string $loginPageContext = null;
    public ?string $extIdpConnId = null;
    public ?string $deviceId = null;
    public string $userPoolId;

}