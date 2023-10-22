<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
</head>
<body>
    <h1>Results</h1>
    <ol>
        @foreach ($links as $index => $link)
            @if (parse_url($link, PHP_URL_HOST) == $homePageDomain)
                <li>{{ $link }}</li>
                <ul>
                    @for ($i = $index + 1; $i < count($links); $i++)
                        {{-- Access the link using $links[$i] --}}
                        @if (parse_url($links[$i], PHP_URL_HOST) == $homePageDomain)
                            @break
                        @elseif (Str::contains($links[$i], $domain_name))
                            <li>{{ $links[$i] }}</li>
                        @endif
                    @endfor
                </ul>
            @endif
        @endforeach
    </ol>
</body>
</html>

