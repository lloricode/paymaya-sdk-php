<?php

declare(strict_types=1);

namespace Lloricode\Paymaya;

use Lloricode\Paymaya\Enums\Environment;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\Traits\Plugins\HasTimeout;

class PaymayaConnector extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use HasTimeout;

    protected int $connectTimeout = 60;

    protected int $requestTimeout = 120;

    public ?int $tries = 3;

    public ?int $retryInterval = 500;

    public ?bool $useExponentialBackoff = true;

    public function __construct(
        private readonly Environment $environment,
        private readonly string $token
    ) {}

    public function resolveBaseUrl(): string
    {
        return $this->environment->url();
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator(base64_encode($this->token), 'Basic');
    }

    public static function makeWithSecretKey(): self
    {
        return new self(Constant::$environment, Constant::$secretKey);
    }

    public static function makeWithPublicKey(): self
    {
        return new self(Constant::$environment, Constant::$publicKey);
    }
}
