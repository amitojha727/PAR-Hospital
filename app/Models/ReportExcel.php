<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportExcel extends Model
{
    use HasFactory;
    protected $table = 'report_excel_mast';
    protected $fillable = ['ex_a','ex_b','ex_c'];
}
