<?php

namespace App\GraphQL\Mutations;

use App\Models\Book;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL as FacadesGraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteBookMutation extends Mutation
{
    protected $attribute = [
        'name' => 'deleteBook',
        'description' => 'Delete a book'
    ];

    public function type(): Type
    {
        return Type::boolean();
        // return FacadesGraphQL::type('Book');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ]
            ];
    }

    public function resolve($root, $args)
    {
        $book = Book::findOrFail($args['id']);
// return $book;
        // return $book->delete() ? true : false;
        $res = $book->delete();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

}
