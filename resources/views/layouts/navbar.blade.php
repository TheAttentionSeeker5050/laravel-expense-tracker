<header>
    <nav class="">
        <a class="" href="/">
            <img src="/app-logo.png" alt="Logo" class="logo" width="40">

        </a>
        <ul>
            {{-- if currentNavStatus == category add style .nav-highlight --}}


            <li class="{{ $currentNavStatus == 'category' ? 'nav-option-highlighted' : '' }}">
                <a href="{{ route('categories.index') }}">
                    Budget Categories
                </a>
            </li>
            <li class="{{ $currentNavStatus == 'expense' ? 'nav-option-highlighted' : '' }}">
                <a href="{{ route('expenses.index') }}">
                    Expenses
                </a>
            </li>
        </ul>
    </nav>
</header>
