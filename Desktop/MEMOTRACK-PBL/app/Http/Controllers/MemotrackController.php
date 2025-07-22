<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemotrackController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel memotrack
        $data = DB::table('memotrack')->get();

        // Menampilkan data dalam bentuk JSON
        return response()->json($data);
    }
}
