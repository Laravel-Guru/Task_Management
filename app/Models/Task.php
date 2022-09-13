<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function scopeWhereProject($q, $id) {
        $q->where('project_id', $id);
    }
}
