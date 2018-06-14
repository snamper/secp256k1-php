<?php

$context = secp256k1_context_create(SECP256K1_CONTEXT_SIGN | SECP256K1_CONTEXT_VERIFY);

// Private keys are never generated by secp256k1.
$privateKey = pack("H*", "abcdef0123456789abcdef0123456789abcdef0123456789abcdef0123456789");

/** @var resource $publicKey */
$publicKey = '';
$result = secp256k1_ec_pubkey_create($context, $publicKey, $privateKey);
if ($result === 1) {
    $compress = true;

    $serialized = '';
    if (1 !== secp256k1_ec_pubkey_serialize($context, $serialized, $publicKey, $compress)) {
        throw new \Exception('secp256k1_ec_pubkey_serialize: failed to serialize public key');
    }

    echo unpack("H*", $serialized)[1] . PHP_EOL;
} else {
    throw new \Exception('secp256k1_pubkey_create: secret key was invalid');
}