<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> {{ config('app.developer.app_version') }}
    </div>
    <strong>Copyright &copy; {{ \Illuminate\Support\Carbon::now('asia/dhaka')->format('Y') }} <a target="_blank" href="{{ config('app.developer.web_url') }}">{{ config('app.developer.name') }}</a>.</strong> All rights
    reserved.
</footer>
