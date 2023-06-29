<?php

namespace Velsym\Http;

class Response
{
    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
     */
    const CODE_INFO_CONTINUE            = 100;
    const CODE_INFO_SWITCHING_PROTOCOLS = 101;
    const CODE_INFO_PROCESSING          = 102;
    const CODE_INFO_EARLY_HINTS         = 103;

    const CODE_SUCCESS_OK                            = 200;
    const CODE_SUCCESS_CREATED                       = 201;
    const CODE_SUCCESS_ACCEPTED                      = 202;
    const CODE_SUCCESS_NON_AUTHORITATIVE_INFORMATION = 203;
    const CODE_SUCCESS_NO_CONTENT                    = 204;
    const CODE_SUCCESS_RESET_CONTENT                 = 205;
    const CODE_SUCCESS_PARTIAL_CONTENT               = 206;
    const CODE_SUCCESS_MULTI_STATUS                  = 207;
    const CODE_SUCCESS_ALREADY_REPORTED              = 208;
    const CODE_SUCCESS_IM_USED                       = 226;

    const CODE_REDIRECTION_MULTIPLE_CHOICES   = 300;
    const CODE_REDIRECTION_MOVED_PERMANENTLY  = 301;
    const CODE_REDIRECTION_FOUND              = 302;
    const CODE_REDIRECTION_SEE_OTHER          = 303;
    const CODE_REDIRECTION_NOT_MODIFIED       = 304;
    const CODE_REDIRECTION_USE_PROXY          = 305;
    const CODE_REDIRECTION_UNUSED             = 306;
    const CODE_REDIRECTION_TEMPORARY_REDIRECT = 307;
    const CODE_REDIRECTION_PERMANENT_REDIRECT = 308;

    const CODE_CLIENT_BAD_REQUEST                     = 400;
    const CODE_CLIENT_UNAUTHORIZED                    = 401;
    const CODE_CLIENT_PAYMENT_REQUIRED                = 402;
    const CODE_CLIENT_FORBIDDEN                       = 403;
    const CODE_CLIENT_NOT_FOUND                       = 404;
    const CODE_CLIENT_METHOD_NOT_ALLOWED              = 405;
    const CODE_CLIENT_NOT_ACCEPTABLE                  = 406;
    const CODE_CLIENT_PROXY_AUTHENTICATION_REQUIRED   = 407;
    const CODE_CLIENT_REQUEST_TIMEOUT                 = 408;
    const CODE_CLIENT_CONFLICT                        = 409;
    const CODE_CLIENT_GONE                            = 410;
    const CODE_CLIENT_LENGTH_REQUIRED                 = 411;
    const CODE_CLIENT_PRECONDITION_FAILED             = 412;
    const CODE_CLIENT_PAYLOAD_TOO_LARGE               = 413;
    const CODE_CLIENT_URI_TOO_LONG                    = 414;
    const CODE_CLIENT_UNSUPPORTED_MEDIA_TYPE          = 415;
    const CODE_CLIENT_RANGE_NOT_SATISFIABLE           = 416;
    const CODE_CLIENT_EXPECTATION_FAILED              = 417;
    const CODE_CLIENT_IM_A_TEAPOT                     = 418;
    const CODE_CLIENT_MISDIRECTED_REQUEST             = 421;
    const CODE_CLIENT_UNPROCESSABLE_CONTENT           = 422;
    const CODE_CLIENT_LOCKED                          = 423;
    const CODE_CLIENT_FAILED_DEPENDENCY               = 424;
    const CODE_CLIENT_TOO_EARLY                       = 425;
    const CODE_CLIENT_UPGRADE_REQUIRED                = 426;
    const CODE_CLIENT_PRECONDITION_REQUIRED           = 428;
    const CODE_CLIENT_TOO_MANY_REQUESTS               = 429;
    const CODE_CLIENT_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const CODE_CLIENT_UNAVAILABLE_FOR_LEGAL_REASONS   = 451;

    const CODE_SERVER_INTERNAL_SERVER_ERROR           = 500;
    const CODE_SERVER_NOT_IMPLEMENTED                 = 501;
    const CODE_SERVER_BAD_GATEWAY                     = 502;
    const CODE_SERVER_SERVICE_UNAVAILABLE             = 503;
    const CODE_SERVER_GATEWAY_TIMEOUT                 = 504;
    const CODE_SERVER_HTTP_VERSION_NOT_SUPPORTED      = 505;
    const CODE_SERVER_VARIANT_ALSO_NEGOTIATES         = 506;
    const CODE_SERVER_INSUFFICIENT_STORAGE            = 507;
    const CODE_SERVER_LOOP_DETECTED                   = 508;
    const CODE_SERVER_NOT_EXTENDED                    = 510;
    const CODE_SERVER_NETWORK_AUTHENTICATION_REQUIRED = 511;

    private array $headers = [];
    private string $body = "";
    private int $responseCode = self::CODE_SUCCESS_OK;

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    public function setResponseCode(int $responseCode): void
    {
        $this->responseCode = $responseCode;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function addHeaders(array|string $headers): self
    {
        if(is_string($headers))
        {
            $this->headers[] = $headers;
        }
        else
        {
            $this->headers = array_merge($this->headers, $headers);
        }

        return $this;
    }

    /**
     * Don't use unless you know what you're doing!
     */
    public function applyHeaders(): void
    {
        foreach ($this->headers as $header)
        {
            header($header);
        }
    }
}
