<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;


final class AccesUserVoter extends Voter
{
    // Définition des constantes pour les différentes actions possibles

    public const VIEW = 'view'; //droit pour regarder une page
    public const EDIT = 'edit'; //droit pour regarder une ecrir ou modifier
    private const DELETE = 'delete'; //droit pour regarder et supprimer

    private $security;



    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::VIEW, self::EDIT, self::DELETE]);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        $idPage = intval($subject);



        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }


        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::VIEW: // cas pour regarder 

                return $this->canView($idPage, $user);
                break;

            case self::EDIT:
                break;
        }
        return false;
    }
    //methode qui retourne vrai si l'id de la page 
    //correspod a l'id de l'user connecter
    private function canView($idPage, $user)
    {
        return $idPage === $user->getId();
    }
}
