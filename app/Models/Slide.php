<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Slide extends Model
{


    use HasFactory;


    public function getAllSlide()
    {
        return Slide::paginate(8);
    }

    public function addSlide($data)
    {

        return DB::table('slides')
            ->insert($data);
    }

    public function getDetail($id)
    {
        return DB::table('slides')
            ->select('id', 'image')
            ->where('id', '=', $id)
            ->get();
    }

    public function updateSlide($request, $id)
    {
        $file = $request->file('hinhanh4');
        if ($file != null) {
            return DB::table('slides')
                ->where('id', '=', $id)
                ->update([
                    'updated_at' => date('Y-m-d H:i:s')]);
        } else {
            return DB::table('slides')
                ->where('id', '=', $id)
                ->update([
                    'image' => $request->hinhanh4,
                    'updated_at' => date('Y-m-d H:i:s')]);
        }

    }

    public function deleteSlide($id)
    {
        return DB::table('slides')
            ->where('id', '=', $id)
            ->delete();
    }
}
