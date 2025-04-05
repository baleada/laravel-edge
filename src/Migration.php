<?php

namespace Baleada\Edge;

use Illuminate\Database\Migrations\Migration as LaravelMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

/**
 * [Docs](https://baleada.dev/docs/edge)
 */
class Migration extends LaravelMigration
{
    protected $table = 'edges';
    protected function columns()
    {
        return [];
    }

    private $defaultColumns = [
        'id' => 'id',
        'from_kind' => 'string',
        'from' => 'integer',
        'kind' => 'string',
        'to_kind' => 'string',
        'to' => 'integer',
    ];

    private function ensureCreateColumns(array $columns): Collection
    {
        return collect($columns)
            ->mapWithKeys(fn ($createColumn, $column) => [
                $column => is_string($createColumn)
                    ? fn (string $column, Blueprint $table) => $table->$createColumn($column)
                    : $createColumn,
            ]);
    }

    public function up(): void
    {
        $createColumns = $this->ensureCreateColumns([
            ...$this->defaultColumns,
            ...$this->columns(),
        ]);

        Schema::create(
            $this->table,
            function (Blueprint $table) use ($createColumns) {
                $createColumns->each(fn ($createColumn, $column) => $createColumn($column, $table));
                $table->json('profile');
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
