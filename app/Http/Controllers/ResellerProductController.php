<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductHighlight;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResellerProductController extends Controller
{
    public function index(Request $request)
    {
        $reseller = $request->user()->reseller;

        $products = $reseller
            ? $reseller->products()
            ->with('category')
            ->latest()
            ->get()
            : collect();

        return view('reseller.products', compact('products'));
    }

    public function create(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        return view('reseller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $reseller = $request->user()->reseller;

        abort_unless(
            $reseller,
            403,
            'Akun kamu belum terdaftar sebagai reseller.'
        );

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'max:2000'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'max:2048'],
            'highlight_title' => ['nullable', 'array'],
            'highlight_title.*' => ['nullable', 'string', 'max:255'],
        ]);

        // =========================================================
        // SIMPAN PRODUK
        // =========================================================

        $product = Product::create([
            'reseller_id' => $reseller->id,
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . '-' . Str::random(5),
            'description' => $data['description'],
            'price' => $data['price'],
            'status' => 'pending',
        ]);

        // =========================================================
        // SIMPAN FOTO
        // =========================================================

        foreach ($request->file('images', []) as $i => $file) {
            $path = $file->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $path,
                'sort_order' => $i + 1,
            ]);
        }

        // =========================================================
        // SIMPAN KEUNGGULAN
        // =========================================================

        foreach ($request->input('highlight_title', []) as $title) {
            if (trim($title) !== '') {
                ProductHighlight::create([
                    'product_id' => $product->id,
                    'title' => $title,
                ]);
            }
        }

        // =========================================================
        // AMBIL DATA UNTUK WHATSAPP ADMIN
        // =========================================================

        $adminWhatsapp = SiteSetting::where('key', 'whatsapp')->value('value');

        // Bersihkan nomor dari spasi, +, -, dan karakter lain
        $adminWhatsapp = preg_replace('/[^0-9]/', '', $adminWhatsapp ?? '');

        // Ambil kategori
        $category = Category::find($data['category_id']);

        // =========================================================
        // PESAN WHATSAPP
        // =========================================================

        $message = "Halo Admin BD 👋\n\n";
        $message .= "Saya *{$reseller->nama_lengkap}*";

        if ($reseller->prodi) {
            $message .= " dari *{$reseller->prodi}*";
        }

        $message .= ".\n\n";
        $message .= "Saya baru saja mengajukan produk melalui BD Katalog.\n\n";
        $message .= "📦 *Produk:* {$product->name}\n";
        $message .= "📂 *Kategori:* " . ($category?->name ?? '-') . "\n";
        $message .= "💰 *Harga:* Rp " . number_format($product->price, 0, ',', '.') . "\n";
        $message .= "📌 *Status:* Menunggu persetujuan admin\n\n";
        $message .= "Mohon dicek dan diproses. Terima kasih 🙏";

        // Encode pesan agar aman dimasukkan ke URL
        $whatsappUrl = null;

        if ($adminWhatsapp) {
            $whatsappUrl = 'https://wa.me/' . $adminWhatsapp
                . '?text=' . urlencode($message);
        }

        // =========================================================
        // REDIRECT
        // =========================================================

        return redirect()
            ->route('reseller.products')
            ->with('status', 'Produk berhasil diajukan dan menunggu persetujuan admin.')
            ->with('whatsapp_url', $whatsappUrl)
            ->with('whatsapp_product', $product->name);
    }

    public function show(Request $request, int $id)
    {
        $reseller = $request->user()->reseller;

        abort_unless(
            $reseller,
            403,
            'Akun kamu belum terdaftar sebagai reseller.'
        );

        $product = $reseller->products()
            ->with([
                'category',
                'images',
                'highlights',
            ])
            ->where('id', $id)
            ->firstOrFail();

        return view('reseller.products.show', compact('product'));
    }
    public function destroy(Request $request, int $id)
    {
        $reseller = $request->user()->reseller;

        abort_unless(
            $reseller,
            403,
            'Akun kamu belum terdaftar sebagai reseller.'
        );

        $product = $reseller->products()
            ->where('id', $id)
            ->firstOrFail();

        // Hanya pengajuan yang masih menunggu yang boleh dibatalkan
        if ($product->status !== 'pending') {
            return redirect()
                ->route('reseller.products')
                ->with('status', 'Produk yang sudah diproses tidak dapat dibatalkan.');
        }

        // Hapus gambar produk dari database dan storage
        foreach ($product->images as $image) {
            if ($image->image) {
                \Illuminate\Support\Facades\Storage::disk('public')
                    ->delete($image->image);
            }

            $image->delete();
        }

        // Hapus highlights jika ada
        $product->highlights()->delete();

        // Hapus produk
        $product->delete();

        return redirect()
            ->route('reseller.products')
            ->with('status', 'Pengajuan produk berhasil dibatalkan.');
    }
}
