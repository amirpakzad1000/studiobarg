<?php

namespace studiobarg\Category\Repository;

use studiobarg\Category\Models\Category;

class categoryRepo
{
    public function store($values)
    {
        return Category::create([
            'title' => $values->title,
            'slug' => $values->slug,
            'parent_id' => $values->parent_id
        ]);
    } //End Method

    public function findById($id)
    {
        return Category::find($id);
    }//End Method

    public function allExceptById($id)
    {
        return $this->all()->filter(function ($category) use ($id) {
            return $category->id != $id;
        });
    }//End Method

    public function all()
    {
        return Category::all();
    }//End Method

    public function update($id, $values)
    {
        Category::where('id', $id)->update([
            'title' => $values->title,
            'slug' => $values->slug,
            'parent_id' => $values->parent_id
        ]);
    }//End Method

    public function delete($id)
    {
        Category::where('id', $id)->delete();
    }//End Method
}
