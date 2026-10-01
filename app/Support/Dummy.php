<?php
namespace App\Support;
use Illuminate\Support\Str;
class Dummy
{
    public static function products(): array
    {
        $r=[['Matcha Latte','Makanan & Minuman',18000,'Aulia Rahma','cup','#cfe3c0','Matcha premium berpadu susu segar, dibuat setiap hari oleh mahasiswa Manajemen Informatika.'],
        ['Crochet Bag','Fashion',85000,'Shinta Dewi','bag','#d9c9f0','Tas rajut handmade dengan motif bunga, dikerjakan satu per satu dengan benang katun.'],
        ['Dalgona Coffee','Makanan & Minuman',15000,'Nabila Putri','cup','#e6c9a8','Kopi dalgona creamy dengan biji kopi lokal pilihan.'],
        ['Tote Bag Canvas','Fashion',75000,'Farhan Aziz','bag','#eee5d3','Tote bag kanvas tebal dengan sablon desain orisinal mahasiswa DKV.'],
        ['Notebook Estetik','Kerajinan',35000,'Rama Dwi','book','#b9dde6','Notebook cover kain bermotif, cocok untuk catatan kuliah dan jurnal.'],
        ['Skincare Alami','Lainnya',60000,'Salsa Mutiara','bottle','#efe3d6','Perawatan kulit berbahan alami untuk kulit tropis.'],
        ['Kaos Sablon Kampus','Fashion',65000,'Dimas Adi','shirt','#cfd8f5','Kaos katun combed 30s dengan desain kolaborasi komunitas kampus.'],
        ['Jasa Desain Logo','Jasa',50000,'Rizky Fauzan','pal','#f5d3dc','Desain logo dan identitas visual untuk UMKM, revisi hingga puas.'],
        ['Template Notion Skripsi','Digital',25000,'Laila Zahra','book','#dcd6f5','Template pelacak progres skripsi lengkap dengan jadwal bimbingan.']];
        return collect($r)->map(fn($a)=>['slug'=>Str::slug($a[0]),'name'=>$a[0],'cat'=>$a[1],'price'=>$a[2],'seller'=>$a[3],'icon'=>$a[4],'bg'=>$a[5],'desc'=>$a[6]])->all();
    }
    public static function news(): array
    {
        return [['Pengembangan Bisnis','chart','BD Resmi Meluncurkan Katalog Produk Mahasiswa','Kolaborasi mahasiswa untuk produk kreatif unggulan.','24 September 2026','#b9d4f5'],
        ['Promo & Pemasaran','mega','Diskon Spesial Produk Mahasiswa Selama Bulan Oktober','Jangan lewatkan promo menarik dari produk unggulan mahasiswa.','10 Oktober 2026','#f2e2b8'],
        ['Kemitraan','users','Workshop: Membangun Brand untuk Bisnis Mahasiswa','Tingkatkan kemampuan branding dan strategi pemasaranmu.','5 Oktober 2026','#cfe0f7'],
        ['Pengembangan Produk','cart','BD Kini Hadir di Website','Akses produk dan peluang bisnis jadi lebih mudah.','1 Oktober 2026','#e4d6c2']];
    }
    public static function people(): array
    {
        return [['Aulia Rahma','Makanan & Minuman','#f0d7c2'],['Shinta Dewi','Fashion','#c9d6ee'],['Nabila Putri','Makanan & Minuman','#e6cfc0'],['Farhan Aziz','Fashion','#bcd0e6'],['Salsa Mutiara','Kesehatan & Kecantikan','#d3e0d0']];
    }
}