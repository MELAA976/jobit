<?php

namespace App\Security\Voter;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class OffreVoter extends Voter
{
    public const EDIT_OFFRE = 'EDIT_OFFRE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT_OFFRE])
            && $subject instanceof \App\Entity\PublicaOffre;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        //dd($user);
        //dd($subject->getUser()->getId());


        switch ($attribute) {
            case self::EDIT_OFFRE:

                return $this->canEditPubli($subject, $user);
                break;

                /*case self::VIEW:
                break;*/
        }

        return false;
    }

    private function canEditPubli($publica, $user)
    {
        return $publica->getUser()->getId() === $user->getId() && $this->security->isGranted('ROLE_RECRUTEUR');
    }
}
