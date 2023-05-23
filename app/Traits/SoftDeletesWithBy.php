<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

//Status 1 = Activated; Status 99 = Deleted
trait SoftDeletesWithBy {
    use SoftDeletes {
        SoftDeletes::runSoftDelete as parentRunSoftDelete;
        SoftDeletes::restore as parentRestore;
    }

    public function getDeletedByColumn() {
        return defined(static::class.'::DELETED_BY') ? static::DELETED_BY : 'deleted_by';
    }

    public function runSoftDelete() {
        $this->parentRunSoftDelete();
        $query = $this->newQueryWithoutScopes()->where($this->getKeyName(), $this->getKey());
        $columns = [$this->getDeletedByColumn() => Auth::id()];
        $this->{$this->getDeletedByColumn()} = Auth::id();
        $query->update($columns);
    }

    public function restore() {
        $result = $this->parentRestore();
        $this->{$this->getDeletedByColumn()} = null;
        $this->save();
        return $result;
    }
}
