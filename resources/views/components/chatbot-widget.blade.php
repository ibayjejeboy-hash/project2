<div id="chatbot-container" class="fixed bottom-6 right-6 z-[9999] font-sans">
    
    {{-- Chat Button --}}
    <button id="chatbot-toggle" class="w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full shadow-2xl flex items-center justify-center text-white hover:scale-110 transition-transform duration-300 focus:outline-none focus:ring-4 focus:ring-green-300">
        <i class="fa-solid fa-robot text-2xl"></i>
    </button>

    {{-- Chat Window --}}
    <div id="chatbot-window" class="hidden absolute bottom-16 right-0 w-[85vw] sm:w-96 bg-white rounded-2xl shadow-2xl border border-gray-100 flex flex-col overflow-hidden transition-all duration-300 opacity-0 translate-y-4 max-h-[75vh]">
        
        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4 text-white flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-robot text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm">Asisten Virtual RA</h3>
                    <p class="text-[10px] text-green-100 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-300 animate-pulse"></span> Online
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-1">
                <button id="chatbot-clear" title="Hapus Obrolan" class="text-white/80 hover:text-white p-2">
                    <i class="fa-solid fa-trash-can text-sm"></i>
                </button>
                <button id="chatbot-close" class="text-white/80 hover:text-white p-2">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
        </div>

        {{-- Messages Area --}}
        <div id="chatbot-messages" class="flex-1 p-4 overflow-y-auto bg-slate-50 space-y-4 text-sm h-[350px]">
            {{-- Messages will be loaded here by JS --}}
        </div>

        {{-- Input Area --}}
        <div class="p-3 bg-white border-t border-gray-100 flex items-end gap-2 relative shrink-0">
            <textarea id="chatbot-input" rows="1" placeholder="Ketik pertanyaan Anda..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 resize-none max-h-24 overflow-y-auto placeholder:text-slate-400"></textarea>
            <button id="chatbot-send" class="w-10 h-10 shrink-0 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="fa-solid fa-paper-plane text-xs"></i>
            </button>
        </div>
        
        {{-- Footer Branding --}}
        <div class="text-center py-1.5 bg-slate-50 text-[9px] text-slate-400 font-medium border-t border-gray-100 shrink-0">
            Powered by Google Gemini AI <i class="fa-solid fa-sparkles text-yellow-400"></i>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('chatbot-toggle');
    const closeBtn = document.getElementById('chatbot-close');
    const clearBtn = document.getElementById('chatbot-clear');
    const windowEl = document.getElementById('chatbot-window');
    const sendBtn = document.getElementById('chatbot-send');
    const inputEl = document.getElementById('chatbot-input');
    const messagesEl = document.getElementById('chatbot-messages');

    const STORAGE_KEY = 'ra_chatbot_messages';
    let chatHistory = [];

    // Load Chat History
    function loadChatHistory() {
        messagesEl.innerHTML = ''; // Clear container
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved) {
            chatHistory = JSON.parse(saved);
            chatHistory.forEach(msg => {
                renderMessageDOM(msg.text, msg.sender);
            });
        } else {
            // Default Welcome Message
            const welcomeText = "Halo Ayah/Bunda! 👋\nSaya adalah Asisten Virtual RA Al-Musyafallahi. Ada yang bisa saya bantu terkait pendaftaran atau info sekolah?";
            addMessage(welcomeText, 'bot');
        }
        scrollToBottom();
    }

    // Toggle Chat Window
    function toggleChat() {
        if (windowEl.classList.contains('hidden')) {
            windowEl.classList.remove('hidden');
            setTimeout(() => {
                windowEl.classList.remove('opacity-0', 'translate-y-4');
                inputEl.focus();
                scrollToBottom();
            }, 10);
            toggleBtn.innerHTML = '<i class="fa-solid fa-xmark text-2xl"></i>';
        } else {
            windowEl.classList.add('opacity-0', 'translate-y-4');
            setTimeout(() => {
                windowEl.classList.add('hidden');
            }, 300);
            toggleBtn.innerHTML = '<i class="fa-solid fa-robot text-2xl"></i>';
        }
    }

    toggleBtn.addEventListener('click', toggleChat);
    closeBtn.addEventListener('click', toggleChat);

    // Clear Chat
    clearBtn.addEventListener('click', function() {
        if(confirm('Hapus semua percakapan?')) {
            localStorage.removeItem(STORAGE_KEY);
            chatHistory = [];
            loadChatHistory();
        }
    });

    // Auto-resize textarea
    inputEl.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Send Message
    async function sendMessage() {
        const message = inputEl.value.trim();
        if (!message) return;

        // Reset input
        inputEl.value = '';
        inputEl.style.height = 'auto';
        inputEl.focus();

        // Add user message to UI
        addMessage(message, 'user');

        // Disable button & show typing indicator
        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i>';
        
        const typingId = addTypingIndicator();

        try {
            const response = await fetch('{{ route("chat") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            
            // Remove typing indicator
            const typingEl = document.getElementById(typingId);
            if(typingEl) typingEl.remove();

            if (response.ok) {
                addMessage(data.reply, 'bot');
            } else {
                addMessage('Maaf, saya sedang mengalami kendala jaringan. ' + (data.error || ''), 'bot');
            }
        } catch (error) {
            const typingEl = document.getElementById(typingId);
            if(typingEl) typingEl.remove();
            addMessage('Maaf, server sedang sibuk atau offline.', 'bot');
        } finally {
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="fa-solid fa-paper-plane text-xs"></i>';
        }
    }

    // Send on Enter
    inputEl.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    sendBtn.addEventListener('click', sendMessage);

    function addMessage(text, sender) {
        chatHistory.push({ text: text, sender: sender });
        localStorage.setItem(STORAGE_KEY, JSON.stringify(chatHistory));
        renderMessageDOM(text, sender);
    }

    function renderMessageDOM(text, sender) {
        const div = document.createElement('div');
        div.className = 'flex gap-2.5 ' + (sender === 'user' ? 'flex-row-reverse' : '');
        
        // Escape HTML
        let escapedText = text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br>");
        
        // Buat URL menjadi link clickable (opsional, tapi disarankan)
        const urlRegex = /(https?:\/\/[^\s]+)/g;
        escapedText = escapedText.replace(urlRegex, function(url) {
            return '<a href="' + url + '" target="_blank" class="underline hover:text-green-200 break-words">' + url + '</a>';
        });
        
        let avatar = '';
        let bubble = '';
        
        if (sender === 'bot') {
            avatar = `<div class="w-8 h-8 rounded-full bg-gradient-to-tr from-green-500 to-emerald-500 flex items-center justify-center text-white shrink-0 mt-1 shadow-sm"><i class="fa-solid fa-robot text-[10px]"></i></div>`;
            bubble = `<div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border border-slate-100 text-slate-700 max-w-[85%] leading-relaxed break-words overflow-hidden">${escapedText}</div>`;
        } else {
            avatar = `<div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 shrink-0 mt-1 shadow-sm"><i class="fa-solid fa-user text-[10px]"></i></div>`;
            bubble = `<div class="bg-gradient-to-r from-green-500 to-emerald-600 p-3 rounded-2xl rounded-tr-none shadow-sm text-white max-w-[85%] leading-relaxed break-words overflow-hidden">${escapedText}</div>`;
        }

        div.innerHTML = avatar + bubble;
        messagesEl.appendChild(div);
        scrollToBottom();
    }

    function addTypingIndicator() {
        const id = 'typing-' + Date.now();
        const div = document.createElement('div');
        div.id = id;
        div.className = 'flex gap-2.5';
        div.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-green-500 to-emerald-500 flex items-center justify-center text-white shrink-0 mt-1 shadow-sm">
                <i class="fa-solid fa-robot text-[10px]"></i>
            </div>
            <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border border-slate-100 text-slate-700 max-w-[85%] flex items-center gap-1.5 h-10">
                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce"></span>
                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
            </div>
        `;
        messagesEl.appendChild(div);
        scrollToBottom();
        return id;
    }

    function scrollToBottom() {
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    // Initialize
    loadChatHistory();
});
</script>
