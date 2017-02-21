DROP TABLE IF EXISTS `soal_wpt`;
CREATE TABLE `soal_wpt` (
  `no_soal` int(2) NOT NULL,
  `question` text NOT NULL,
  `answer` varchar(5) NOT NULL,
  `multi_ans` tinyint(1) DEFAULT '0',
  `img` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal_wpt`
--

INSERT INTO `soal_wpt` (`no_soal`, `question`, `answer`, `multi_ans`, `img`) VALUES
(1, 'Bulan lalu pada awal tahun ini adalah a. Januari b. Maret c. Juli d. Desember e. Oktober', 'd', 0, '0'),
(2, 'Menangkap adalah lawan kata dari <br /> a. meletakkan b. membebaskan c. beresiko d. berusaha e. turun tingkat', 'b', 0, '0'),
(3, 'Sebagian besar hal dibawah ini serupa satu sama lain. Manakah salah satu diantaranya yang <br/> kurang serupa dengan yang lain? <br /> a. januari b. Agustus c. Rabu d. Oktober e. Desember', 'c', 0, '0'),
(4, 'Jawablah dengan menuliskan YA atau TIDAK. Apakah RSVP berarti \'jawaban yang tidak perlu\'', 'TIDAK', 0, '0'),
(5, 'Dalam kelompok kata berikut, manakah kata yang berbeda dari kata yang lain? <br /> a. pasukan b. liga c. berpartisipasi d. pak e. kelompok', 'c', 0, '0'),
(6, 'BIASA adalah lawan kata dari a. jarang b. terbiasa c. tetap d. berhenti e. selalu', 'a', 0, '0'),
(7, 'Gambar manakah yang terbuat dari dua gambar di dalam tanda kurung?', '3', 0, '1'),
(8, 'Pehatikan urutan angka berikut. Angka berapa yang selanjutnya muncul? Jawablah dalam bentuk pecahan. 6 4 2 1 1/2 1/4 ?', '1/8', 0, '0'),
(9, 'Klien dan Pelanggan Apakah kata-kata ini:<br >a. memiliki arti yang sama b. memiliki arti berlawanan c. tidak memiliki arti sama atau berlainan', 'a', 0, '0'),
(10, 'Manakah kata berikut ini yang berhubungan dengan aroma saat gigi mengunyah? <br/> a. manis b. bau tak sedap c. bau wangi d. hidung e. bersih', 'd', 0, '0'),
(11, 'MUSIM GUGUR adalah lawan dari:<br >a. Liburan b. musim panas c. musim dingin d. musim semi e. musim gugur', 'c', 0, '0'),
(12, 'Sebuah pesawat terbang 300 kaki dalam 1/2 detik. Pada kecepatan yang sama berapa kaki lagi terbang dalam 10 detik?', '6000', 0, '0'),
(13, 'Anggaplah dua pernyataan pertama adalah benar. Apakah yang terakhir: a. benar b. salah<br /> c. tidak tahu? <br/> Anak-anak lelaki ini adalah anak yang normal. Semua anak normal sifatnya aktif. Anak-anak <br/> lelaki ini aktif', 'a', 0, '0'),
(14, 'JAUH adalah lawan kata dari a. terpencil b. dekat c. jauh d. terburu-buru e. pasti', 'b', 0, '0'),
(15, '3 permen lemon seharga 10 rupiah. Berapa harga 1/2 lusin?', '20', 0, '0'),
(16, 'Berapa banyak duplikasi yang sama dari lima pasangan angka dibawah ini?<br /> &nbsp;&nbsp;&nbsp; 84721&nbsp;&nbsp;84721<br/>&nbsp;&nbsp;&nbsp; 9210651&nbsp;&nbsp;9210651<br/>&nbsp;&nbsp;&nbsp;14201201&nbsp;&nbsp;14210210<br/>&nbsp;&nbsp;&nbsp; 96101101&nbsp;&nbsp;96101161<br/>&nbsp;&nbsp;&nbsp; 88884444&nbsp;&nbsp;88884444', '2', 0, '0'),
(17, 'Misalkan Anda menyusun kata-kata berikut sehingga menjadi pernyataan yang benar. Lalu tuliskan huruf terakhir dari kata terakhir sebagai jawaban.<br /><i>Selalu sebuah kata kerja kalimat suatu memiliki</i>', 'A', 0, '0'),
(18, 'Anak lelaki berumur 5 tahun dan saudara perempuannya dua kali lebih tua. Ketika anak lelaku itu berumur 8 tahun, berapa umur saudara perempuannya?', '13', 0, '0'),
(19, 'IT\'S ITS<br />Apakah kata ini<br />a. memiliki arti yang sama b. memiliki arti yang berlawanan c. tidak memiliki arti yang sama atau berlawanan', 'c', 0, '0'),
(20, 'Anggaplah dua pernyataan pertama adalah benar, Apakah pernyataan terakhir:<br />a. benar b. salah c. tidak tahu.<br />John seusia dengan Sally. Sally lebih muda dari Bill. John lebih muda dari Bill.', 'a', 0, '0'),
(21, 'Seorang pedagang membeli beberapa barrel seharga 4.000 rupiah. Ia menjual dengan harga 5.000 rupiah, mendapat untung 50 rupiah setiap barrel. Berapa banyak barel yang dijual?', '20', 0, '0'),
(22, 'Misalkan Anda menyusun kata-kata berikut sehingga menjadi kalimat lengkap. Jika kalimat itu benar, tulislah (B). Jika salah, tulislah (S). <br /><i>telur menghasilkan semua ayam</i>', 'S', 0, '0'),
(23, 'Dua dari peribahasa berikut ini memiliki arti sama. Manakah itu?<br />1. Semakin banyak memiliki sapi, akan memiliki satu anak sapi yang buruk.<br />2. Anak seperti Ayahnya.<br />3. Bila tertinggal sama jauhnya dengan satu mil<br />4. Seorang dikenal dari persahabatan yang dijalin<br />5. Mereka adalah benih dari mangkuk yang sama.', '2,5', 1, '0'),
(24, 'Sebuah jam terlambat 1 menit 18 detik dalam 39 hari. Berapa detik ia terlambat dalam sehari?', '2', 0, '0'),
(25, 'CANVASS CANVAS<br/>Apakah kata-kata ini :<br />a. memiliki arti yang sama b. memiliki arti yang berlawanan c. tidak memiliki arti yang sama atau berlawanan', 'c', 0, '0'),
(26, 'Anggaplah dua pernyataan pertama adalah benar. Pernyataan terakhir:<br />a. benar b. salah c. tidak tahu.<br />Semua siswa mengikuti ujian. Beberapa orang di ruangan ini adalah siswa. Beberapa orang di ruangan ini mengikuti ujian.', 'a', 0, '0'),
(27, 'Dalam 30 hari seorang menabung 1 dolar. Berapa rata-rata tabungannya setiap hari? Jawablah dalam bentuk pecahan.', '1/30', 0, '0'),
(28, 'INGENIOUS INGENUOUS<br /> Apakah kata-kata ini<br />a. memiliki arti yang sama b. memiliki arti yang berlawanan c. tidak memiliki arti sama atau berlawanan', 'c', 0, '0'),
(29, 'Dua orang menangkap 36 ikan. X menangkap 5 kali lebih banyak dari Y. Berapa ikan yang ditangkap Y?', '6', 0, '0'),
(30, 'Sebuah kotak segi empat, yang terisi penuh, memuat 800 kubik kaki gandum. Jika satu kotak lebarnya 8 kaki dan panjangnya 10 kaki, berapa kedalaman kotak itu?', '10', 0, '0'),
(31, 'Satu angka dari rangkaian berikut tidak cocok dengan pola angka yang lainnya. Angka berapakah itu? <br /> 1/2&nbsp;&nbsp;1/4&nbsp;&nbsp;1/6&nbsp;&nbsp;1/8&nbsp;&nbsp;1/9&nbsp;&nbsp;1/12', '1/9', 0, '0'),
(32, 'Jawablah pertanyaan ini dengan menulis YA atau TIDAK. Apakah P.M. berarti \'post merediem\'?', 'Ya', 0, '0'),
(33, 'DAPAT DIPERCAYA&nbsp;&nbsp;GAMPANG DIPERCAYA<br />Apakah kata-kata ini<br />a. memiliki arti sama b. memiliki arti berlawanan c. tidak memiliki arti sama atau berlawanan', 'c', 0, '0'),
(34, 'Sebuah rok membutuhkan 2 1/4 meter kain. Berapa banyak potong yang dihasilkan dari 45 meter kain?', '20', 0, '0'),
(35, 'Sebuah jam menunjuk tepat pada pukul 12 siang hari pada hari Senin. Pada pukul 2 siang, hari <br/> rabu, jam itu terlambat 26 detik. Pada rata-rata yang sama, berapa banyak jam itu terlambat <br/>dalam 1/2 jam? Jawablah dalam bentuk pecahan.', '1/4', 0, '0'),
(36, 'Tim bisbol kami kalah 9 permainan dalam musim ini. Ini merupakan 3/8 bagian dari semua<br/> pertandingan mereka. Berapa banyak pertandingan yang mereka mainkan dalam musim<br/> kompetisi saat ini?', '24', 0, '0'),
(37, 'Apakah angka selanjutnya dari seri ini? 1 .5 .25 .125', '.0625', 0, '0'),
(38, 'Bentuk geometris ini dapat dibagi oleh suatu garis lurus menjadi dua bagian yang dapat <br/> disatukan dengan suatu cara hingga membentuk bujur sangkar yang sempurna. Gambarlah<br/> garis yang menghubungkan dua dari angka-angka yang ada. Lalu tuliskan angka tersebut <br/> sebagai jawaban.', '6,9', 1, '1'),
(39, 'Apakah arti dari kalimat berikut: a. sama b. berlawanan c. tidak sama atau berlawanan? <br/> Sebuah sapu yang baru menyapu dengan bersih. Sepatu yang sudah lama sifatnya makin lunak.', 'b', 0, '0'),
(40, 'Berapa duplikasi pasangan kata berikut ini?<br/>&nbsp;&nbsp;&nbsp; Rexford, J.D.&nbsp;&nbsp;Rockford, J.D<br/>&nbsp;&nbsp;&nbsp; Richards, W.E.&nbsp;&nbsp;Richad, W.E.<br/>&nbsp;&nbsp;&nbsp; Wood, A.O.&nbsp;&nbsp;Wood, A.O<br/>&nbsp;&nbsp;&nbsp; Siegel, A.B.&nbsp;&nbsp;Siegel, A.B.<br/>&nbsp;&nbsp;&nbsp; Singleton, M.O.&nbsp;&nbsp;Simbleten, M.O.', '1', 0, '0'),
(41, 'Dari dua peribahasa ini memiliki makna yang serupa. Manakah itu?<br/>&nbsp;&nbsp;&nbsp; 1. Anda tidak dapat membuat dompet sutra dari kuping babi betina <br/>&nbsp;&nbsp;&nbsp; 2. Orang yang mencuri telur akan mencuri sapi<br/>&nbsp;&nbsp;&nbsp; 3. Batu yang berguling tidak akan mengumpulkan lumut<br/>&nbsp;&nbsp;&nbsp; 4. Anda tidak mungkin menghancurkan kapal yang sudah rusak.<br/>&nbsp;&nbsp;&nbsp; 5. Ini ketidakmungkinan yang terjadi', '1,4', 0, '0'),
(42, 'Gambar geometris ini dapat dibagi dengan garis lurus menjadi dua bagian yang dapat <br/>disatukan untuk membentuk sebuah bujur sangkar yang sempurna. Gambarlah suatu garis dengan<br/> menghubungkan dua angka yang ada. Lalu tulislah angka itu sebagai jawaban<br/>', '3,22', 1, '1'),
(43, 'Dalam kelompok angka berikut ini,  manakah angka yang terkecil? 10 1 .999 .33 11', '.33', 0, '0'),
(44, 'Apakah makna dari kalimat berikut: a. sama b. berlawanan c. tidak sama atau berlawanan? <br/> Tidak ada orang jujur meminta maaf atas kejujurannya. Kejujuran dihormati dan lapar pujian.', 'b', 0, '0'),
(45, 'Dengan harga 1.80 dolar,  seorang grosir membeli satu kardus buah yang berisi 12 lusin. Ia tahu<br/> dua lusin akan busuk sebelum dia menjualnya. Dengan harga berapa per lusin dia harus <br/> menjual jeruk itu untuk mendapat 1/3 hari harga seluruhnya?', '24', 0, '0'),
(46, 'Dalam rangkaian kata berikut ini,  manakah kata yang berbeda dari yang lainnya? <br/> a. koloni b. perlawanan c. kawanan d. kru e. konstelasi', 'b', 0, '0'),
(47, 'Anggaplah dua pernyataan pertama ini benar. Apakah pernyataan terakhir? a. benar b. salah <br/> c. tidak tahu. Orang besar dibodohi. Saya dibodohi. Saya adalah orang besar.', 'c', 0, '0'),
(48, 'Tiga orang membentuk kemitraan dan setuju membagi keuntungan secara rata. X <br/> menginvestasi 4.500 dolar. Y sebesar 3.500 dolar dan Z sebesar 2.000 dolar. Jika keuntungan <br/> mencapai 1.500 dolar,  lebih kurang berapa yang akan diperoleh X dibanding jika keuntungan <br/> dibagi berdasarkan besarnya investasi?', '175', 0, '0'),
(49, 'Empat dari 5 bagian ini dapat digabungkan untuk membuat segi tiga. Manakah keempat gambar ini?', '1,2,4', 1, '1'),
(50, 'Untuk mencetak sebuah artikel berisi 30.000 kata,  sebuah percetakan memutuskan untuk <br/> memakai dua ukuran jenis. Dengan menggunakan tipe yang lebih besar,  sebuah halaman<br/>tercetak akan memuat 1.200 kata. Dengan tipe yang lebih kecil,  sebuah halaman memuat 1.500<br/>kata. Artikel ini masuk dalam 22 halaman di majalah. Berapa banyak halaman yang dibutuhkan<br/> untuk tipe yang lebih kecil?', '12', 0, '0');


