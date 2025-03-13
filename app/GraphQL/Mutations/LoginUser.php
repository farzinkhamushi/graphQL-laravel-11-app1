<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\ValidationMessages\Fa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // اضافه کردن این خط
use App\Models\User;

final readonly class LoginUser
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver
        $validator = Validator::make(
            data:$args['input'],
            rules:[
                'email' => 'required|email|exists:users,email',
                'password' => 'required' ,
            ],
            messages:Fa::getAllErrorMessage(),
            );

        if ($validator->fails()) {
            return [
                "success" => false ,
                "message" => $validator->errors()->all() ,
                "token" => null ,
                "user" => null ,
            ];
        }
        
        $user = User::whereEmail($args['input']['email'])->first();

        if (!$user) {
            return [
                "success" => false,
                "message" => ['Invalid Email or Password'],
                "token" => null,
                "user" => null,
            ];
        }

        
        if (!Hash::check($args['input']['password'], $user->password)) {
            return [
                "success" => false,
                "message" => ['Invalid Password'],
                "token" => null,
                "user" => null,
            ];
        }

        //$token = $user->createToken('auth_token')->plainTextToken;
        $token = $user->createToken('Api Token')->plainTextToken;
        
        return [
            "success" => true ,
            "message" => ['Login Successfully'] ,
            "token" => $token ,
            "user" => $user ,
        ];

    }
}
