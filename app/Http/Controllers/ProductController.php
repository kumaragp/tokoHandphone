<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = config("products");
        return view("admin.products.index", compact("products"));
    }
    public function create()
    {
        return view("admin.products.create");
    }
    private function saveProductsConfig(array $products)
    {
        $configPath = config_path('products.php');
        $configString = "<?php\n\nreturn " . var_export($products, true) . ";\n";
        file_put_contents($configPath, $configString);
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|string',
        ]);

        // Ambil data produk yang ada dari config
        $products = config('products');

        // Tambahkan produk baru
        $products[] = [
            'id' => time(),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
        ];

        // Simpan kembali ke file config
        $this->saveProductsConfig($products);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }
    public function deleteArray(Request $request)
    {
        $configPath = config_path('products.php');
        $existingProducts = include $configPath;
        $productIds = explode(',', $request->input('product_ids'));
        $updatedProducts = array_filter($existingProducts, function ($product) use ($productIds) {
            return !in_array($product['id'], $productIds);
        });
        $configString = "<?php\n\nreturn " . var_export($updatedProducts, true) . ";\n";
        file_put_contents($configPath, $configString);
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
    public function update(Request $request)
    {
        $configPath = config_path('products.php');
        $existingProducts = include $configPath;
        $productIds = explode(',', $request->input('product_ids'));
        $name = $request->input('name');
        $price = $request->input('price');
        $description = $request->input('description');
        $image = $request->input('image');
        foreach ($existingProducts as $key => $product) {
            if (in_array($product['id'], $productIds)) {
                $existingProducts[$key]['name'] = $name;
                $existingProducts[$key]['price'] = $price;
                $existingProducts[$key]['description'] = $description;
                $existingProducts[$key]['image'] = $image;
            }
        }
        $configString = "<?php\n\nreturn " . var_export($existingProducts, true) . ";\n";
        file_put_contents($configPath, $configString);
        return redirect()->back()->with('success', 'Product edited successfully.');
    }
}
