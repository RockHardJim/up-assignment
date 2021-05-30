<?php
namespace App\kernel;

/**
 * Class Session, why i have to write this while we have laravel defeats me but this ensures we have secure encrypted session handling code in the platform
 * @package App\kernel
 */
class Session{

    public function __construct()
    {
        if (! extension_loaded('openssl')) {
            throw new \RuntimeException("You need the OpenSSL extension to use UP-Gamerz script");
        }
        if (! extension_loaded('mbstring')) {
            throw new \RuntimeException("You need the multibytes extension to use UP-Gamerz script");
        }
    }


    /**
     * Encrypts session data using AES256 good measure to thwart session hijacks
     * @param $data
     * @param $key
     * @return string
     * @throws \Exception
     */
    private function encrypt_session($data, $key)
    {
        $iv = random_bytes(16); // AES block size in CBC mode
        // Encryption
        $ciphertext = openssl_encrypt(
            $data,
            'AES-256-CBC',
            mb_substr($key, 0, 32, '8bit'),
            OPENSSL_RAW_DATA,
            $iv
        );
        // Authentication
        $hmac = hash_hmac(
            'SHA256',
            $iv . $ciphertext,
            mb_substr($key, 32, null, '8bit'),
            true
        );
        return $hmac . $iv . $ciphertext;
    }

    /**
     * Decrypts session data using AES256 good measure to thwart session hijacks
     * @param $data
     * @param $key
     * @return string
     * @throws \Exception
     */
    protected function decrypt_session($data, $key)
    {
        $hmac       = mb_substr($data, 0, 32, '8bit');
        $iv         = mb_substr($data, 32, 16, '8bit');
        $ciphertext = mb_substr($data, 48, null, '8bit');
        // Authenticate
        $hmacNew = hash_hmac(
            'SHA256',
            $iv . $ciphertext,
            mb_substr($key, 32, null, '8bit'),
            true
        );
        if (!hash_equals($hmac, $hmacNew)) {
            throw new \RuntimeException('Session Keys Could Not Authenticate');
        }
        // Decrypt
        return openssl_decrypt(
            $ciphertext,
            'AES-256-CBC',
            mb_substr($key, 0, 32, '8bit'),
            OPENSSL_RAW_DATA,
            $iv
        );
    }

    /**
     * retrieves encryption keys stored within a secured cookie
     * @throws \Exception
     */
    private function get_encryption_keys($name)
    {
        if (empty($_COOKIE[$name])) {
            $key         = random_bytes(64); // 32 for encryption and 32 for authentication
            $cookieParam = session_get_cookie_params();
            $encKey      = base64_encode($key);
            setcookie(
                $name,
                $encKey,
                // if session cookie lifetime > 0 then add to current time
                // otherwise leave it as zero, honoring zero's special meaning
                // expire at browser close.
                ($cookieParam['lifetime'] > 0) ? time() + $cookieParam['lifetime'] : 0,
                $cookieParam['path'],
                $cookieParam['domain'],
                $cookieParam['secure'],
                $cookieParam['httponly']
            );
            $_COOKIE[$name] = $encKey;
        } else {
            $key = base64_decode($_COOKIE[$name]);
        }
        return $key;
    }
}