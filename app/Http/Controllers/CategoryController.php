<?php

namespace App\Http\Controllers;

use App\Models\Fact;
use App\Models\Company;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    
    public function index(Request $request, Company $company)
    {
        return Category::where('company_id', $company->id)->get();
    }
    public function grouped(Request $request, Company $company)
    {
        
        $cat = Category::query();
        $cat->where('company_id', $company->id);
        $cat->tree();
        
        return $cat->get()->groupBy('type');
    }
    
    public function show($id)
    {   
        $category = Category::query();
        $category->tree();
        $category->where('id', $id);
        $category->withCount(['descendants']);
        $category->with(['descendants' => function($query) {
            $query->with('facts');
        }]);
        $category->with('facts');
        $category->with('childrenFacts');
        return $category->first();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'format' => 'required',
            // 'account' => 'numeric',
            'company_id' => 'required',
            // 'parent_id' => 'required',
            'group_id' => 'required',
            'type' => 'required',
            // 'sort' => 'required',
        ]);

        if($request->id != null){
            $category = Category::where('id', $request->id)->first();
            // return $category;
            return $this->update($request, $category);
        }

        $category = [
            'name' => $request->name,
            'format' => $request->format,
            'account' => $request->account,
            'company_id' => $request->company_id,
            'parent_id' => $request->parent_id,
            'group_id' => $request->group_id,
            'type' => $request->type,
            'sort' => $request->sort,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // return $category;

        $stored = Category::create($category);
        if($stored){
            return new JsonResponse(['message' => 'New Category Added', 'category' => $stored], 201);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);


        return 'store';
    }

    public function update(Request $request, Category $category)
    {           
        $update = [
            'name' => $request->name,
            'format' => $request->format,
            'account' => $request->account,
            'parent_id' => $request->parent_id,
            'group_id' => $request->group_id,
            'type' => $request->type,
            'sort' => $request->sort,
            'updated_at' => now(),
        ];

        $updated = Category::where('id', $category->id)->update($update);
        if($updated){
            $categoryRet = $this->show($category->id);
            return new JsonResponse(['message' => 'Category Updated', 'category' => $categoryRet], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();
        $deleted = $category->delete();
        if($deleted){
            return new JsonResponse(['message' => 'Category Deleted'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }
    
    public function tree(Request $request, Company $company, $type, $tree = false)
    {   
        $categories = Category::query();
        $categories->where('company_id', $company->id);
        $categories->where('type', $type);
        $categories->tree();
        $categories->orderBy('sort', 'asc');
        if($tree){
            return $categories->get()->toTree();
        }
        return $categories->get();
    }

    public function sort(Request $request)
    {
        $sort = $request->all();
        foreach ($sort as $key => $value) {
            Category::where('id', $value['id'])->update(['sort' => $key]);
        }
        return new JsonResponse(['message' => 'Sort Completed'], 200);
    }
    
    public function accounts(Request $request, Company $company)
    {
        $categories = Category::query();
        $categories->where('company_id', $company->id);
        $categories->isLeaf();
        return $categories->get();
    }

    public function report(Request $request, Company $company, $type, $year, $depth)
    {
        $af = $request->forecast ? 'forecast' : 'actual';
        $report = Category::query();
        $report->where('company_id', $company->id);
        $report->where('type', $type);
        $report->where('depth', $depth);
        $report->depthFirst();
        $report->tree();
        $report->with(['factsOffspring' => function($query) use ($af, $company, $year, $type){
            $query->where('company_id', $company->id);
            $query->whereYear('facts.date', $year);
            $query->where('section', $af);
        }]);
        $report->orderBy('sort');
        return $report->get()->makeHidden(['facts','facts_offspring']);;
    }

    protected function groupsTree($company_id, $id, $type)
    {   
        $categories = Category::query();
        $categories->where('company_id', $company_id);
        $categories->where('group_id', $id);
        $categories->where('type', $type);
        $categories->tree();
        $categories->orderBy('sort', 'asc');
        // $categories->take(3);
        return $categories->get()->toTree();
        return $categories->get();
    }

    public function groups(Request $request, Company $company, $type)
    {
        
        $groups = Group::where('type', $type)->get();

        $categories = [];

        foreach ($groups as $key => $group) {
            $categories[$key] = $group;
            $categories[$key]['label'] = $group->name;
            $categories[$key]['children'] = $this->groupsTree($company->id, $group->id, $type);
        }

        return $categories;

    }

    public function parentable(Request $request, Company $company)
    {
        $categories = Category::query();
        $categories->tree();
        $categories->where('company_id', $company->id);
        $categories->where('depth', '!=', 2);
        return $categories->get()->groupBy('group_id');
    }
    public function leaves(Request $request, Company $company, $type)
    {   
        $categories = Category::query();
        $categories->where('company_id', $company->id);
        $categories->where('type', $type);
        $categories->tree();
        $categories->isLeaf();
        $categories->take(5);
        return $categories->get();
    }
}
