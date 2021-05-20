<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category\Category;
use App\Model\Product\Product;

class ProductController extends Controller
{
    public function view($category, $sub_category = false, $sub_sub_category = false)
    {
        if ($sub_sub_category != false) {
            $categoryData = Category::where('category_slug', $sub_sub_category)->first();
        } elseif ($sub_category != false) {
            $categoryData = Category::where('category_slug', $sub_category)->first();
        } else {
            $categoryData = Category::where('category_slug', $category)->first();
        }
        try {
            $productData = Product::with(["category" => function ($query) {
                $query->join("categories", function ($join) {
                    $join->on("categories.category_id", "=", "product_category.category_id");
                });
                $query->select("product_category.category_id", "product_category.product_id", "categories.category_name");
            }])
                ->where(function ($query) use ($categoryData) {
                    $query->whereRaw('FIND_IN_SET(' . $categoryData->category_id . ', product_categories)');
                })
                ->where('out_of_stock', 2)->where('product_status', 1)->get();
        } catch (\Exception $error) {
            p($error->getMessage());
        }
        // p($categoryData->toArray());
        $data = compact('categoryData', 'productData', 'category', 'sub_category', 'sub_sub_category');
        // p($data);
        return view('frontend.product')->with($data);
    }

    public function details($product)
    {
        $product = Product::where('product_slug', $product)->with(['color' => function ($query) {
            $query->join('colors', function ($join) {
                $join->on('colors.color_id', "=", "product_color.color_id");
            });
        }, 'fabric' => function ($query) {
            $query->join('fabrics', function ($join) {
                $join->on('fabrics.fabric_id', "=", "product_fabric.fabric_id");
            });
        }, 'getImages', 'category' => function ($query) {
            $query->join("categories", function ($join) {
                $join->on("categories.category_id", "=", "product_category.category_id");
            });
            $query->select("product_category.category_id", "product_category.product_id", "categories.category_name");
        }])->where('out_of_stock', 2)->where('product_status', 1)->get()->first();
        if ($product) {
            $product = $product->toArray();
        }
        $data = compact('product', 'category', 'sub_category', 'sub_sub_category');
        // p($data);
        return view('frontend.product-details')->with($data);
    }
}
