<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;

class ScheduleValidatorTest extends TestCase
{
    /**
     * 
     * @test
     * @dataProvider customerAllowedDataProvider()
     */
    public function validateSendData($specialty_id, $professional_id, $source_id, $birthdate, $expectedValidate)
    {
        $schedule = new Schedule;
        $data = [
            'specialty_id' => $specialty_id,
            'professional_id' => $professional_id,
            'name' => 'Nome de Teste',
            'cpf' => '798.456.444-56',
            'source_id' => $source_id,
            'birthdate' => $birthdate,
            'status' => 1
        ];

        $validator = Validator::make($data, $schedule->getRules());

        $this->assertEquals($expectedValidate, !$validator->fails());
    }

    public function customerAllowedDataProvider()
    {
        return [
            'shouldBeValidWhenAllDataIsValid' => [
                'specialty_id' => 183,
                'professional_id' => 165,
                'source_id' => 56,
                'birthdate' => '1981-12-05',
                'expectedValidate' => true
            ],
            'shouldBeNotValidWhenSpecialtyIsEmpty' => [
                'specialty_id' => '',
                'professional_id' => 165,
                'source_id' => 56,
                'birthdate' => '1981-12-05',
                'expectedValidate' => false
            ],
            'shouldBeNotValidWhenProfessionalIsEmpty' => [
                'specialty_id' => 183,
                'professional_id' => '',
                'source_id' => 56,
                'birthdate' => '1981-12-05',
                'expectedValidate' => false
            ],
            'shouldBeNotValidWhenSourceIsEmpty' => [
                'specialty_id' => 183,
                'professional_id' => 165,
                'source_id' => '',
                'birthdate' => '1981-12-05',
                'expectedValidate' => false
            ],
            'shouldBeNotValidWhenBirthdateIsNotAValidDate' => [
                'specialty_id' => 183,
                'professional_id' => 165,
                'source_id' => 55,
                'birthdate' => '44564-444444',
                'expectedValidate' => false
            ],
        ];
    }
}
