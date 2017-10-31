<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 26.10.17
 * Time: 12:47
 */

namespace Validators;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\ConstraintValidator;

class CorrectDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $currDate = date("Y-m-d");
        if ($value->format('Y-m-d') >= $currDate) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ date }}', $value->format('Y-m-d'))
                ->addViolation();
        }
    }
}