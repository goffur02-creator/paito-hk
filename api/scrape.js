import axios from 'axios';
import * as cheerio from 'cheerio';

export default async function handler(req, res) {
  try {
    const { data } = await axios.get('https://pafi-bombana.org');
    const $ = cheerio.load(data);
    let hasil = [];

    // Mengambil angka dari tabel referensi
    $('table tr').each((i, el) => {
      const baris = $(el).find('td').map((i, td) => $(td).text().trim()).get();
      if (baris.length > 0) hasil.push(baris);
    });

    // Output data (Jika menggunakan database Vercel KV, simpan di sini)
    res.status(200).json({ last_update: new Date(), data: hasil });
  } catch (error) {
    res.status(500).json({ error: "Gagal ambil data" });
  }
}
