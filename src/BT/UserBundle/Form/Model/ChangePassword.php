<?php
/**
 * Created by PhpStorm.
 * User: Aleck
 * Date: 18/11/2017
 * Time: 12:38
 */

namespace BT\UserBundle\Form\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Mauvaise valeur pour le mot de passe actuel"
     * )
     */
    public $oldPassword;

    /**
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "Le mot de passe doit contenir au minimum 6 caractères"
     * )
     */
    public $newPassword;

    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @return mixed
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }
}