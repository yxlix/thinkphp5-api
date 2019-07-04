<?php

/*
 * jwt配置
 * iss (issuer)：签发人
 * exp (expiration time)：过期时间
 * sub (subject)：主题
 * aud (audience)：受众
 * nbf (Not Before)：生效时间
 * iat (Issued At)：签发时间
 * jti (JWT ID)：编号
 */
$privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQC9nAah9kik7tnjkVu5EwfAcAYwsvJt8y0LuJ8l0MzNFir9TGFj
GNH9unn5mb8DyFCJ8KysId5sqyOLp0WBvqJINcvUvYhCvgBaNYzbh3Nln2ELU78r
sqLQV6wCO8+OwaKI4WPMI6sluMCzyfSO+XLCGyK+Sp/cv0gRJYv9OqftvwIDAQAB
AoGAHOuLZ3C1K9LykO8+2j+40vVDPHJO385TdJI4VABA/JcA/5mC0SacAONMb3Gv
3NfU0PVQoQCZeGGyDj75Lwzwm2e6/ZK89Jm0pKf2uSnkwvPYs4gtBLPyX2y0PVRi
jPKkX46efIa60IYyyOcVPBhll33YCcv1sP5VG8hw0LzejcECQQDjccUgAwVlW/nX
JrJ0iMQTk45rE6aYT/sF9wt1mEF/vw7a1A3PpGD0kL1Msc845P7tzzLUaBtXhAS6
Tq4nmFm3AkEA1Wo2md7KPKTUAlINmpn9AqShQMFRPjOa2VjrfWIwv4zBWbD0y7HC
/7kngrzhNWVNE7pnm4T4uQzUckrnQjOsOQJBAIzgfjnqxR/YDXM/S8+0msaJYfBe
1pSHDbPPJjDrYr6Oh9Pw/rD7XvZ85FOp2vGhnWmNKi24Yh8d7ZO8glCSJBcCQEF4
UQHJOA98nVGM7IF2JgkOii18YLkNSb7NqYiQe9X3j0U9pQtsIB8lJPrViN1Bk3Cu
6aPrGgZi6jWZxvInOfkCQQC9imAHcipzH8+7ZvicdI6/wncwaX54Dy3PpJ52Hyxy
doTG72h0J+VWebd45EJvb4HH/XYSeyXFldUq0d1olgUb
-----END RSA PRIVATE KEY-----
EOD;

$publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC9nAah9kik7tnjkVu5EwfAcAYw
svJt8y0LuJ8l0MzNFir9TGFjGNH9unn5mb8DyFCJ8KysId5sqyOLp0WBvqJINcvU
vYhCvgBaNYzbh3Nln2ELU78rsqLQV6wCO8+OwaKI4WPMI6sluMCzyfSO+XLCGyK+
Sp/cv0gRJYv9OqftvwIDAQAB
-----END PUBLIC KEY-----
EOD;


return [
    "privateKey" => $privateKey,
    "publicKey" => $publicKey,
    "token" => [
        "iss" => "example.org",
        "aud" => "example.com",
        "iat" => time(),
        "nbf" => time(),
        "exp" => time() + 3600 * 30 * 24
    ]
];



