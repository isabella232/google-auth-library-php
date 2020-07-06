<?php
/*
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace Google\Auth\SignBlob;

use Google\Auth\OAuth2;

/**
 * Sign a string using a Service Account private key.
 */
trait PrivateKeySignBlobTrait
{
    /**
     * Sign a string using the service account private key.
     *
     * @param string $stringToSign
     * @param string $privateKey
     * @return string
     * @throws \RuntimeException
     */
    private function signBlobWithPrivateKey(
        string $stringToSign,
        string $privateKey
    ): string {
        if (!extension_loaded('openssl')) {
            throw new \RuntimeException('OpenSSL is not installed.');
        }
        $signedString = '';
        openssl_sign($stringToSign, $signedString, $privateKey, 'sha256WithRSAEncryption');

        return base64_encode($signedString);
    }
}
