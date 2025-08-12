<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::query();

        if(request()->query('name')){
            $categories->where('name', 'like', '%' . request('name') . '%');
        }
        if(request()->query('status')){
            $categories->where('status', request('status'));
        }

        $categories = $categories->paginate(2);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Category::create($request->all());

       $data = $request->validate($this->validateRules(null));



        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('categories',[
                'disk' => 'public'
            ]);
        }

        //Str::slug($data['name']);

        $data['slug'] = str_replace(' ', '-', $data['name']);
        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Category Created Successfully');
    }

    public function edit(Category $category)
    {


        $categories = Category::where('id', '!=', $category->id)
            ->where(function ($query) use ($category) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '!=', $category->id);
            })
            ->get();
       /// dd($categories);
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate($this->validateRules($category->id));
        $old_path = $category->image;

      //  dd($old_path);
        $data['slug'] = Str::slug($data['name']);

          if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('categories',[
                'disk' => 'public'
            ]);
        }

        //dd($data);

        $category->update($data);

        if($request->hasFile('image')){
            Storage::disk('public')->delete($old_path);
        }
        return redirect()->route('categories.index')->with('info', 'Category Updated Successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('danger', 'Category Deleted Successfully');
    }

    private function validateRules($id){
        return [
            'name' => ['required', 'min:3', 'string', 'max:255', Rule::unique('categories')->ignore($id)],
            'image' => ['nullable', 'image','max:10240000'],
            'description' => ['required', 'min:3', 'string', 'max:255'],
            'status'  => ['required', 'in:active,archived'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ];
    }
}
