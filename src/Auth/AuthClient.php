<?php

namespace SimpleAuthing\Auth;

use SimpleAuthing\Entity\Options;
use SimpleRequest\Request as SimpleRequest;

class AuthClient
{
    private Options $options;

    public function __construct(Options $options)
    {
        $this->options = $options;
    }

    public function loginUrl(string $state = "", string $nonce = ""): string
    {
        $baseUrl = $this->options->appHost . "/oidc/auth";
        $query = [
            'client_id' => $this->options->appId,
            'response_type' => $this->options->responseType,
            'redirect_uri' => urlencode($this->options->redirectUri),
            'scope' => $this->options->scope,
            'state' => $state,
            'nonce' => $nonce,
            'prompt' => $this->options->prompt,
            'response_mode' => $this->options->responseMode,
            'tenant_id' => $this->options->tenantId,
            'login_page_context' => $this->options->loginPageContext,
            'ext_idp_conn_id' => $this->options->extIdpConnId,
            'deviceId' => $this->options->deviceId,
        ];

        return $baseUrl . "?" . http_build_query($query);
    }

    public function getTokenByCode(string $code)
    {
        $url = $this->options->appHost . "/oidc/token";
        $body = [
            'client_id' => $this->options->appId,
            'client_secret' => $this->options->appSecret,
            'redirect_uri' => $this->options->redirectUri,
            'code' => $code
        ];

        return SimpleRequest::post($url, [], $body, [], false);
    }

    public function revokeToken(string $token)
    {
        $url = $this->options->appHost . "/oidc/token";
        $body = [
            'client_id' => $this->options->appId,
            'client_secret' => $this->options->appId,
            'token' => $token
        ];

        return SimpleRequest::post($url, [], $body, [], false);
    }

    public function logoutUrl(string $idToken, string $redirectUri, string $state): string
    {
        $baseUrl = $this->options->appHost . "/oidc/session/end";
        $query = [
            'id_token_hint' => $idToken,
            'post_logout_redirect_uri' => $redirectUri,
            'state' => $state,
        ];

        return $baseUrl . "?" . http_build_query($query);
    }

    public function getProfile(string $accessToken, bool $withCustomData = false, bool $withIdentities = false, bool $withDepartmentIds = false)
    {
        $url = $this->options->appHost . "/oidc/token";
        $body = [
            'withCustomData' => $withCustomData,
            'withIdentities' => $withIdentities,
            'withDepartmentIds' => $withCustomData
        ];
        $headers = [
            'Authorization' => "Bearer $accessToken"
        ];

        return SimpleRequest::post($url, [], $body, $headers);
    }
}