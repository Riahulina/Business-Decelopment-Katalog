@extends('layouts.bd')
@section('title', 'Chat dengan B-Di – BD')

@section('content')

    <div class="chatpage">
        <div class="chatpage-head">
            <a href="{{ url()->previous() }}" class="chatpage-back"><x-i n="arr" style="transform:rotate(180deg)" /></a>
            <div class="chatbot-avatar"><x-i n="bot" /></div>
            <div>
                <strong>B-Di</strong>
                <span>Business Development Assistant</span>
            </div>
        </div>

        <div class="chatpage-body" id="chatbotBody">
            <div class="chatbot-thread" id="chatbotThread">
                <div class="chatbot-row bot">
                    <div class="chatbot-avatar sm"><x-i n="bot" /></div>
                    <div class="chatbot-message bot-message">
                        <strong>Halo! 👋</strong>
                        <p>Ada yang bisa dibantu? Ketik pertanyaanmu, atau pilih salah satu di bawah ini.</p>
                    </div>
                </div>
            </div>
            <div class="chatbot-chips" id="chatbotChips">
                <span class="chatbot-loading">Memuat pertanyaan...</span>
            </div>
        </div>

        <form class="chatbot-input" id="chatbotForm">
            <input type="text" id="chatbotText" placeholder="Tanya B-Di tentang Business Development..."
                autocomplete="off">
            <button type="submit" aria-label="Kirim"><x-i n="arr" /></button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chipsBox = document.getElementById('chatbotChips');
            const thread = document.getElementById('chatbotThread');
            const body = document.getElementById('chatbotBody');
            const form = document.getElementById('chatbotForm');
            const input = document.getElementById('chatbotText');

            let faqs = [];

            loadFaq();

            async function loadFaq() {
                try {
                    const res = await fetch('{{ route('chatbot.faqs') }}');
                    if (!res.ok) throw new Error('Gagal mengambil FAQ');
                    faqs = await res.json();
                    renderChips(faqs);
                } catch (e) {
                    chipsBox.innerHTML = '<div class="chatbot-error">FAQ belum dapat dimuat.</div>';
                    console.error('Chatbot Error:', e);
                }
            }

            function renderChips(list) {
                chipsBox.innerHTML = '';
                if (!list.length) {
                    chipsBox.innerHTML = '<div class="chatbot-error">Belum ada pertanyaan yang tersedia.</div>';
                    return;
                }
                list.slice(0, 6).forEach(function(faq) {
                    const b = document.createElement('button');
                    b.type = 'button';
                    b.className = 'chatbot-question';
                    b.textContent = faq.question;
                    b.addEventListener('click', () => ask(faq.question, faq));
                    chipsBox.appendChild(b);
                });
            }

            function addRow(text, who) {
                const row = document.createElement('div');
                row.className = 'chatbot-row ' + who;
                if (who === 'bot') {
                    row.innerHTML = `<div class="chatbot-avatar sm"><svg class="i"><use href="#i-bot"/></svg></div>
                <div class="chatbot-message bot-message">${escapeHtml(text)}</div>`;
                } else {
                    row.innerHTML = `<div class="chatbot-message user-message">${escapeHtml(text)}</div>`;
                }
                thread.appendChild(row);
                body.scrollTop = body.scrollHeight;
            }

            function ask(questionText, matched) {
                addRow(questionText, 'user');
                const faq = matched || findBestMatch(questionText);
                setTimeout(() => {
                    if (faq) {
                        addRow(faq.answer, 'bot');
                    } else {
                        addRow('Maaf, aku belum punya jawaban untuk itu. Coba tanya hal lain, atau hubungi tim BD lewat halaman Kontak ya.',
                            'bot');
                    }
                    renderChips(faqs);
                    body.scrollTop = body.scrollHeight;
                }, 300);
            }

            function findBestMatch(text) {
                const words = text.toLowerCase().split(/\s+/).filter(w => w.length > 2);
                if (!words.length) return null;
                let best = null,
                    bestScore = 0;
                faqs.forEach(faq => {
                    const target = (faq.question + ' ' + faq.answer).toLowerCase();
                    let score = 0;
                    words.forEach(w => {
                        if (target.includes(w)) score++;
                    });
                    if (score > bestScore) {
                        bestScore = score;
                        best = faq;
                    }
                });
                return bestScore > 0 ? best : null;
            }

            form?.addEventListener('submit', function(e) {
                e.preventDefault();
                const text = input.value.trim();
                if (!text) return;
                ask(text);
                input.value = '';
            });

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }
        });
    </script>
@endpush
