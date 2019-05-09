<?php

namespace App\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class JWTAuthenticationSuccessListener implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return ['lexik_jwt_authentication.on_authentication_success' => 'onJWTAuth'];
    }

    /**
     * @param JWTCreatedEvent $event
     */
    public function onJWTAuth(AuthenticationSuccessEvent $event)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $payload = $event->getData();
        $payload['id'] = $user->getId();

        $event->setData($payload);
    }
}
