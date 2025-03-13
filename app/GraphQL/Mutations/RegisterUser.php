<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\ValidationMessages\Fa;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // اضافه کردن این خط

final readonly class RegisterUser
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver
        $validator = Validator::make(
            data:$args['input'],
            rules:[
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required' ,
            ],
            messages:Fa::getAllErrorMessage(),
            );
        if ($validator->fails()) {
            return [
                "success" => false ,
                "message" => $validator->errors()->all() ,
                "user" => null ,
            ];
        }
        
        $user = User::create([
            'name' => $args['input']['name'],
            'email' => $args['input']['email'],
            'password' =>Hash::make($args['input']['password']),
        ]);

        return [
            "success" => true ,
            "message" => ['User Register successfully'] ,
            "user" => $user , 
        ];

    }
}



/////////////////////////////////////////////////
        /*
        try {
        } catch (\Exception $e) {
            return [
                "success" => false,
                "message" => ['An error occurred while registering the user. Please try again later.'],
                "user" => null,
            ];
        }
        */
        //////////////////////////////////////////////////