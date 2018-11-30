# Tugas 2 IF3110 Pengembangan Aplikasi Berbasis Web 

Pro-book merupakan Website toko buku online untuk melakukan pemesanan dan pembelian buku online. User dapat melakukan pemesanan buku, melihat detil buku, memesan buku, melihat rekomendasi buku, dan memberikan review terhadap buku yang sudah dibeli. Website ini mengaplikasikan **arsitektur web service REST dan SOAP**. Arsitektur aplikasi memanfaatkan 2 buah webservice, yaitu webservice bank dan webservice buku.

## Anggota Tim

1. Nadija Herdwina Putri Soerojo - 13516
2. Rinda Nur Hafizha - 13516151
3. Muhammad Fadhriga Bestari - 13516154

![](temp/architecture.png)

## Webservice bank

Webservice bank dibangun di atas **node.js**. Webservice bank memiliki database yang menyimpan informasi nasabah dan informasi transaksi. 

Webservice bank menyediakan service untuk validasi nomor kartu dan transfer. Webservice bank diimplementasikan menggunakan protokol **REST**.
- Service validasi nomor kartu dilakukan dengan memeriksa apakah nomor kartu tersebut ada pada database bank. Jika iya, berarti kartu tersebut valid.
  
- Service transfer menerima input nomor kartu pengirim, penerima, dan jumlah yang ditransfer. Jika saldo mencukupi, maka transfer berhasil dan uang sejumlah tersebut dipindahkan dari pengirim ke penerima. Transaksi tersebut juga dicatat dalam database webservice. Jika saldo tidak mencukupi, maka transaksi ditolak dan tidak dicatat di database.
  
## Webservice buku

Webservice ini menyediakan daftar buku beserta harganya yang akan digunakan oleh aplikasi pro-book. Webservice buku dibangun di atas **java servlet**. Service yang disediakan webservice ini antara lain adalah pencarian buku, mengambil detail buku, melakukan pembelian, serta memberikan rekomendasi buku sederhana. Webservice ini diimplementasikan menggunakan **JAX-WS dengan protokol SOAP**.

Webservice ini memanfaatkan **Google Books API melalui HttpURLConnection. Tidak diperbolehkan menggunakan Google Books Client Library for Java**. Webservice buku perlu memiliki database berisi data harga buku-buku yang dijual.

Detail service yang disediakan webservice ini adalah:

- Webservice searchBook merupakan service yang melakukan pencarian buku yang menerima keyword judul. Keyword ini akan diteruskan ke Google Books API dan mengambil daftar buku yang mengandung keyword tersebut pada judulnya. Hasil tersebut kemudian dikembalikan pada aplikasi setelah diproses. Proses yang dilakukan adalah menghapus data yang tidak dibutuhkan, menambahkan harga buku jika ada di database, dan mengubahnya menjadi format SOAP.

- Webservice detailBook merupakan service yang melakukan pengambilan detail dan juga mengambil data dari Google Books API, seperti service search. Pada service ini, harga buku juga dicantumkan.

- Webservice buyBook menangani proses pembelian. Service ini menerima masukan id buku yang dibeli, jumlah yang dibeli, serta nomor rekening user yang membeli buku. Nomor rekening tersebut akan digunakan untuk mentransfer uang sejumlah harga total buku. Jika transfer gagal, maka pembelian buku juga gagal.

  Jumlah buku yang berhasil dibeli dicatat di database. Webservice menyimpan ID buku, kategori (genre), dan jumlah total pembelian buku tersebut. Data ini akan digunakan untuk memberikan rekomendasi. Jika pembelian gagal maka data tidak dicatat pada aplikasi.

- Webservice recommendBook dapat memberikan rekomendasi sederhana. Input dari webservice ini adalah kategori buku. Kategori buku yang dimasukkan boleh lebih dari 1. Buku yang direkomendasikan adalah buku yang memiliki jumlah pembelian total terbanyak yang memiliki kategori yang sama dengan daftar kategori yang menjadi input. Data tersebut didapat dari service yang mencatat jumlah pembelian.
  
  Jika buku dengan kategori tersebut belum ada yang terjual, maka webservice akan mengembalikan 1 buku random dari hasil pencarian pada Google Books API. Pencarian yang dilakukan adalah buku yang memiliki kategori yang sama dengan salah satu dari kategori yang diberikan (random).
  
## Perubahan pada aplikasi pro-book

Karena memanfaatkan kedua webservice tersebut, ada perubahan pada aplikasi yang dibuat sebelumnya pada Tugas Besar 1.

- Setiap user menyimpan informasi nomor kartu yang divalidasi menggunakan webservice bank. Validasi dilakukan ketika melakukan registrasi atau mengubah informasi nomor kartu. Jika nomor kartu tidak valid, registrasi atau update profile gagal dan data tidak berubah.

- Data buku diambil dari webservice buku, sehingga aplikasi tidak menyimpan data buku secara lokal. Setiap kali aplikasi membutuhkan informasi buku, aplikasi akan melakukan request kepada webservice buku. Hal ini termasuk proses search dan melihat detail buku.

  Database webservice cukup menyimpan harga sebagian buku yang ada di Google Books API. Buku yang harganya tidak didefinisikan di database dicantumkan NOT FOR SALE dan tidak bisa dibeli, tetapi tetap bisa dilihat detailnya.

- Proses pembelian buku pada aplikasi ditangani oleh webservice buku. Status pembelian (berhasil/gagal dan alasannya) dilaporkan kepada user dalam bentuk notifikasi. Tidak dilakukan proses validasi dalam melakukan transfer 

- Pada halaman detail buku, terdapat rekomendasi buku yang didapatkan dari webservice buku. 

- Halaman search-book dan search-result digabung menjadi satu halaman search yang menggunakan AngularJS. Proses pencarian buku diambil dari webservice buku menggunakan **AJAX**. Hasil pencarian akan ditampilkan pada halaman search menggunakan AngularJS, setelah mendapatkan respon dari webservice. 

    Berikut adalah komponen pada AngularJS yang harus digunkan pada aplikasi:
    - Data binding (ng-model directives)
    - Controllers (ng-controllers)
    - ng-repeat, untuk menampilkan list

- Aplikasi menggunakan `access token` untuk menentukan active user.

## Database

### Database Aplikasi Probook

Terdapat beberapa perubahan pada basis data probook agar web dapat dipisah menjadi beberapa webservice. Pertama, tabel buku tidak lagi disimpan secara penuh pada database ini. Pada database probook, tabel Books hanya menyimpan idBook saja, karena idBook masih diperlukan untuk melakukan transaksi dan review. Terdapat juga penambahan carNumber pada tabel users karena user sekarang memiliki kartu kredit yang perlu divalidasi dan disimpan. User juga menyimpan token yang telah di-generate untuk menandakan otentikasi seorang user.

### Database Webservice Book

Database disimpan pada webservice book. Database ini menyimpan semua detail buku yang diperlukan aplikasi yang datanya didapat dari google books api. Data buku disimpan setiap kali search book dilakukan. Pada database webservice book, terdapat beberapa tabel yang dipecah dari tabel buku karena terdapat beberapa kolom pada database tersebut yang dapat bernilai lebih dari satu, yaitu author dan category. Maka dari itu, disimpan idCategory dan idAuthor yang terpisah dari tabel Books yang menandakan siapa saja dan apa saja author dan kategori untuk setiap buku yang disimpan di basis data tersebut.

### Database Webservice Bank

Database ini menyimpan data yang digunakan pada webservice bank yang memiliki 2 tabel, yaitu tabel Customers dan Transactions. 

- Tabel Customer 

menyimpan data dari nasabah yang memiliki atribut idCustomer, Name yang merupakan nama dari customer, cardNumber yang merupakan nomor kartu nasabah, dan balance yaitu saldo yang dimiliki customer.

- Tabel Transactions

menyimpan data transaksi transfer yang memiliki atribut idTransaction, senderCardNumber yang merupakan nomor kartu pengirim saat transfer, receiverCardNumber yang merupakan nomor kartu penerima saat transfer, amount yang merupakan jumlah uang yang ditransfer, dan transactionDate yang merupakan waktu saat transfer dilakukan

### Konsep shared session dengan menggunakan REST

REST merupakan sebuah konvensi untuk melakukan sebuah HTTP request yang harus disetujui oleh client dan server. Pada dasarnya, REST mengaplikasikan state-less protokol yang mengakibatkan tidak adanya data client yang perlu disimpan oleh server.

Server tidak mengetahui keberadaan ataupun keadaan setiap user yang ada. Keberadaan user tidak pernah disimpan oleh server, mengakibatkan setiap data yang diperlukan untuk melakukan komunikasi antara client dan server disimpan semua oleh client. Hal ini disebabkan karena meski server tidak menyimpan data client, server masih membutuhkan data user untuk menentukan otentikasi setiap user yang mengakses web.

Shared session yang dilakukan pada protokol REST dilakukan dengan cara pengiriman data antara client dan server setiap kali user mencoba bertukar data dengan server.

### Mekanisme access token
Token merupakan sebuah string yang di-*generate* secara *random*. Token diberikan kepada *user* setelah *user* berhasil melakukan *authentication* dan memasuki halaman *search book*. Token disimpan pada *database* beserta dengan *username*, *user id*, *expiration time*, *http user agent*, dan *ip address*. Pada *cookie*, *user* hanya perlu menyimpan token yang di-*generate* secara *random* dan untuk mengakses data - data lainnya, diperlukan untuk mengakses *database*


### Kelebihan dan kelemahan dari arsitektur aplikasi tugas ini, dibandingkan dengan aplikasi monolitik

#### Kelebihan

- Setiap sistem berjalan secara mandiri. Meski data perlu diambil dari setiap *web service*, akan tetapi kerusakan pada sebuah bagian dari fungsionalitas web tidak akan menyebabkan kerusakan pada keseluruhan *web service*.
- Fungsionalitas web dapat dikembangkan secara terpisah dan tidak bergantung satu sama lain sebesar dengan aplikasi monolitik.

#### Kekurangan

- Dibutuhkannya ketelitian tinggi untuk menjaga integritas data pada basis data.
- Banyaknya komunikasi yang dilakukan antar web service menambah besar risiko terjadinya kesalahan pada saat pengiriman data.


### Skenario

1. User melakukan registrasi dengan memasukkan informasi nomor kartu.
2. Jika nomor kartu tidak valid, registrasi ditolak dan user akan diminta memasukkan kembali nomor kartu yang valid.
3. User yang sudah teregistrasi dapat mengganti informasi nomor kartu.
4. Ketika user mengganti nomor kartu, nomor kartu yang baru akan diperiksa validasinya melalui webservice bank.
5. Setelah login, user dapat melakukan pencarian buku.
6. Pencarian buku akan mengirim request ke webservice buku. Halaman ini menggunakan AngularJS.
7. Pada halaman detail buku, ada rekomendasi buku yang didapat dari webservice buku. Rekomendasi buku berdasarkan kategori buku yang sedang dilihat.
8. Ketika user melakukan pemesanan buku, aplikasi akan melakukan request transfer kepada webservice bank.
9. Jika transfer berhasil, aplikasi mengirimkan request kepada webservice buku untuk mencatat penjualan buku.
10. Notifikasi muncul menandakan status pembelian, berhasil atau gagal.

### Pembagian Tugas
REST :

Server side :
1. Validasi nomor kartu : 13516154, 13516151
2. Validasi transfer : 13516154

Client side :
1. Validasi nomor kartu : 13516151
2. Validasi transfer : 13516154

SOAP :

Server side :
1. Fungsionalitas book detail : 13516154
2. Fungsionalitas buy book : 13516154
3. Fungsionalitas search book : 13516130
4. Fungsionalitas recommend book : 13516130

Client side :
1. Fungsionalitas book detail : 13516154
2. Fungsionalitas buy book : 13516154, 13516151
3. Fungsionalitas search book : 13516130
4. Fungsionalitas recommend book : 13516130 

Perubahan Web app :
1. Halaman Search + Searh Result Angular: 13516130 
2. Halaman History : 13516154
3. Halaman Review : 13516154
4. Halaman Book Detail : 13516154
5. Rekomendasi pada Book Detail : 13516130
6. Validasi Nomor Kartu pada Register dan Update Profile: 13516151


