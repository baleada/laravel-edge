<?php

namespace Baleada;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Edge extends Model
{
    public $fillable = [
        'from_kind',
        'from',
        'kind',
        'to_kind',
        'to',
        'profile',
    ];

    protected $casts = [
        'profile' => 'json',
    ];

    public function scopeFrom(Builder $query, string $fromKind, string $fromId = null): Builder
    {
        return $fromId
            ? $query->where('from_kind', $fromKind)->where('from', $fromId)
            : $query->where('from_kind', $fromKind);
    }

    public function scopeFromIn(Builder $query, array $fromKinds): Builder
    {
        return $query->whereIn('from_kind', $fromKinds);
    }

    public function scopeFromNotIn(Builder $query, array $fromKinds): Builder
    {
        return $query->whereNotIn('from_kind', $fromKinds);
    }

    public function scopeOrFrom(Builder $query, string $fromKind, string $fromId = null): Builder
    {
        return $fromId
            ? $query->orWhere('from_kind', $fromKind)->where('from', $fromId)
            : $query->orWhere('from_kind', $fromKind);
    }

    public function scopeOrFromIn(Builder $query, array $fromKinds): Builder
    {
        return $query->orWhereIn('from_kind', $fromKinds);
    }

    public function scopeOrFromNotIn(Builder $query, array $fromKinds): Builder
    {
        return $query->orWhereNotIn('from_kind', $fromKinds);
    }

    public function scopeTo(Builder $query, string $toKind, string $toId = null): Builder
    {
        return $toId
            ? $query->where('to_kind', $toKind)->where('to', $toId)
            : $query->where('to_kind', $toKind);
    }

    public function scopeToIn(Builder $query, array $toKinds): Builder
    {
        return $query->whereIn('to_kind', $toKinds);
    }

    public function scopeToNotIn(Builder $query, array $toKinds): Builder
    {
        return $query->whereNotIn('to_kind', $toKinds);
    }

    public function scopeOrTo(Builder $query, string $toKind, string $toId = null): Builder
    {
        return $toId
            ? $query->orWhere('to_kind', $toKind)->where('to', $toId)
            : $query->orWhere('to_kind', $toKind);
    }

    public function scopeOrToIn(Builder $query, array $toKinds): Builder
    {
        return $query->orWhereIn('to_kind', $toKinds);
    }

    public function scopeOrToNotIn(Builder $query, array $toKinds): Builder
    {
        return $query->orWhereNotIn('to_kind', $toKinds);
    }

    public function scopeKind(Builder $query, string $operatorOrKind, string $kind): Builder
    {
        return $query->where('kind', $operatorOrKind, $kind);
    }

    public function scopeKindIn(Builder $query, array $kinds): Builder
    {
        return $query->whereIn('kind', $kinds);
    }
    
    public function scopeKindNotIn(Builder $query, array $kinds): Builder
    {
        return $query->whereNotIn('kind', $kinds);
    }

    public function scopeOrKind(Builder $query, string $operatorOrKind, string $kind): Builder
    {
        return $query->orWhere('kind', $operatorOrKind, $kind);
    }

    public function scopeOrKindIn(Builder $query, array $kinds): Builder
    {
        return $query->orWhereIn('kind', $kinds);
    }

    public function scopeOrKindNotIn(Builder $query, array $kinds): Builder
    {
        return $query->orWhereNotIn('kind', $kinds);
    }

    public function scopeProfile(Builder $query, string $key, string $value): Builder
    {
        return $query->whereJsonContains("profile->${key}", $value);
    }

    public function scopeProfileNot(Builder $query, string $key, string $value): Builder
    {
        return $query->whereJsonDoesntContain("profile->${key}", $value);
    }

    public function scopeProfileKey(Builder $query, string $key): Builder
    {
        return $query->whereJsonContainsKey('profile', $key);
    }

    public function scopeProfileKeyNot(Builder $query, string $key): Builder
    {
        return $query->whereJsonDoesntContainKey('profile', $key);
    }

    public function scopeProfileOverlaps(Builder $query, string $key, array $values): Builder
    {
        return $query->whereJsonOverlaps("profile->${key}", $values);
    }

    public function scopeProfileDoesntOverlap(Builder $query, string $key, array $values): Builder
    {
        return $query->whereJsonDoesntOverlap("profile->${key}", $values);
    }

    public function scopeProfileLength(Builder $query, string $key, int $length): Builder
    {
        return $query->whereJsonLength("profile->${key}", $length);
    }

    public function scopeOrProfile(Builder $query, string $key, string $value): Builder
    {
        return $query->orWhereJsonContains("profile->${key}", $value);
    }

    public function scopeOrProfileNot(Builder $query, string $key, string $value): Builder
    {
        return $query->orWhereJsonDoesntContain("profile->${key}", $value);
    }

    public function scopeOrProfileKey(Builder $query, string $key): Builder
    {
        return $query->orWhereJsonContainsKey('profile', $key);
    }

    public function scopeOrProfileKeyNot(Builder $query, string $key): Builder
    {
        return $query->orWhereJsonDoesntContainKey('profile', $key);
    }

    public function scopeOrProfileOverlaps(Builder $query, string $key, array $values): Builder
    {
        return $query->orWhereJsonOverlaps("profile->${key}", $values);
    }

    public function scopeOrProfileDoesntOverlap(Builder $query, string $key, array $values): Builder
    {
        return $query->orWhereJsonDoesntOverlap("profile->${key}", $values);
    }

    public function scopeOrProfileLength(Builder $query, string $key, int $length): Builder
    {
        return $query->orWhereJsonLength("profile->${key}", $length);
    }
}
