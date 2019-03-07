<?php

namespace AlibabaCloud\Client\Clients;

use AlibabaCloud\Client\Credentials\AccessKeyCredential;
use AlibabaCloud\Client\Credentials\BearerTokenCredential;
use AlibabaCloud\Client\Credentials\CredentialsInterface;
use AlibabaCloud\Client\Credentials\EcsRamRoleCredential;
use AlibabaCloud\Client\Credentials\RamRoleArnCredential;
use AlibabaCloud\Client\Credentials\RsaKeyPairCredential;
use AlibabaCloud\Client\Credentials\StsCredential;
use AlibabaCloud\Client\Request\Request;
use AlibabaCloud\Client\Signature\SignatureInterface;
use AlibabaCloud\Client\Traits\HttpTrait;
use AlibabaCloud\Client\Traits\RegionTrait;

/**
 * Custom Client.
 *
 * @package   AlibabaCloud\Client\Clients
 */
class Client
{
    use HttpTrait;
    use RegionTrait;
    use ManageTrait;

    /**
     * @var CredentialsInterface|AccessKeyCredential|BearerTokenCredential|StsCredential|EcsRamRoleCredential|RamRoleArnCredential|RsaKeyPairCredential
     */
    private $credential;

    /**
     * @var SignatureInterface
     */
    private $signature;

    /**
     * Self constructor.
     *
     * @param CredentialsInterface $credential
     * @param SignatureInterface   $signature
     */
    public function __construct(CredentialsInterface $credential, SignatureInterface $signature)
    {
        $this->credential                 = $credential;
        $this->signature                  = $signature;
        $this->options['connect_timeout'] = Request::CONNECT_TIMEOUT;
        $this->options['timeout']         = Request::TIMEOUT;
    }

    /**
     * @return AccessKeyCredential|BearerTokenCredential|CredentialsInterface|EcsRamRoleCredential|RamRoleArnCredential|RsaKeyPairCredential|StsCredential
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * @return SignatureInterface
     */
    public function getSignature()
    {
        return $this->signature;
    }
}
