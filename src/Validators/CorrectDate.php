<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 25.10.17
 * Time: 20:27
 */

namespace Validators;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CorrectDate extends Constraint
{
    public $message = '{{ date }} - Future Date';

    public function validateBy()
    {
        return 'validator.correctDate';
    }
}