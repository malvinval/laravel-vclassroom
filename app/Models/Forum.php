<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function classroom() {
        return $this->belongsTo(
            Classroom::class
        );
    }

    public function forumTeacherAttachmentFile() {
        return $this->hasMany(
            ForumTeacherAttachmentFile::class
        );
    }
}
