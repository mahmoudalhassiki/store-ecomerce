<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandsRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('dashboard.brands.create');
    }


    public function store(BrandsRequest $request)
    {
        try {
            //return $request;
            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
            $fileName = '';
            if ($request->has('photo')) {
                $fileName = uploadImage('brands', $request->photo);
            }
            $brand = Brand::create($request->except('_token', 'photo'));
            $brand->name = $request->name;
            $brand->photo = $fileName;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => __('admin\sidebar.success')]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error' => __('admin\sidebar.error')]);
        }
    }


    public function edit($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->back()->with(['error' => __('admin\sidebar.this brand does not exist')]);
        }
        return view('dashboard.brands.edit', compact('brand'));
    }


    public function update($id, BrandsRequest $request)
    {
        try {
           // return $request;
            DB::beginTransaction();
            $brand = Brand::find($id);
            if (!$brand) {
                return redirect()->route('admin.brands')->with(['error' => __('admin\sidebar.something went wrong, please contact your system administrator')]);
            }
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
            if ($request->has('photo')) {
                $fileName = uploadImage('brands', $request->photo);
                Brand::where('id', $id)->update(['photo' => $fileName]);
            }
            // return $request;
            $brand->update($request->except('_token', 'id', 'photo'));
            $brand->name = $request->name;
            //dd($brand->name);
            //return $brand;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => __('admin\sidebar.success')]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error' => __('admin\sidebar.error')]);
        }
    }


    public function destroy($id)
    {
        try {
            $brand = Brand::find($id);
            if (!$brand) {
                return redirect()->back()->with(['error' => __('admin\sidebar.this brand does not exist')]);
            }
            $brand->delete();
            return redirect()->route('admin.brands')->with(['error' => __('admin\sidebar.success')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => __('admin\sidebar.error')]);
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
