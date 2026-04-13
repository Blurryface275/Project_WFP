<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $articles = [
            [
                'title' => 'Tips Menjaga Kesehatan Jantung',
                'content' => 'Kesehatan jantung dapat dijaga dengan pola makan seimbang, olahraga teratur minimal 30 menit per hari, serta menghindari kebiasaan merokok. Konsultasikan kondisi jantung Anda secara berkala dengan dokter spesialis untuk deteksi dini penyakit kardiovaskular.',
            ],
            [
                'title' => '5 Cara Mencegah Diabetes Sejak Dini',
                'content' => 'Diabetes tipe 2 dapat dicegah dengan mengontrol asupan gula, menjaga berat badan ideal, dan rutin berolahraga. Pemeriksaan kadar gula darah secara berkala sangat dianjurkan terutama bagi mereka yang memiliki riwayat keluarga dengan diabetes.',
            ],
            [
                'title' => 'Manfaat Olahraga Rutin untuk Kesehatan Mental',
                'content' => 'Olahraga tidak hanya bermanfaat untuk fisik tetapi juga kesehatan mental. Aktivitas fisik merangsang produksi endorfin yang membantu mengurangi stres, kecemasan, dan gejala depresi. Cukup 20-30 menit jalan kaki setiap hari sudah memberikan dampak positif.',
            ],
            [
                'title' => 'Panduan Nutrisi Seimbang untuk Pekerja Kantoran',
                'content' => 'Pekerja kantoran cenderung mengonsumsi makanan cepat saji karena keterbatasan waktu. Disarankan untuk menyiapkan bekal dengan komposisi karbohidrat kompleks, protein, sayur, dan buah. Hindari minuman manis berlebihan dan perbanyak konsumsi air putih minimal 8 gelas per hari.',
            ],
            [
                'title' => 'Kenali Gejala Awal Hipertensi',
                'content' => 'Hipertensi sering disebut silent killer karena jarang menunjukkan gejala di tahap awal. Beberapa tanda yang perlu diwaspadai antara lain sakit kepala berulang, pandangan kabur, dan mudah lelah. Periksa tekanan darah secara rutin terutama jika usia di atas 35 tahun.',
            ],
            [
                'title' => 'Cara Menjaga Imunitas Tubuh di Musim Hujan',
                'content' => 'Musim hujan meningkatkan risiko infeksi saluran pernapasan dan demam. Perkuat daya tahan tubuh dengan tidur cukup 7-8 jam, konsumsi makanan kaya vitamin C seperti jeruk dan jambu biji, serta jaga kebersihan tangan untuk mencegah penularan penyakit.',
            ],
            [
                'title' => 'Pentingnya Medical Check Up Berkala',
                'content' => 'Medical check up berkala membantu mendeteksi penyakit sejak dini sebelum menimbulkan gejala serius. Disarankan melakukan pemeriksaan kesehatan menyeluruh setidaknya satu tahun sekali, mencakup tes darah lengkap, fungsi hati, ginjal, dan rontgen dada.',
            ],
            [
                'title' => 'Bahaya Kurang Tidur bagi Kesehatan',
                'content' => 'Kurang tidur kronis meningkatkan risiko obesitas, penyakit jantung, diabetes, dan gangguan konsentrasi. Orang dewasa membutuhkan 7-9 jam tidur per malam. Hindari penggunaan gadget sebelum tidur dan ciptakan suasana kamar yang nyaman untuk meningkatkan kualitas istirahat.',
            ],
        ];

        $picked = fake()->randomElement($articles); // ini random article mana yg mau diambil

        return [
            //
            'title' => $picked['title'],
            'content' => $picked['content'],
            'photo' => fake()->imageUrl(640, 480, 'health'),
            'category_id' => fake()->randomElement([1, 2, 3, 4]),
            'author_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
