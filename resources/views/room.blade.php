<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $room }}</title>
    <style>
        body {
            height: 100vh;
            width: 100vw;
        }
    </style>
</head>

<body>
    <div id="jitsi-container"></div>

    <script src="{{ config('laravel-jitsi.url') }}/external_api.js"></script>
    <script>
        const domain = "{{ config('laravel-jitsi.url') }}"
        const options = {
            roomName: "{{ $room }}",
            width: "100%",
            height: "100%",
            parentNode: document.querySelector('#jitsi-container'),
        };

        @if (! is_null($jwt))
        options.jwt = '{{ $jwt }}';
        @endif

        const api = new JitsiMeetExternalAPI(domain, options);
    </script>
</body>

</html>
