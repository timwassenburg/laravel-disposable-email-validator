<?php

namespace TimWassenburg\DisposableEmailValidator\Services;

/**
 * Class DisposableEmailService.
 */
class DisposableEmailService
{
    public function getDomainFromEmailAddress(string $email): string
    {
        $value = explode('@', strtolower($email));

        return array_pop($value);
    }

    public function isDisposableDomain(string $domain): bool
    {
        $disposableDomains = config('disposable-email.domains');

        return ! in_array($domain, $disposableDomains);
    }
}
