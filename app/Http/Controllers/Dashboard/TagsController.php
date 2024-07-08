<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use DB;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }


    public function store(TagsRequest $request)
    {
        try {
            //return $request;
            DB::beginTransaction();
            $tag = Tag::create(['slug' => $request->slug]);
            $tag->name = $request->name;
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => __('admin\sidebar.success')]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.$tag')->with(['error' => __('admin\sidebar.error')]);
        }
    }


    public function edit($id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return redirect()->back()->with(['error' => __('admin\sidebar.this tag does not exist')]);
        }
        return view('dashboard.tags.edit', compact('tag'));
    }


    public function update($id, TagsRequest $request)
    {
        try {
           //return $request;
            DB::beginTransaction();
            $tag = Tag::find($id);
            if (!$tag) {
                return redirect()->route('admin.tags')->with(['error' => __('admin\sidebar.something went wrong, please contact your system administrator')]);
            }
            // return $request;
            $tag->update($request->except('_token', 'id'));
            $tag->name = $request->name;
            //dd($brand->name);
            //return $brand;
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => __('admin\sidebar.success')]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.tags')->with(['error' => __('admin\sidebar.error')]);
        }
    }


    public function destroy($id)
    {
        try {
            $tag = Tag::find($id);
            if (!$tag) {
                return redirect()->back()->with(['error' => __('admin\sidebar.this tag does not exist')]);
            }
            $tag->delete();
            return redirect()->route('admin.tags')->with(['error' => __('admin\sidebar.success')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.tags')->with(['error' => __('admin\sidebar.error')]);
        }
    }

    /*  public function changeStatus($id)
      {
          try {
              $maincategory = MainCategory::find($id);
              if (!$maincategory)
                  return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

              $status =  $maincategory -> active  == 0 ? 1 : 0;

              $maincategory -> update(['active' =>$status ]);

              return redirect()->route('admin.maincategories')->with(['success' => ' تم تغيير الحالة بنجاح ']);

          } catch (\Exception $ex) {
              return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
          }
      }*/
}
