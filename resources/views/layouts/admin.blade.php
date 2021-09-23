<!DOCTYPE html>
<html>



<head>
    <title>@yield('title')</title>
</head>


<body>
    <div id="app">
        
 {{-- 画面上部に表示するナビゲーションバーです。 --}}
        <nav class="navbar">
            
        </nav>
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>  
</body>



</html>