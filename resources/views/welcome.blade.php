<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#f5f8fc">
        <meta name="description" content="SoraFin membantu UMKM mencatat transaksi dan memantau keuangan usaha.">
        <link rel="icon" type="image/png" href="{{ asset('images/sorafin-logo.png') }}">
        <title>SoraFin — Pembukuan Usaha</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-canvas text-ink antialiased">
        <div class="app-shell">
            <aside class="sidebar">
                <a class="brand" href="#" aria-label="SoraFin, Beranda" data-nav="home">
                    <img class="brand-logo" src="{{ asset('images/sorafin-logo.png') }}" alt="">
                    <span><strong>SoraFin</strong><small>Pembukuan jadi mudah</small></span>
                </a>

                <div class="shop-switcher">
                    <span class="shop-avatar">WB</span>
                    <span class="shop-copy"><strong>Warung Bu Sri</strong><small>Sinkronisasi cloud aktif</small></span>
                    <span class="online-dot" aria-label="Online"></span>
                </div>

                <nav class="side-nav" aria-label="Navigasi utama">
                    <p class="nav-caption">MENU</p>
                    <button class="nav-link is-active" data-nav="home">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-6v-7h-4v7H4a1 1 0 0 1-1-1z"/></svg>
                        Beranda
                    </button>
                    <button class="nav-link" data-nav="transactions">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"/></svg>
                        Transaksi <span class="nav-count">12</span>
                    </button>
                    <button class="nav-link" data-nav="reports">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V4h16v16zM8 16v-4m4 4V8m4 8v-6"/></svg>
                        Laporan KUR
                    </button>
                    <button class="nav-link" data-nav="settings">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm0-5v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.06 16.94l-1.42 1.42m12.72 0-1.42-1.42M7.06 7.06 5.64 5.64"/></svg>
                        Pengaturan
                    </button>
                    <button class="nav-link onboarding-link" data-open-onboarding>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V9l8-6 8 6v11h-5v-6H9v6zM9 10h6"/></svg>
                        Profil usaha
                    </button>
                </nav>

                <div class="sidebar-bottom">
                    <div class="sync-card">
                        <span class="sync-icon">✓</span>
                        <span><strong>Data tersinkron</strong><small>Terakhir diperbarui 10:45</small></span>
                    </div>
                    <p class="sidebar-footnote">SoraFin · Versi demo</p>
                </div>
            </aside>

            <div class="workspace">
                <header class="topbar">
                    <div class="mobile-brand">
                        <img class="brand-logo" src="{{ asset('images/sorafin-logo.png') }}" alt="">
                        <strong>SoraFin</strong>
                    </div>
                    <div class="breadcrumb"><span>Usaha</span><span class="crumb-divider">/</span><strong id="page-title">Beranda</strong></div>
                    <div class="topbar-actions">
                        <span class="date-label">Jumat, 24 Oktober 2024</span>
                        <button class="icon-button notification-button" aria-label="Notifikasi" data-toast="Belum ada notifikasi baru.">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9m-8 12h4"/></svg>
                            <i></i>
                        </button>
                        <button class="profile-button" data-open-onboarding><span>WS</span><span>Warung Bu Sri</span><b>⌄</b></button>
                    </div>
                </header>

                <main class="main-content">
                    <section class="view-panel is-visible" id="view-home" data-view="home">
                        <div class="page-heading">
                            <div><p class="eyebrow">JUMAT, 24 OKTOBER 2024</p><h1>Selamat pagi, Bu Sri <span>☀️</span></h1><p class="heading-copy">Yuk, catat transaksi hari ini. Pembukuan rapi, usaha makin maju.</p></div>
                            <button class="button button-primary heading-cta" data-open-transaction>
                                <span class="button-plus">+</span> Catat transaksi
                            </button>
                        </div>

                        <div class="summary-grid">
                            <article class="card summary-card">
                                <div class="summary-label"><span class="summary-icon income-icon">↓</span><span>Uang masuk hari ini</span><span class="trend-pill">↑ 12%</span></div>
                                <strong class="summary-amount">Rp 450.000</strong>
                                <small>7 transaksi tercatat</small>
                            </article>
                            <article class="card summary-card">
                                <div class="summary-label"><span class="summary-icon expense-icon">↑</span><span>Uang keluar hari ini</span><span class="trend-pill trend-muted">Hari ini</span></div>
                                <strong class="summary-amount expense-text">Rp 125.000</strong>
                                <small>2 pembelian bahan</small>
                            </article>
                            <article class="card summary-card profit-card">
                                <div class="summary-label"><span class="summary-icon profit-icon">↗</span><span>Estimasi laba bulan ini</span><span class="trend-pill">+14,2%</span></div>
                                <strong class="summary-amount">Rp 4.850.000</strong>
                                <small>Dibanding bulan sebelumnya</small>
                            </article>
                        </div>

                        <div class="home-grid">
                            <section class="card voice-card">
                                <div class="section-title-row">
                                    <div><span class="eyebrow">CATAT TANPA REPOT</span><h2>Suara kasir AI</h2></div>
                                    <span class="status-pill"><i></i> Siap digunakan</span>
                                </div>
                                <div class="voice-prompt">
                                    <span class="sparkle">✦</span>
                                    <div><strong>Tekan dan ucapkan transaksi</strong><p>Contoh: “Beli telur 3 kilo 85 ribu untuk warung”</p></div>
                                </div>
                                <div class="voice-controls">
                                    <button class="mic-button" id="voice-button" aria-label="Mulai rekam transaksi">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="9" y="2" width="6" height="13" rx="3"/><path d="M5 10v2a7 7 0 0 0 14 0v-2m-7 9v3m-4 0h8"/></svg>
                                    </button>
                                    <span><strong id="voice-state">Bicara untuk mulai</strong><small id="voice-hint">Bahasa Indonesia · Otomatis</small></span>
                                </div>
                                <div class="suggestion-row"><span>Coba ucapkan:</span><button data-voice-example="Beli bensin 20 ribu pribadi">“Beli bensin 20rb pribadi”</button><button data-voice-example="Jual beras 5 kg 75 ribu usaha">“Jual beras 5kg 75rb usaha”</button></div>
                                <form class="quick-entry" id="quick-entry-form">
                                    <label for="quick-entry">Atau ketik transaksi secara manual</label>
                                    <div><input id="quick-entry" name="description" placeholder="Contoh: Penjualan hari ini..." required><button class="button button-primary" type="submit">Kirim <span>→</span></button></div>
                                </form>
                            </section>

                            <section class="card cash-card">
                                <div class="section-title-row"><div><span class="eyebrow">RINGKASAN USAHA</span><h2>Arus kas</h2></div><button class="text-button" data-nav="reports">Lihat laporan →</button></div>
                                <div class="chart-summary"><div><span class="legend-dot green-dot"></span><span>Pemasukan</span><strong>Rp 18,45 jt</strong></div><div><span class="legend-dot amber-dot"></span><span>Pengeluaran</span><strong>Rp 13 jt</strong></div></div>
                                <div class="bar-chart" aria-label="Grafik arus kas 7 hari terakhir">
                                    <div class="chart-y-labels"><span>3 jt</span><span>2 jt</span><span>1 jt</span><span>0</span></div>
                                    <div class="chart-bars">
                                        <div><i style="--income:44%;--expense:20%"></i><span>Sen</span></div>
                                        <div><i style="--income:68%;--expense:32%"></i><span>Sel</span></div>
                                        <div><i style="--income:52%;--expense:28%"></i><span>Rab</span></div>
                                        <div><i style="--income:82%;--expense:39%"></i><span>Kam</span></div>
                                        <div><i style="--income:62%;--expense:25%"></i><span>Jum</span></div>
                                        <div><i style="--income:72%;--expense:36%"></i><span>Sab</span></div>
                                        <div><i style="--income:48%;--expense:22%"></i><span>Min</span></div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <section class="card recent-card">
                            <div class="section-title-row"><div><span class="eyebrow">AKTIVITAS TERBARU</span><h2>Transaksi terakhir</h2></div><button class="text-button" data-nav="transactions">Lihat semua transaksi →</button></div>
                            <div class="table-wrap">
                                <table><thead><tr><th>Transaksi</th><th>Tanggal</th><th>Kategori</th><th>Dompet</th><th class="align-right">Nominal</th></tr></thead>
                                    <tbody id="recent-transactions">
                                        <tr><td><span class="table-item"><span class="table-icon sales-icon">↗</span><span><strong>Penjualan minyak goreng 2L</strong><small>Dicatat melalui suara AI</small></span></span></td><td>Hari ini, 10:42</td><td><span class="category-pill">Penjualan</span></td><td>Kas Usaha</td><td class="align-right amount-positive">+Rp 34.000</td></tr>
                                        <tr><td><span class="table-item"><span class="table-icon expense-icon">↓</span><span><strong>Belanja minyak goreng</strong><small>Dicatat manual</small></span></span></td><td>Hari ini, 09:18</td><td><span class="category-pill category-expense">Belanja dagangan</span></td><td>Kas Usaha</td><td class="align-right amount-negative">−Rp 85.000</td></tr>
                                        <tr><td><span class="table-item"><span class="table-icon personal-icon">⚡</span><span><strong>Bayar listrik rumah</strong><small>Dicatat melalui suara AI</small></span></span></td><td>Kemarin, 19:40</td><td><span class="category-pill category-personal">Operasional</span></td><td>Kas Pribadi</td><td class="align-right amount-negative">−Rp 150.000</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </section>

                    <section class="view-panel" id="view-transactions" data-view="transactions" hidden>
                        <div class="page-heading">
                            <div><p class="eyebrow">BUKU KAS USAHA</p><h1>Transaksi</h1><p class="heading-copy">Semua pemasukan dan pengeluaran tercatat rapi di sini.</p></div>
                            <button class="button button-primary" data-open-transaction><span class="button-plus">+</span> Catat transaksi</button>
                        </div>
                        <div class="transaction-overview">
                            <article class="card balance-card"><span>Saldo kas usaha</span><strong>Rp 3.850.000</strong><small>Saldo terakhir diperbarui hari ini</small></article>
                            <article class="card balance-card"><span>Pemasukan bulan ini</span><strong class="amount-positive">Rp 18.450.000</strong><small>128 transaksi tercatat</small></article>
                            <article class="card balance-card"><span>Pengeluaran bulan ini</span><strong class="expense-text">Rp 13.000.000</strong><small>Termasuk biaya operasional</small></article>
                        </div>
                        <section class="card ledger-card">
                            <div class="section-title-row ledger-heading"><div><h2>Riwayat transaksi</h2><p class="heading-copy">Catatan harian usaha dan pribadi</p></div><button class="button button-outline" id="export-transactions">↓ Ekspor CSV</button></div>
                            <div class="filter-toolbar">
                                <label class="search-field"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/></svg><input id="transaction-search" type="search" placeholder="Cari transaksi..."></label>
                                <select id="wallet-filter" aria-label="Filter dompet"><option value="all">Semua dompet</option><option value="Kas Usaha">Kas Usaha</option><option value="Kas Pribadi">Kas Pribadi</option></select>
                                <select id="type-filter" aria-label="Filter jenis transaksi"><option value="all">Semua transaksi</option><option value="income">Pemasukan</option><option value="expense">Pengeluaran</option></select>
                                <button class="text-button reset-button" id="reset-filters">Reset filter</button>
                            </div>
                            <div class="table-wrap">
                                <table class="ledger-table"><thead><tr><th>Transaksi</th><th>Tanggal</th><th>Kategori</th><th>Dompet</th><th class="align-right">Nominal</th><th></th></tr></thead><tbody id="transaction-list"></tbody></table>
                                <div class="empty-state" id="empty-transactions" hidden><span>⌕</span><strong>Transaksi tidak ditemukan</strong><p>Coba ubah kata kunci atau filter Anda.</p></div>
                            </div>
                            <div class="ledger-footer"><span id="transaction-count">Menampilkan transaksi terbaru</span><button class="text-button" data-toast="Semua transaksi demo sudah ditampilkan.">Lihat selengkapnya →</button></div>
                        </section>
                        <section class="audit-card"><div class="audit-copy"><span class="audit-badge">✓</span><div><strong>Audit dompet kas</strong><p>Pemisahan kas usaha dan pribadi membantu menjaga kesehatan keuangan usaha.</p></div></div><div class="audit-bar"><span></span><i></i></div><div class="audit-legend"><span><i class="legend-dot green-dot"></i> Usaha <strong>72%</strong></span><span><i class="legend-dot amber-dot"></i> Pribadi <strong>28%</strong></span><button class="text-button" data-nav="reports">Lihat analisis →</button></div></section>
                    </section>

                    <section class="view-panel" id="view-reports" data-view="reports" hidden>
                        <div class="page-heading">
                            <div><p class="eyebrow">RINGKASAN KEUANGAN</p><h1>Laporan SAK EMKM &amp; KUR</h1><p class="heading-copy">Ringkasan usaha yang siap membantu persiapan pengajuan pembiayaan.</p></div>
                            <button class="button button-outline" data-toast="Periode laporan: Oktober 2024">▦ Oktober 2024 <span>⌄</span></button>
                        </div>
                        <section class="kur-banner">
                            <div class="kur-banner-top"><span class="kur-emblem">✦</span><span>STANDAR PERBANKAN NASIONAL</span><span class="kur-version">SAK EMKM</span></div>
                            <div class="kur-banner-content"><div><h2>Laporan Keuangan Sederhana</h2><h3>(Standar SAK EMKM &amp; Bank KUR)</h3><p>Format otomatis sesuai kriteria verifikator bank tanpa istilah akuntansi yang rumit.</p></div><div class="kur-score"><strong>94</strong><span>/100</span></div></div>
                            <div class="kur-status"><span>✓ Arus kas stabil</span><span>✓ Margin laba 29,5%</span><strong>Tinggi / Siap Ajukan</strong></div>
                        </section>
                        <div class="report-layout">
                            <div class="report-main">
                                <div class="section-title-row report-section-heading"><div><p class="eyebrow">PERFORMA USAHA</p><h2>Ringkasan laba-rugi</h2></div><span class="period-pill">Oktober 2024</span></div>
                                <div class="report-metrics">
                                    <article class="card metric-card"><span class="metric-icon income-icon">↗</span><div class="metric-copy"><span>Total penjualan / uang masuk</span><small>128 transaksi tercatat via suara</small></div><div class="metric-value"><strong>Rp 18.450.000</strong><small class="amount-positive">+14,2% vs Sep</small></div></article>
                                    <article class="card metric-card"><span class="metric-icon expense-icon">▤</span><div class="metric-copy"><span>Biaya belanja dagangan</span><small>Kulakan sembako &amp; grosir harian</small></div><div class="metric-value"><strong>Rp 11.200.000</strong><small>60,7% dari omzet</small></div></article>
                                    <article class="card metric-card"><span class="metric-icon personal-icon">▥</span><div class="metric-copy"><span>Biaya operasional</span><small>Listrik, plastik, sewa tempat, bensin</small></div><div class="metric-value"><strong>Rp 1.800.000</strong><small>Terkontrol aman</small></div></article>
                                </div>
                                <article class="profit-banner"><div class="profit-banner-heading"><span>✦</span><div><small>KEUNTUNGAN BERSIH USAHA</small><strong>(LABA BERSIH)</strong></div><span class="margin-pill">MARGIN 29,5%</span></div><strong class="profit-total">Rp 5.450.000</strong><p>Uang bersih hasil usaha yang siap dipakai mencicil angsuran KUR.</p><div class="dscr"><span>Rasio Kapasitas Bayar (DSCR)</span><strong>3,02x · Sangat Layak</strong></div></article>
                            </div>
                            <aside class="card assets-card"><div class="section-title-row"><div><p class="eyebrow">INFORMASI TAMBAHAN</p><h2>Data neraca</h2></div><span class="sync-tag">Auto-sync</span></div><p class="assets-intro">Data pendukung untuk lampiran pengajuan KUR SAK EMKM.</p><label>Saldo kas &amp; rekening toko<div class="asset-input"><span>Rp</span><strong>3.850.000</strong><span>▣</span></div></label><small class="asset-note">Uang tunai di laci kasir + rekening toko</small><div class="asset-pair"><label>Utang supplier<div class="asset-input"><span>Rp</span><strong>1.500.000</strong></div><small class="asset-warning">Jatuh tempo 7 hari</small></label><label>Piutang pelanggan<div class="asset-input"><span>Rp</span><strong>400.000</strong></div><small>3 langganan tetap</small></label></div><label>Estimasi aset &amp; inventaris<div class="asset-input"><span>Rp</span><strong>24.500.000</strong><span>▦</span></div></label><small class="asset-note">Etalase kaca, freezer, motor operasional</small></aside>
                        </div>
                        <div class="report-callout"><span class="callout-seal">SAK<br>EMKM</span><div><strong>Format resmi lampiran bank</strong><p>Data pembukuan tersusun untuk membantu proses verifikasi dan rekapitulasi operasional.</p></div><span class="callout-tag">KUR 2024</span></div>
                        <div class="report-actions"><button class="button button-primary report-download" id="download-report">↓ Unduh PDF laporan siap KUR (SAK EMKM)</button><button class="button button-outline" data-toast="Fitur berbagi laporan akan tersedia setelah akun terhubung.">▥ Bagikan rekap kas ke akuntan / pendamping UMKM</button></div>
                        <p class="report-disclaimer">Laporan ini merupakan ringkasan pembukuan dan bukan jaminan persetujuan pinjaman.</p>
                    </section>

                    <section class="view-panel" id="view-settings" data-view="settings" hidden>
                        <div class="page-heading"><div><p class="eyebrow">PREFERENSI APLIKASI</p><h1>Pengaturan &amp; privasi</h1><p class="heading-copy">Kelola profil toko, kebiasaan pencatatan, dan data Anda.</p></div><span class="status-pill"><i></i> Semua data tersinkron</span></div>
                        <div class="settings-grid">
                            <section class="card settings-card profile-settings-card"><div class="section-title-row"><div class="settings-title"><span class="settings-icon">⌂</span><div><h2>Akun &amp; profil toko</h2><p>Informasi usaha yang tersimpan di perangkat ini</p></div></div><button class="text-button" data-open-onboarding>Ubah profil</button></div><div class="shop-profile"><span class="large-shop-avatar">⌂</span><div><span class="profile-id">ID: UMKM-IBR-849</span><h3>Warung Bu Sri</h3><p>Sembako &amp; kuliner harian · Pasar Kranggan</p></div></div><div class="storage-grid"><div class="storage-tile"><span>Penyimpanan lokal <b>▣</b></span><strong><span id="saved-count">142</span> Data</strong><small>Tersedia tanpa internet</small></div><div class="storage-tile"><span>Google Drive Cloud <b>↻</b></span><strong>Aktif terhubung</strong><small>Sinkron terakhir 10:45 WIB</small></div></div></section>
                            <section class="card settings-card reminder-card"><div class="section-title-row"><div class="settings-title"><span class="settings-icon">♧</span><div><h2>Pengingat ramah</h2><p>Notifikasi ringan agar pencatatan tidak terlewat</p></div></div></div><label class="reminder-row"><span class="reminder-symbol">◷</span><span class="reminder-copy"><strong>Pengingat tutup toko harian</strong><small>Ingatkan saya merekap sisa uang kas sebelum tidur.</small></span><span class="reminder-time">20:00 WIB</span><input type="checkbox" class="toggle-input" checked aria-label="Pengingat tutup toko harian"><span class="toggle-switch"></span></label><label class="reminder-row"><span class="reminder-symbol">▤</span><span class="reminder-copy"><strong>Ringkasan laba mingguan</strong><small>Dikirim setiap Ahad pagi melalui WhatsApp.</small></span><span class="reminder-time">WhatsApp</span><input type="checkbox" class="toggle-input" checked aria-label="Ringkasan laba mingguan"><span class="toggle-switch"></span></label></section>
                            <section class="card settings-card data-card"><div class="section-title-row"><div class="settings-title"><span class="settings-icon">▣</span><div><h2>Manajemen &amp; cadangan data</h2><p>Kelola berkas pembukuan kas warung Anda.</p></div></div></div><button class="export-tile" id="export-backup"><span class="export-icon">↓</span><span><strong>Ekspor transaksi demo</strong><small>Unduh transaksi yang tampil dalam format CSV</small></span><span>›</span></button><div class="privacy-box"><div class="privacy-heading"><span>⚠</span><div><strong>Hapus transaksi demo</strong><p>Hapus daftar transaksi contoh dari tampilan ini.</p></div></div><button class="button button-danger" id="clear-data">Hapus data demo</button></div></section>
                            <section class="card privacy-card"><span class="privacy-shield">✓</span><div><p class="eyebrow">PRIVASI ANDA</p><h2>Data tetap milik Anda</h2><p>SoraFin hanya memproses contoh transaksi pada sesi browser ini. Jangan masukkan data pribadi atau keuangan sensitif ke dalam demo.</p></div></section>
                        </div>
                        <p class="settings-footer">SoraFin · Antarmuka demo UI/UX<br><span>Dirancang ramah pedagang Indonesia</span></p>
                    </section>
                </main>
            </div>
        </div>

        <nav class="mobile-nav" aria-label="Navigasi seluler">
            <button class="mobile-nav-link is-active" data-nav="home"><span>⌂</span>Beranda</button>
            <button class="mobile-nav-link" data-nav="transactions"><span>▤</span>Transaksi</button>
            <button class="mobile-nav-link" data-nav="reports"><span>▥</span>Laporan KUR</button>
            <button class="mobile-nav-link" data-nav="settings"><span>⚙</span>Pengaturan</button>
        </nav>

        <div class="modal-backdrop" id="transaction-modal" hidden>
            <section class="modal-card transaction-modal" role="dialog" aria-modal="true" aria-labelledby="transaction-modal-title">
                <div class="modal-heading"><div><span class="status-pill"><i></i> AI siap membantu</span><h2 id="transaction-modal-title">Catat transaksi</h2></div><button class="icon-button modal-close" data-close-modal aria-label="Tutup">×</button></div>
                <div class="ai-quote"><span>✦</span><div><strong>CONTOH PENGENALAN SUARA</strong><p id="voice-transcript">Ketik transaksi Anda, lalu simpan ke buku kas.</p></div></div>
                <form id="transaction-form">
                    <label class="form-label">Deskripsi transaksi<input id="transaction-description" name="description" required placeholder="Contoh: Penjualan paket sembako"></label>
                    <div class="form-pair"><label class="form-label">Nominal (rupiah)<input id="transaction-amount" name="amount" type="number" min="1" step="1" required placeholder="150000"></label><label class="form-label">Jenis transaksi<select id="transaction-type" name="type"><option value="expense">Pengeluaran</option><option value="income">Pemasukan</option></select></label></div>
                    <label class="form-label">Dompet kas<select id="transaction-wallet" name="wallet"><option>Kas Usaha</option><option>Kas Pribadi</option></select></label>
                    <div class="modal-actions"><button class="button button-outline" type="button" data-close-modal>Batal</button><button class="button button-primary" type="submit">✓ Simpan ke buku kas</button></div>
                </form>
            </section>
        </div>

        <div class="modal-backdrop" id="onboarding-modal" hidden>
            <section class="modal-card onboarding-modal" role="dialog" aria-modal="true" aria-labelledby="onboarding-title">
                <div class="modal-heading"><div><span class="eyebrow">PROFIL USAHA</span><h2 id="onboarding-title">Kenali usaha Anda</h2></div><button class="icon-button modal-close" data-close-modal aria-label="Tutup">×</button></div>
                <p class="heading-copy">Lengkapi profil agar ringkasan pembukuan demo lebih sesuai.</p>
                <form id="profile-form">
                    <label class="form-label">Nama usaha<input id="shop-name-input" value="Warung Bu Sri" required></label>
                    <label class="form-label">Jenis usaha<select id="shop-type-input"><option>Toko kelontong</option><option>Kuliner &amp; warung</option><option>Jasa &amp; laundry</option><option>Fashion &amp; kriya</option></select></label>
                    <div class="privacy-box onboarding-privacy"><strong>Privasi &amp; data</strong><p>Ini hanya demo tampilan. Profil tidak dikirim ke server atau disimpan setelah halaman ditutup.</p></div>
                    <div class="modal-actions"><button class="button button-outline" type="button" data-close-modal>Batal</button><button class="button button-primary" type="submit">✓ Simpan profil</button></div>
                </form>
            </section>
        </div>

        <div class="toast-message" id="toast-message" role="status" aria-live="polite"></div>
    </body>
</html>
