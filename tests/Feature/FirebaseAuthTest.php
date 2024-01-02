<?php

namespace Tests\Feature;


use PHPUnit\Framework\TestCase;
use FirebaseAuth\CustomValidator;


class FirebaseAuthTest extends TestCase
{
    const CORRECT_EMAIL= 'abc.xyz@exmple.com';
    const DISPLAY_NAME = 'abc xyz';
    const INCORRECT_EMAIL= 'abc.xyz';
    const EMPTY_DISPLAY_NAME = '';


    /**
     * To test if email address is valid.
     * And display name is not empty
     */
    public function test_user_can_register():void
    {
        $this->assertTrue(CustomValidator::validateEmail(self::CORRECT_EMAIL));
        $this->assertTrue(CustomValidator::validateName(self::DISPLAY_NAME));
       
    }
    /**
     * To test if email address is not valid.
     * And display name is empty
     */
    public function test_user_can_not_register(): void
    {
        $this->assertFalse(CustomValidator::validateEmail(self::INCORRECT_EMAIL));
        $this->assertFalse(CustomValidator::validateName(self::EMPTY_DISPLAY_NAME));
    }
   
}
