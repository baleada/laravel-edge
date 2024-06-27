<?php

namespace Baleada\Edge;

use Illuminate\Database\Migrations\Migration as LaravelMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Migration extends LaravelMigration
{
    protected $table = 'edges';
    protected function types()
    {
        return [];
    }

    private $defaultTypes = [
        'id' => 'id',
        'from_kind' => 'string',
        'from' => 'integer',
        'kind' => 'string',
        'to_kind' => 'string',
        'to' => 'integer',
    ];

    private function toTypes(array $types): array
    {
        return collect($types)
            ->map(fn ($config) => is_string($config) ? [$config] : $config)
            ->toArray();
    }

    public function up(): void
    {
        $types = $this->toTypes([
            ...$this->defaultTypes,
            ...$this->types(),
        ]);

        Schema::create(
            $this->table,
            function (Blueprint $table) use ($types) {
                foreach ($types as $column => $config) {
                    $type = array_shift($config);
                    $table->$type($column, ...$config);
                }
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
