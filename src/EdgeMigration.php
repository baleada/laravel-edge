<?php

namespace Baleada;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EdgeMigration extends Migration
{
    protected $table = 'edges';

    private function id(Blueprint $table): void
    {
        $table->ulid('id');
    }

    private function fromKind(Blueprint $table): void
    {
        $table->string('from_kind');
    }

    private function from(Blueprint $table): void
    {
        $table->string('from');
    }

    private function kind(Blueprint $table): void
    {
        $table->string('kind');
    }

    private function toKind(Blueprint $table): void
    {
        $table->string('to_kind');
    }

    private function to(Blueprint $table): void
    {
        $table->string('to');
    }

    public function up(): void
    {
        Schema::create('edges', function (Blueprint $table) {
            $this->id($table);
            $this->fromKind($table);
            $this->from($table);
            $this->kind($table);
            $this->toKind($table);
            $this->to($table);
            $table->json('profile');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
