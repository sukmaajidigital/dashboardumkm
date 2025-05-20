<?php

namespace App\Http\Controllers\produk;

use App\Http\Controllers\Controller;
use App\Models\postingan\Produk;
use App\Models\postingan\ProdukKategori;
use App\Models\postingan\ProdukListkategori;
use App\Models\postingan\ProdukVariasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ProdukController extends Controller
{
    public function ajax()
    {
        $produks = Produk::all();
        return response()->json($produks);
    }
    public function index(): View
    {
        $produks = Produk::all();
        $produkkategoris = ProdukKategori::select('id', 'nama_kategori')->get();
        return view('page_produk.produk.index', compact('produks', 'produkkategoris'));
    }

    public function create(): View
    {
        $produkkategoris = ProdukKategori::all();
        return view('page_produk.produk.form', compact('produkkategoris'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'harga' => 'required|integer',
            'stock' => 'required|integer',
            // 'sku' => 'nullable|string',
            // 'shopee' => 'nullable|string',
            // 'tokped' => 'nullable|string',
            // 'tiktokshop' => 'nullable|string',
            // 'meta_title' => 'nullable|string|max:255',
            // 'meta_description' => 'nullable|string',
            // 'meta_keywords' => 'nullable|string',
            'produk_kategori_id' => 'required|array',
            'produk_kategori_id.*' => 'exists:produk_kategoris,id',
            'image' => 'nullable',
        ]);

        // try {
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $manager = new ImageManager(new GdDriver());

            $image = $manager->read($imageFile->getRealPath())
                ->scaleDown(width: 900, height: 900);

            // Nama file unik
            $filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

            // Pastikan direktori ada
            $directory = storage_path('app/public/imageproduk');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Path simpan file
            $path = $directory . '/' . $filename;

            // Simpan dengan kualitas 70%
            $image->save($path, quality: 70);

            // Simpan path relatif untuk database
            $validated['image'] = 'imageproduk/' . $filename;
        }

        $produk = Produk::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?? null,
            'description' => $validated['description'] ?? null,
            'harga' => $validated['harga'],
            'stock' => $validated['stock'],
            'sku' => $validated['sku'] ?? null,
            'image' => $validated['image'] ?? null,
            'shopee' => $validated['shopee'] ?? null,
            'tokped' => $validated['tokped'] ?? null,
            'tiktokshop' => $validated['tiktokshop'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        $produk->kategoris()->attach($validated['produk_kategori_id']);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dibuat.');
        // } catch (\Exception $e) {
        //     return back()
        //         ->withInput()
        //         ->withErrors('Gagal membuat produk. ' . $e->getMessage());
        // }
    }

    public function edit(Produk $produk): View
    {
        $produk->load('kategoris'); // load kategoris-nya sekalian
        $produkkategoris = ProdukKategori::all();
        $produklistkategori = ProdukListkategori::all();
        return view('page_produk.produk.edit', compact('produk', 'produkkategoris', 'produklistkategori'));
    }
    public function update(Request $request, Produk $produk): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'harga' => 'required|integer',
            'stock' => 'required|integer',
            // 'sku' => 'nullable|string',
            // 'shopee' => 'nullable|string',
            // 'tokped' => 'nullable|string',
            // 'tiktokshop' => 'nullable|string',
            // 'meta_title' => 'nullable|string|max:255',
            // 'meta_description' => 'nullable|string',
            // 'meta_keywords' => 'nullable|string',
            'produk_kategori_id' => 'required|array',
            'produk_kategori_id.*' => 'exists:produk_kategoris,id',
            'image' => 'nullable|image|max:2048',
        ]);
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                // Hapus gambar lama kalau ada
                if ($produk->image) {
                    Storage::disk('public')->delete($produk->image);
                }
                // Upload gambar baru
                $validated['image'] = $request->file('image')->store('imageproduk', 'public');
            }
            // Update produk
            $produk->update([
                'name' => $validated['name'],
                'slug' => $validated['slug'] ?? null,
                'description' => $validated['description'] ?? null,
                'harga' => $validated['harga'],
                'stock' => $validated['stock'],
                'sku' => $validated['sku'] ?? null,
                'image' => $validated['image'] ?? $produk->image,
                'shopee' => $validated['shopee'] ?? null,
                'tokped' => $validated['tokped'] ?? null,
                'tiktokshop' => $validated['tiktokshop'] ?? null,
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
            ]);
            // Update kategori: sync akan replace otomatis (hapus yang lama, pasang yang baru)
            $produk->kategoris()->sync($validated['produk_kategori_id']);
            DB::commit();
            return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors('Gagal memperbarui produk. ' . $e->getMessage());
        }
    }
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return to_route('produk.index')->with('success', 'bahan Deleted successfully.');
    }

    public function variasi(Produk $produk)
    {
        $variasi = ProdukVariasi::where('produk_id', $produk->id)->get();
        return view('page_produk.produk.variasi', compact('produk'));
    }

    public function variasistore(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_variasi.*' => 'nullable|string|max:255',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'existing_nama_variasi.*' => 'nullable|string|max:255',
            'existing_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Hapus variasi jika dicentang
        if ($request->has('delete_variasi')) {
            ProdukVariasi::whereIn('id', $request->delete_variasi)->delete();
        }

        // Update variasi yang ada
        if ($request->has('existing_ids')) {
            foreach ($request->existing_ids as $id) {
                $variasi = ProdukVariasi::find($id);
                if ($variasi) {
                    $variasi->nama_variasi = $request->existing_nama_variasi[$id] ?? $variasi->nama_variasi;

                    if (isset($request->existing_image[$id])) {
                        $imageFile = $request->existing_image[$id];

                        $manager = new ImageManager(new GdDriver());
                        $image = $manager->read($imageFile->getRealPath())->scaleDown(width: 900, height: 900);

                        $filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();
                        $path = storage_path('app/public/produk_variasi_images/' . $filename);
                        $image->save($path, quality: 70);

                        $variasi->image = 'produk_variasi_images/' . $filename;
                    }

                    $variasi->save();
                }
            }
        }

        // Tambah variasi baru
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $index => $imageFile) {
                $namaVariasi = $request->nama_variasi[$index] ?? null;
                if (!$namaVariasi || !$imageFile) continue;

                $manager = new ImageManager(new GdDriver());
                $image = $manager->read($imageFile->getRealPath())->scaleDown(width: 900, height: 900);

                $filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $path = storage_path('app/public/produk_variasi_images/' . $filename);
                $image->save($path, quality: 70);

                ProdukVariasi::create([
                    'produk_id' => $produk->id,
                    'nama_variasi' => $namaVariasi,
                    'image' => 'produk_variasi_images/' . $filename,
                ]);
            }
        }

        return redirect()->route('produk.index', $produk->id)->with('success', 'Variasi berhasil diperbarui!');
    }
    public function qrPrint()
    {
        $produks = Produk::all();

        return view('page_produk.produk.qrprint', compact('produks'));
    }
}
