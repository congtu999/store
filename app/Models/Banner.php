<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'event', 'image'
    ];

    public function getAllBanner()
    {
        return Banner::all();
    }

    public function addBanner($data)
    {
        return Banner::create($data);
    }

    public function getDetail($id)
    {
        $bannerDetail = DB::table('banners')
            ->select('id', 'name', 'event', 'image')
            ->where('id', '=', $id)
            ->get();

        return $bannerDetail;
    }

    public function updateBanner($request, $id)
    {
        $file = $request->file('hinhanh4');
        if ($file != null) {
            return DB::table('banners')
                ->where('id', '=', $id)
                ->update([
                    'name' => $request->input('name'),
                    'event' => $request->input('event'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        } else {
            return DB::table('banners')
                ->where('id', '=', $id)
                ->update([
                    'name' => $request->input('name'),
                    'event' => $request->input('event'),
                    'image' => $request->input('hinhanh4'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }

    public function deleteBanner($id)
    {
        return DB::table('banners')
            ->where('id', '=', $id)
            ->delete();
    }
}
