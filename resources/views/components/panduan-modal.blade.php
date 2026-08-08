{{-- =========================================================
     MODAL PUSAT PANDUAN & BANTUAN PENGGUNA (GURU & ADMIN)
     RA AL-MUSYAFALLAHI
========================================================= --}}
<div id="panduanHelpModal" 
     class="fixed inset-0 z-50 hidden overflow-y-auto" 
     aria-labelledby="modal-title" 
     role="dialog" 
     aria-modal="true">
    
    {{-- Backdrop Overlay --}}
    <div class="fixed inset-0 bg-slate-950/75 backdrop-blur-sm transition-opacity duration-300"
         onclick="closePanduanModal()"></div>

    <div class="flex min-h-full items-center justify-center p-3 sm:p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full max-w-4xl border border-slate-200 flex flex-col max-h-[90vh]">
            
            {{-- MODAL HEADER --}}
            <div class="p-5 sm:p-6 bg-gradient-to-r from-slate-900 via-emerald-950 to-green-900 text-white relative flex-shrink-0">
                {{-- Decorative Glow --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-lime-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex items-start justify-between gap-4 relative z-10">
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-lime-400 to-emerald-400 text-slate-950 flex items-center justify-center text-xl font-black shadow-lg shadow-lime-400/20 flex-shrink-0">
                            <i class="fa-solid fa-circle-question"></i>
                        </div>
                        <div>
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/10 text-lime-300 text-[11px] font-extrabold uppercase tracking-wider mb-1">
                                <i class="fa-solid fa-book-open text-[10px]"></i> Pusat Panduan &amp; Bantuan
                            </div>
                            <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight" id="modal-title">
                                Panduan Penggunaan Sistem
                            </h3>
                            <p class="text-xs text-slate-300 mt-0.5">
                                Petunjuk lengkap cara mengelola data sekolah, input nilai E-Rapor, dan solusi kendala teknis.
                            </p>
                        </div>
                    </div>
                    
                    <button type="button" 
                            onclick="closePanduanModal()" 
                            class="rounded-xl p-2 text-slate-400 hover:text-white hover:bg-white/10 transition-colors focus:outline-none flex-shrink-0">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                {{-- Quick Search Input --}}
                <div class="mt-5 relative z-10">
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input type="text" 
                               id="panduanSearchInput" 
                               onkeyup="filterPanduanTopics()"
                               placeholder="Ketik topik bantuan... (contoh: input nilai, cetak pdf, tambah siswa, p5, ppdb, akun)" 
                               class="w-full pl-11 pr-4 py-3 bg-white/10 border border-white/20 rounded-2xl text-xs sm:text-sm text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-lime-400 focus:bg-slate-900/90 transition shadow-inner">
                    </div>
                </div>

                {{-- Category Navigation Tabs --}}
                <div class="flex items-center gap-2 mt-4 overflow-x-auto pb-1 text-xs no-scrollbar relative z-10">
                    <button onclick="switchPanduanTab('all')" 
                            id="tab-btn-all"
                            class="panduan-tab-btn px-4 py-2 rounded-xl font-bold bg-lime-400 text-slate-950 transition whitespace-nowrap shadow-sm">
                        <i class="fa-solid fa-layer-group mr-1.5"></i> Semua Panduan
                    </button>
                    <button onclick="switchPanduanTab('erapor')" 
                            id="tab-btn-erapor"
                            class="panduan-tab-btn px-4 py-2 rounded-xl font-bold bg-white/10 hover:bg-white/20 text-white transition whitespace-nowrap">
                        <i class="fa-solid fa-graduation-cap mr-1.5 text-lime-300"></i> Panduan Guru (E-Rapor)
                    </button>
                    <button onclick="switchPanduanTab('admin')" 
                            id="tab-btn-admin"
                            class="panduan-tab-btn px-4 py-2 rounded-xl font-bold bg-white/10 hover:bg-white/20 text-white transition whitespace-nowrap">
                        <i class="fa-solid fa-shield-halved mr-1.5 text-lime-300"></i> Panduan Admin Sekolah
                    </button>
                    <button onclick="switchPanduanTab('faq')" 
                            id="tab-btn-faq"
                            class="panduan-tab-btn px-4 py-2 rounded-xl font-bold bg-white/10 hover:bg-white/20 text-white transition whitespace-nowrap">
                        <i class="fa-solid fa-circle-question mr-1.5 text-lime-300"></i> Tanya Jawab (FAQ)
                    </button>
                </div>
            </div>

            {{-- MODAL BODY (SCROLLABLE) --}}
            <div class="p-5 sm:p-6 overflow-y-auto space-y-6 flex-1 text-slate-700 text-xs sm:text-sm bg-slate-50/50" id="panduanContentArea">

                {{-- ================= SECTION 1: PANDUAN GURU / E-RAPOR ================= --}}
                <div class="panduan-section space-y-4" data-category="erapor">
                    <div class="flex items-center gap-2 border-b border-slate-200 pb-2">
                        <div class="w-8 h-8 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-black">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-900 text-base">Panduan E-Rapor &amp; Penilaian (Guru / Ustadzah)</h4>
                            <p class="text-[11px] text-slate-500">Langkah-langkah pengisian capaian pembelajaran dan penilaian kurikulum merdeka PAUD/RA</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        {{-- Card 1: Cara Input Nilai --}}
                        <div class="panduan-card bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-300 transition space-y-3">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-black flex items-center justify-center">1</span>
                                <h5 class="font-extrabold text-slate-900">Cara Memulai Input Nilai Siswa</h5>
                            </div>
                            <ol class="list-decimal ml-5 space-y-1.5 text-slate-600 leading-relaxed text-xs">
                                <li>Masuk ke menu <strong class="text-slate-800">E-Rapor &amp; Penilaian</strong> &rarr; pilih <strong class="text-slate-800">Input Nilai</strong>.</li>
                                <li>Pilih nama siswa dari dropdown atau daftar yang tersedia.</li>
                                <li>Isi deskripsi narasi capaian pembelajaran:
                                    <ul class="list-disc ml-4 mt-1 text-slate-500 space-y-0.5">
                                        <li><strong>Nilai Agama &amp; Budi Pekerti</strong> (Ibadah, hafalan surah, doa).</li>
                                        <li><strong>Jati Diri</strong> (Kemandirian, motorik, emosi anak).</li>
                                        <li><strong>Literasi &amp; STEAM</strong> (Mengenal huruf, angka, karya seni).</li>
                                    </ul>
                                </li>
                            </ol>
                        </div>

                        {{-- Card 2: Skala Nilai P5 & PPRA --}}
                        <div class="panduan-card bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-300 transition space-y-3">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-black flex items-center justify-center">2</span>
                                <h5 class="font-extrabold text-slate-900">Penilaian P5 &amp; PPRA</h5>
                            </div>
                            <p class="text-xs text-slate-600">Pilih opsi capaian pada setiap indikator profil pelajar:</p>
                            <div class="grid grid-cols-2 gap-2 text-[11px]">
                                <div class="p-2 bg-emerald-50 text-emerald-900 rounded-xl border border-emerald-200">
                                    <strong>BSB (Sangat Baik)</strong>
                                    <span class="block text-[10px] text-emerald-700">Berkembang Sangat Baik</span>
                                </div>
                                <div class="p-2 bg-blue-50 text-blue-900 rounded-xl border border-blue-200">
                                    <strong>BSH (Sesuai Harapan)</strong>
                                    <span class="block text-[10px] text-blue-700">Berkembang Sesuai Harapan</span>
                                </div>
                                <div class="p-2 bg-amber-50 text-amber-900 rounded-xl border border-amber-200">
                                    <strong>MB (Mulai Berkembang)</strong>
                                    <span class="block text-[10px] text-amber-700">Tahap Awal Pembiasaan</span>
                                </div>
                                <div class="p-2 bg-rose-50 text-rose-900 rounded-xl border border-rose-200">
                                    <strong>BB (Belum Berkembang)</strong>
                                    <span class="block text-[10px] text-rose-700">Perlu Bimbingan Tambahan</span>
                                </div>
                            </div>
                        </div>

                        {{-- Card 3: Preview & Cetak Rapor --}}
                        <div class="panduan-card bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-300 transition space-y-3">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-black flex items-center justify-center">3</span>
                                <h5 class="font-extrabold text-slate-900">Melihat Hasil &amp; Cetak PDF</h5>
                            </div>
                            <ul class="space-y-1.5 text-xs text-slate-600">
                                <li class="flex items-start gap-2">
                                    <i class="fa-solid fa-check text-emerald-600 mt-0.5"></i>
                                    <span>Setelah form disimpan, sistem otomatis membuka halaman <strong>Ringkasan Hasil Rapor</strong>.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fa-solid fa-file-pdf text-rose-600 mt-0.5"></i>
                                    <span>Klik tombol <strong class="text-slate-800">"Cetak Rapor (PDF)"</strong> untuk mengunduh dokumen siap cetak lengkap dengan Kop Resmi &amp; Lembar Tanda Tangan.</span>
                                </li>
                            </ul>
                        </div>

                        {{-- Card 4: Edit Nilai Siswa --}}
                        <div class="panduan-card bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-300 transition space-y-3">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-black flex items-center justify-center">4</span>
                                <h5 class="font-extrabold text-slate-900">Mengedit Nilai yang Sudah Disimpan</h5>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Jika terdapat revisi atau salah ketik, klik tombol <strong class="text-slate-800">"Edit Nilai"</strong> pada halaman ringkasan rapor siswa, lalu ubah narasi atau pilihan indikator dan klik <strong>Simpan Perubahan</strong>.
                            </p>
                        </div>

                    </div>
                </div>


                {{-- ================= SECTION 2: PANDUAN ADMINISTRATOR ================= --}}
                <div class="panduan-section space-y-4" data-category="admin">
                    <div class="flex items-center gap-2 border-b border-slate-200 pb-2">
                        <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-black">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-900 text-base">Panduan Administrator Sekolah</h4>
                            <p class="text-[11px] text-slate-500">Tata cara pengelolaan data induk, PPDB, ustadzah, galeri, dan akun pengguna</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        {{-- Admin Card 1: Data Siswa --}}
                        <div class="panduan-card bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-blue-300 transition space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-user-graduate text-blue-600"></i>
                                <h5 class="font-extrabold text-slate-900">1. Kelola Data Siswa</h5>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Buka menu <strong class="text-slate-800">Data Siswa</strong> untuk menambah siswa baru, melengkapi NIS, data orang tua (ayah/ibu), nomor telepon, serta penempatan rombel kelas A/B.
                            </p>
                        </div>

                        {{-- Admin Card 2: Data Guru & Kelas --}}
                        <div class="panduan-card bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-blue-300 transition space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-chalkboard-user text-blue-600"></i>
                                <h5 class="font-extrabold text-slate-900">2. Data Guru &amp; Rombel Kelas</h5>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Menu <strong class="text-slate-800">Data Guru</strong> mencatat profil pendidik (NIP, gelar, kontak), sedangkan menu <strong class="text-slate-800">Rombel Kelas</strong> digunakan untuk menentukan wali kelas masing-masing kelompok belajar.
                            </p>
                        </div>

                        {{-- Admin Card 3: Verifikasi PPDB --}}
                        <div class="panduan-card bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-blue-300 transition space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-file-signature text-blue-600"></i>
                                <h5 class="font-extrabold text-slate-900">3. Verifikasi Pendaftaran (PPDB)</h5>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Setiap formulir online yang dikirim calon wali murid akan masuk ke menu <strong class="text-slate-800">Pendaftaran PPDB</strong>. Admin dapat mengubah status menjadi <strong>Diterima</strong> atau <strong>Menunggu</strong>.
                            </p>
                        </div>

                        {{-- Admin Card 4: Galeri & Info --}}
                        <div class="panduan-card bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-blue-300 transition space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-images text-blue-600"></i>
                                <h5 class="font-extrabold text-slate-900">4. Galeri &amp; Profil Sekolah</h5>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Unggah foto dokumentasi kegiatan belajar pada menu <strong class="text-slate-800">Galeri</strong>, dan perbarui Visi, Misi, serta sambutan Kepala RA pada menu <strong class="text-slate-800">Visi &amp; Info</strong>.
                            </p>
                        </div>

                    </div>
                </div>


                {{-- ================= SECTION 3: FAQ & SOLUSI CEPAT ================= --}}
                <div class="panduan-section space-y-4" data-category="faq">
                    <div class="flex items-center gap-2 border-b border-slate-200 pb-2">
                        <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-black">
                            <i class="fa-solid fa-circle-question"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-900 text-base">Pertanyaan yang Sering Diajukan (FAQ)</h4>
                            <p class="text-[11px] text-slate-500">Solusi cepat untuk kendala umum yang sering dihadapi</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        
                        <details class="group bg-white rounded-2xl border border-slate-200 p-4 shadow-sm [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex items-center justify-between cursor-pointer font-extrabold text-slate-900 text-xs sm:text-sm">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-info text-amber-500"></i>
                                    Bagaimana jika nilai di cetak PDF berbeda dengan web?
                                </span>
                                <span class="transition group-open:rotate-180 text-slate-400">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </summary>
                            <p class="mt-3 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                                Sistem sudah diselaraskan secara otomatis. Jika ada perubahan nilai baru, cukup klik tombol <strong>"Cetak Ulang Rapor"</strong> atau refresh halaman untuk mengunduh PDF versi paling mutakhir.
                            </p>
                        </details>

                        <details class="group bg-white rounded-2xl border border-slate-200 p-4 shadow-sm [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex items-center justify-between cursor-pointer font-extrabold text-slate-900 text-xs sm:text-sm">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-lock text-amber-500"></i>
                                    Bagaimana cara reset password guru / admin yang lupa?
                                </span>
                                <span class="transition group-open:rotate-180 text-slate-400">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </summary>
                            <p class="mt-3 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                                Administrator dapat masuk ke menu <strong>Manajemen Akun</strong>, pilih akun yang bersangkutan, dan lakukan ubah password secara langsung.
                            </p>
                        </details>

                        <details class="group bg-white rounded-2xl border border-slate-200 p-4 shadow-sm [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex items-center justify-between cursor-pointer font-extrabold text-slate-900 text-xs sm:text-sm">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-image text-amber-500"></i>
                                    Berapa batas ukuran foto yang bisa diunggah ke Galeri / Profil?
                                </span>
                                <span class="transition group-open:rotate-180 text-slate-400">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            </summary>
                            <p class="mt-3 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                                Format yang disarankan adalah JPG, PNG, atau WEBP dengan ukuran file maksimal <strong>2 MB</strong> per foto agar proses unggah cepat dan hemat penyimpanan server.
                            </p>
                        </details>

                    </div>
                </div>

                {{-- ================= SECTION 4: KONTAK BANTUAN TEKNIS ================= --}}
                <div class="p-5 rounded-3xl bg-gradient-to-r from-emerald-600 to-green-700 text-white shadow-md flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5 text-center sm:text-left">
                        <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md text-white flex items-center justify-center text-2xl flex-shrink-0">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <h5 class="font-black text-sm sm:text-base">Masih Mengalami Kendala Teknis?</h5>
                            <p class="text-xs text-emerald-100 mt-0.5">Hubungi Tim Pengembang (Developer) untuk bantuan langsung via WhatsApp.</p>
                        </div>
                    </div>
                    <a href="https://wa.me/62895333550066?text=Halo%20Developer%20E-Raport%20Al-Musyafallahi,%20saya%20membutuhkan%20bantuan%20teknis%20seputar%20sistem." 
                       target="_blank" rel="noopener noreferrer"
                       class="px-5 py-2.5 bg-white hover:bg-emerald-50 text-emerald-900 font-extrabold rounded-xl shadow-lg transition duration-200 text-xs flex items-center gap-2 flex-shrink-0">
                        <i class="fa-brands fa-whatsapp text-emerald-600 text-base"></i>
                        <span>Chat WhatsApp Bantuan</span>
                    </a>
                </div>

            </div>

            {{-- MODAL FOOTER --}}
            <div class="p-4 bg-slate-100 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500 flex-shrink-0">
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-shield-check text-emerald-600"></i>
                    <span>Sistem E-Raport &amp; Portal RA Al-Musyafallahi v1.0</span>
                </span>
                <button type="button" 
                        onclick="closePanduanModal()" 
                        class="px-5 py-2 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-xl transition">
                    Tutup Panduan
                </button>
            </div>

        </div>
    </div>
</div>

{{-- FLOATING ACTION BUTTON (FAB) FOR HELP IN CORNER --}}
<div class="fixed bottom-6 right-6 z-40">
    <button onclick="openPanduanModal()" 
            title="Bantuan &amp; Panduan Penggunaan"
            class="group relative flex items-center gap-2.5 px-4 py-3 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 hover:to-green-500 text-white font-extrabold rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-emerald-400/30">
        <div class="w-6 h-6 rounded-lg bg-white/20 flex items-center justify-center text-sm group-hover:rotate-12 transition-transform">
            <i class="fa-solid fa-circle-question"></i>
        </div>
        <span class="text-xs font-bold hidden sm:inline-block">Panduan &amp; Bantuan</span>
        
        {{-- Tooltip on hover --}}
        <span class="absolute right-full mr-3 top-1/2 -translate-y-1/2 px-3 py-1.5 bg-slate-900 text-white text-[11px] font-semibold rounded-xl shadow-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none border border-slate-700">
            Butuh Bantuan? Klik di sini
        </span>
    </button>
</div>

{{-- MODAL INTERACTIVE JAVASCRIPT --}}
<script>
    function openPanduanModal(tabCategory = 'all') {
        const modal = document.getElementById('panduanHelpModal');
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (tabCategory !== 'all') {
                switchPanduanTab(tabCategory);
            }
        }
    }

    function closePanduanModal() {
        const modal = document.getElementById('panduanHelpModal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    // Keyboard ESC listener
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closePanduanModal();
        }
    });

    // Tab Switcher
    function switchPanduanTab(category) {
        const buttons = document.querySelectorAll('.panduan-tab-btn');
        buttons.forEach(btn => {
            btn.classList.remove('bg-lime-400', 'text-slate-950');
            btn.classList.add('bg-white/10', 'text-white');
        });

        const activeBtn = document.getElementById('tab-btn-' + category);
        if (activeBtn) {
            activeBtn.classList.remove('bg-white/10', 'text-white');
            activeBtn.classList.add('bg-lime-400', 'text-slate-950');
        }

        const sections = document.querySelectorAll('.panduan-section');
        sections.forEach(sec => {
            if (category === 'all' || sec.getAttribute('data-category') === category) {
                sec.style.display = 'block';
            } else {
                sec.style.display = 'none';
            }
        });
    }

    // Filter / Search function
    function filterPanduanTopics() {
        const input = document.getElementById('panduanSearchInput');
        const filter = input.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.panduan-card, details');

        cards.forEach(card => {
            const text = card.innerText.toLowerCase();
            if (text.includes(filter)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
