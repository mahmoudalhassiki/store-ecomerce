<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::parent()->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        //return view('admin.maincategories.create');
    }


    public function store(MainCategoryRequest $request)
    {

        try {

        } catch (\Exception $ex) {
        }

    }


    public function edit($id)
    {
        $category = Category::orderBy('id', 'DESC')->find($id);
        if (!$category) {
            return redirect()->back()->with(['error' => __('admin\sidebar.this category does not exist')]);
        }
        return view('dashboard.categories.edit', compact('category'));
    }


    public function update($id, MainCategoryRequest $request)
    {
        try {
            // return $request;
            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_Active' => 0]);
            } else {
                $request->request->add(['is_Active' => 1]);
            }
            $category = Category::find($id);
            if (!$category) {
                return redirect()->route('admin.maincategories')->with(['error' => __('admin\sidebar.something went wrong, please contact your system administrator')]);
            }
            $category->update($request->all());
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->route('admin.maincategories')->with(['success' => __('admin\sidebar.success')]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.maincategories')->with(['error' => __('admin\sidebar.error')]);
        }

    }


    public function destroy($id)
    {
        try {
            $category = Category::orderBy('id', 'DESC')->find($id);
            if (!$category) {
                return redirect()->back()->with(['error' => __('admin\sidebar.this category does not exist')]);
            }
            $category->delete();
            return redirect()->route('admin.maincategories')->with(['error' => __('admin\sidebar.success')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => __('admin\sidebar.error')]);
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
