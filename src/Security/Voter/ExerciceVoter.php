<?php

namespace App\Security\Voter;

use App\Entity\Exercice;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ExerciceVoter extends Voter
{
    const VIEW = 'view';

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['view'])
            && $subject instanceof \App\Entity\Exercice;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case SELF::VIEW:
                // logic to determine if the user can VIEW
                return $this->canView($subject, $user);
                break;
        }

        return false;
    }

    private function canView(Exercice $exercice, $user)
    {
        return $user === $exercice->getUser();
    }
}
