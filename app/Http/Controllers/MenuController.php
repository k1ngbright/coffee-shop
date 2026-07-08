<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $products = Menu::latest()->get();
        return view('admin.menu.index', compact('products'));
    }

    public function create()
    {
        $categories = ['กาแฟ', 'ชา', 'เครื่องดื่มอื่นๆ', 'เบเกอรี่'];
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'    => 'required|string',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $data['is_available'] = $request->has('is_available') ? 1 : 0;

        Menu::create($data);
        return redirect()->route('admin.menu.index')->with('success', 'เพิ่มเมนูใหม่สำเร็จแล้ว!');
    }

    // 🛠️ เพิ่มฟังก์ชันนี้เพื่อแก้บั๊กรูปที่ 2 (Call to undefined method show)
    public function show($id)
    {
        $product = Menu::findOrFail($id);
        return view('admin.menu.show', compact('product'));
    }

    // 🛠️ เพิ่มฟังก์ชันสำหรับดึงข้อมูลไปแสดงหน้าแก้ไข
    public function edit($id)
    {
        $product = Menu::findOrFail($id);
        $categories = ['กาแฟ', 'ชา', 'เครื่องดื่มอื่นๆ', 'เบเกอรี่'];
        return view('admin.menu.edit', compact('product', 'categories'));
    }

    // 🛠️ เพิ่มฟังก์ชันสำหรับบันทึกอัปเดตข้อมูล
    public function update(Request $request, $id)
    {
        $request->validate([
            'category'    => 'required|string',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        $product = Menu::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_available'] = $request->has('is_available') ? 1 : 0;
        $product->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'อัปเดตข้อมูลเมนูสำเร็จแล้ว!');
    }

    public function destroy($id)
    {
        $product = Menu::findOrFail($id);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'ลบรายการเมนูเรียบร้อยแล้ว!'
        ]);
    }
}