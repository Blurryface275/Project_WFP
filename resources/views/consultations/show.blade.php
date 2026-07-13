@extends(in_array(Auth::user()->role, ['admin', 'doctor']) ? 'layouts.admincoreui-app' : 'layouts.member-app')
@section('title', 'Chat Konsultasi')
@section('page-title', 'Sesi Chat dengan Pasien: ' . ($consultation->user->name ?? 'Pasien'))

@push('styles')
<style>
    .chat-wrapper {
        background: #f0f4f8;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    }
    .chat-header {
        background: linear-gradient(135deg, #e23b3b 0%, #c0392b 100%);
        color: white;
        padding: 16px 20px;
    }
    .chat-header .badge-status {
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
    }
    .badge-active {
        background: rgba(255,255,255,0.25);
        color: white;
        border: 1px solid rgba(255,255,255,0.5);
    }
    .badge-completed {
        background: rgba(0,0,0,0.2);
        color: white;
    }
    .chat-box {
        height: 420px;
        overflow-y: auto;
        background-color: #f8f9fa;
        padding: 20px;
    }
    .chat-box::-webkit-scrollbar {
        width: 5px;
    }
    .chat-box::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .chat-box::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }
    .message-container {
        margin-bottom: 14px;
        animation: fadeIn 0.2s ease-in;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .message-bubble {
        padding: 10px 16px;
        border-radius: 18px;
        display: inline-block;
        max-width: 75%;
        word-wrap: break-word;
        line-height: 1.5;
    }
    .message-me .message-bubble {
        background: linear-gradient(135deg, #e23b3b, #c0392b);
        color: white;
        border-bottom-right-radius: 4px;
    }
    .message-other .message-bubble {
        background-color: white;
        color: #333;
        border-bottom-left-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    .message-system .message-bubble {
        background-color: rgba(255,193,7,0.15);
        color: #856404;
        font-size: 0.8em;
        font-weight: 600;
        border-radius: 10px;
        padding: 4px 14px;
        border: 1px solid rgba(255,193,7,0.3);
    }
    .message-me { text-align: right; }
    .message-other { text-align: left; }
    .message-system { text-align: center; margin: 16px 0; }
    .message-time {
        font-size: 0.68em;
        color: #aaa;
        margin-top: 4px;
    }
    .chat-input-area {
        background: white;
        padding: 14px 16px;
        border-top: 1px solid #e9ecef;
    }
    .chat-ended-notice {
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        padding: 16px;
        text-align: center;
        color: #6c757d;
        font-size: 0.9em;
    }
    .sender-name {
        font-size: 0.72em;
        color: #999;
        margin-bottom: 2px;
        font-weight: 600;
    }
    .info-bar {
        background: white;
        border-bottom: 1px solid #e9ecef;
        padding: 10px 16px;
        font-size: 0.85em;
        color: #666;
    }
</style>
@endpush

@section(in_array(Auth::user()->role, ['admin', 'doctor']) ? 'content-admin' : 'content')
@if(!in_array(Auth::user()->role, ['admin', 'doctor']))
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">Konsultasi</span>
          <h1 class="text-capitalize mb-5 text-lg">
            Sesi Chat dengan Dokter: {{ $consultation->doctor->name ?? 'Dokter' }}
          </h1>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Tombol kembali --}}
                <div class="mb-3">
                    @if(Auth::user()->role === 'doctor')
                        <a href="{{ route('doctor.consultations') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="icofont-arrow-left"></i> Kembali ke Daftar Konsultasi
                        </a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="icofont-arrow-left"></i> Kembali ke Daftar Booking
                        </a>
                    @else
                        <a href="{{ route('consultations.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="icofont-arrow-left"></i> Kembali ke Konsultasi Saya
                        </a>
                    @endif
                    <a href="{{ route('consultations.history') }}" class="btn btn-outline-info btn-sm ml-2">
                        <i class="icofont-history"></i> Riwayat Konsultasi
                    </a>
                </div>

                <div class="chat-wrapper">

                    {{-- Header Chat --}}
                    <div class="chat-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">
                                @if(Auth::user()->role === 'doctor')
                                    <i class="icofont-user-alt-4 mr-2"></i>{{ $consultation->user->name ?? 'Pasien' }}
                                @else
                                    <i class="icofont-doctor-alt mr-2"></i>{{ $consultation->doctor->name ?? 'Dokter' }}
                                @endif
                            </h5>
                            <span class="badge-status {{ $consultation->status === 'active' ? 'badge-active' : 'badge-completed' }}">
                                {{ $consultation->status === 'active' ? '● Aktif' : '✓ Selesai' }}
                            </span>
                        </div>

                        {{-- Tombol Tutup Konsultasi (Hanya untuk Dokter) --}}
                        @if($consultation->status === 'active' && Auth::user()->role === 'doctor')
                            <form action="{{ route('consultations.end', $consultation->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin mengakhiri sesi konsultasi ini?');">
                                @csrf
                                <button type="submit" class="btn btn-sm" style="background:rgba(255,255,255,0.2); color:white; border:1px solid rgba(255,255,255,0.5);">
                                    <i class="icofont-power"></i> Tutup Konsultasi
                                </button>
                            </form>
                        @endif
                    </div>

                    {{-- Info Bar: Tanggal Mulai --}}
                    <div class="info-bar d-flex justify-content-between">
                        <span>
                            <i class="icofont-calendar mr-1"></i>
                            Mulai: {{ $consultation->created_at->format('d M Y, H:i') }} WIB
                        </span>
                        <span>
                            <i class="icofont-chat mr-1"></i>
                            {{ $consultation->messages->where('is_system_message', false)->count() }} pesan
                        </span>
                    </div>

                    {{-- Area Chat --}}
                    <div class="chat-box" id="chat-box">
                        @forelse($consultation->messages as $msg)
                            @if($msg->is_system_message)
                                <div class="message-container message-system">
                                    <div class="message-bubble">{{ $msg->message }}</div>
                                </div>
                            @elseif($msg->sender_id === Auth::id())
                                <div class="message-container message-me">
                                    <div class="message-bubble">{{ $msg->message }}</div>
                                    <div class="message-time">{{ $msg->created_at->format('H:i') }}</div>
                                </div>
                            @else
                                <div class="message-container message-other">
                                    <div class="sender-name">{{ $msg->sender->name ?? 'User' }}</div>
                                    <div class="message-bubble">{{ $msg->message }}</div>
                                    <div class="message-time">{{ $msg->created_at->format('H:i') }}</div>
                                </div>
                            @endif
                        @empty
                            <div class="text-center text-muted mt-5">
                                <i class="icofont-chat" style="font-size: 2rem; color: #dee2e6;"></i>
                                <p class="mt-2">Belum ada pesan. Mulai percakapan!</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Input atau Notice Selesai --}}
                    @if($consultation->status === 'active')
                        <div class="chat-input-area">
                            <form id="chat-form" onsubmit="sendMessage(event)">
                                <div class="input-group">
                                    <input type="text" id="message-input" class="form-control"
                                        placeholder="Ketik pesan..." required autocomplete="off"
                                        style="border-radius: 24px 0 0 24px; border-right: none;">
                                    <div class="input-group-append">
                                        <button class="btn btn-main" type="submit" id="send-btn"
                                            style="border-radius: 0 24px 24px 0;">
                                            <i class="icofont-paper-plane"></i> Kirim
                                        </button>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block">
                                    Tekan Enter atau klik Kirim untuk mengirim pesan
                                </small>
                            </form>
                        </div>
                    @else
                        <div class="chat-ended-notice">
                            <i class="icofont-check-circled mr-2" style="color: #28a745;"></i>
                            Sesi konsultasi ini telah berakhir. Riwayat percakapan telah tersimpan.
                        </div>
                    @endif

                </div>{{-- end .chat-wrapper --}}

            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const consultationId = {{ $consultation->id }};
    const currentUserId  = {{ Auth::id() }};
    let lastMessageId    = {{ $consultation->messages->last()?->id ?? 0 }};
    const chatBox        = document.getElementById('chat-box');
    const csrfToken      = '{{ csrf_token() }}';
    const isActive       = {{ $consultation->status === 'active' ? 'true' : 'false' }};

    // ─── Scroll ke bawah ───────────────────────────────────────
    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    scrollToBottom();

    // ─── Format waktu ──────────────────────────────────────────
    function formatTime(dateString) {
        return new Date(dateString).toLocaleTimeString('id-ID', {
            hour: '2-digit', minute: '2-digit'
        });
    }

    // ─── Tambahkan bubble ke chat ──────────────────────────────
    function appendMessage(msg) {
        // Hapus placeholder "belum ada pesan" jika ada
        const emptyState = chatBox.querySelector('.text-center.text-muted');
        if (emptyState) emptyState.remove();

        let html = '';
        if (msg.is_system_message) {
            html = `<div class="message-container message-system">
                        <div class="message-bubble">${msg.message}</div>
                    </div>`;
        } else if (parseInt(msg.sender_id) === currentUserId) {
            html = `<div class="message-container message-me">
                        <div class="message-bubble">${escapeHtml(msg.message)}</div>
                        <div class="message-time">${formatTime(msg.created_at)}</div>
                    </div>`;
        } else {
            const senderName = msg.sender ? msg.sender.name : 'User';
            html = `<div class="message-container message-other">
                        <div class="sender-name">${escapeHtml(senderName)}</div>
                        <div class="message-bubble">${escapeHtml(msg.message)}</div>
                        <div class="message-time">${formatTime(msg.created_at)}</div>
                    </div>`;
        }

        chatBox.insertAdjacentHTML('beforeend', html);
        scrollToBottom();
        lastMessageId = msg.id;
    }

    // ─── Escape HTML untuk keamanan XSS ───────────────────────
    function escapeHtml(str) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    // ─── Kirim pesan ───────────────────────────────────────────
    async function sendMessage(e) {
        e.preventDefault();
        const input = document.getElementById('message-input');
        const btn   = document.getElementById('send-btn');
        const message = input.value.trim();

        if (!message) return;

        input.disabled = true;
        btn.disabled   = true;
        btn.innerHTML  = '<i class="icofont-spinner-alt-2"></i>';

        try {
            const response = await fetch(`/consultations/${consultationId}/message`, {
                method:  'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept':       'application/json'
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                input.value = '';
                appendMessage(data.message);
            } else {
                alert(data.error || 'Gagal mengirim pesan.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan. Coba lagi.');
        } finally {
            input.disabled = false;
            btn.disabled   = false;
            btn.innerHTML  = '<i class="icofont-paper-plane"></i> Kirim';
            input.focus();
        }
    }

    // ─── Polling pesan baru ─────────────────────────────────────
    async function fetchMessages() {
        try {
            const response = await fetch(
                `/consultations/${consultationId}/messages?last_id=${lastMessageId}`,
                { headers: { 'Accept': 'application/json' } }
            );

            const data = await response.json();

            if (response.ok) {
                data.messages?.forEach(msg => appendMessage(msg));

                // Reload jika status berubah jadi completed
                if (data.status !== '{{ $consultation->status }}') {
                    window.location.reload();
                }
            }
        } catch (error) {
            console.error('Polling error:', error);
        }
    }

    // Aktifkan polling hanya jika konsultasi masih aktif
    if (isActive) {
        setInterval(fetchMessages, 3000);
    }

    // Kirim dengan Enter
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('message-input');
        if (input) {
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.getElementById('chat-form').dispatchEvent(new Event('submit'));
                }
            });
        }
    });
</script>
@endpush
