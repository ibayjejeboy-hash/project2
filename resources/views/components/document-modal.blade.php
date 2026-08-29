{{-- Modal Viewer Dokumen (View-Only) --}}
<div id="document-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" onclick="closeDocumentModal()"></div>
    
    <div class="relative w-full max-w-5xl h-[90vh] mx-4 bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden transform scale-95 transition-transform duration-300" id="document-modal-content">
        {{-- Header Modal --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-slate-50 relative z-20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-700 flex items-center justify-center">
                    <i id="document-modal-icon" class="fa-solid fa-file-pdf text-xl"></i>
                </div>
                <div>
                    <h3 id="document-modal-title" class="font-black text-slate-800 text-lg">Dokumen</h3>
                    <p class="text-xs text-slate-500 font-medium">Mode pratinjau (View-Only)</p>
                </div>
            </div>
            <button onclick="closeDocumentModal()" class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-500 hover:text-red-600 hover:border-red-200 hover:bg-red-50 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        {{-- Iframe Container --}}
        <div class="flex-1 bg-slate-200 relative w-full h-full overflow-hidden" oncontextmenu="return false;">
            <iframe id="document-modal-iframe" 
                    src="" 
                    class="w-full h-full border-0 absolute inset-0 z-0" 
                    frameborder="0"
                    allowfullscreen>
            </iframe>
        </div>
    </div>
</div>

<script>
    function openDocumentModal(title, url, icon = 'fa-file-pdf') {
        const modal = document.getElementById('document-modal');
        const modalContent = document.getElementById('document-modal-content');
        const iframe = document.getElementById('document-modal-iframe');
        const titleEl = document.getElementById('document-modal-title');
        const iconEl = document.getElementById('document-modal-icon');

        // Set content
        titleEl.textContent = title;
        iconEl.className = `fa-solid ${icon} text-xl`;
        
        // If it's a PDF, append toolbar=0
        if(url.toLowerCase().endsWith('.pdf') && !url.includes('#')) {
            url += '#toolbar=0&navpanes=0';
        } else if (!url.toLowerCase().endsWith('.pdf')) {
            // For Excel, Word, etc., use Google Docs Viewer (Requires Public URL)
            // Note: If accessed from localhost/.test domain, Google Viewer won't be able to fetch the file
            const hostname = window.location.hostname;
            if (hostname === 'localhost' || hostname === '127.0.0.1' || hostname.endsWith('.test') || hostname.endsWith('.local')) {
                alert("Peringatan: Dokumen Word/Excel menggunakan Google Docs Viewer yang membutuhkan domain publik. Dokumen mungkin tidak tampil saat diuji di Localhost/domain .test, tapi akan berjalan normal di VPS (Production).");
            }
            url = `https://docs.google.com/gview?url=${encodeURIComponent(url)}&embedded=true`;
        }
        
        iframe.src = url;

        // Show Modal
        modal.classList.remove('hidden');
        // Small delay to allow display:flex to apply before transition
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
        }, 10);
        
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeDocumentModal() {
        const modal = document.getElementById('document-modal');
        const modalContent = document.getElementById('document-modal-content');
        const iframe = document.getElementById('document-modal-iframe');

        // Hide Modal
        modal.classList.add('opacity-0');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            iframe.src = ''; // Clear iframe to stop loading
            document.body.style.overflow = ''; // Restore background scrolling
        }, 300);
    }
</script>
