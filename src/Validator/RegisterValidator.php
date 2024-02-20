<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RegisterValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        /* @var  $constraint */

        if (null === $value || '' === $value) {
            return;
        }


        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
