<?php

namespace App\GraphQL\Mutations;

use App\Models\Book;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateBookMutation extends Mutation
{
    protected $attribute = [
        'name' => 'updateBook'
    ];

    public function type(): Type
    {
        return GraphQL::type('Book');
    }

    public function args(): array
    {
        return [
                'id' => [
                    'name' => 'id',
                    'type' => Type::nonNull(Type::int())
                ],
                'title' => [
                    'name' => 'title',
                    'type' => Type::nonNull(Type::string())
                ],
                'author' => [
                    'name' => 'author',
                    'type' => Type::nonNull(Type::string())
                ],
                'language' => [
                    'name' => 'language',
                    'type' => Type::nonNull(Type::string())
                ],
                'year_published' => [
                    'name' => 'year_published',
                    'type' => Type::nonNull(Type::string())
                ],
                'isbn' => [
                    'name' => 'isbn',
                    'type' => Type::nonNull(Type::string())
                ]

            ];
    }

    public function resolve($root, $args)
    {
        $book = Book::findOrFail($args['id']);
        $book->fill($args);
        $book->save();

        return $book;
    }
}
