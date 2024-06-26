<?php

namespace Baleada\Edge;

use Illuminate\Database\Migrations\Migration as LaravelMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Migration extends LaravelMigration
{
    protected $table = 'edges';
    protected $types = [];

    public function up(): void
    {
        $types = [
            'id' => 'id',
            'from_kind' => 'string',
            'from' => 'integer',
            'kind' => 'string',
            'to_kind' => 'string',
            'to' => 'integer',
            ...$this->types,
        ];

        Schema::create($this->table, function (Blueprint $table) use ($types) {
            $table->{$types['id']}('id');
            $table->{$types['from_kind']}('from_kind');
            $table->{$types['from']}('from');
            $table->{$types['kind']}('kind');
            $table->{$types['to_kind']}('to_kind');
            $table->{$types['to']}('to');
            $table->json('profile');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
