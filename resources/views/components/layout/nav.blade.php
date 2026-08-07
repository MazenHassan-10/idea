<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="/">
                <img src="/images/logo.png" alt="" width="150" alt="Idea logo">
            </a>
        </div>

        <div class="flex gap-x-5">
        
        @auth
            <form method="POST" action="/logout">
             @csrf
                <button class="btn">Log Out</button>
            </form>
        @endauth
        @guest
            <a href="/register" class="btn">Register</a>
            <a href="/login">Sign In</a> 
        @endguest
        </div>
    </div>
</nav>
