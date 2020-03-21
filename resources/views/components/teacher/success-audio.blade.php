@if(session('success_audio'))
    <audio src="{{ asset('audio/success-notification-alert.mp3') }}" autoplay></audio>
@endif
