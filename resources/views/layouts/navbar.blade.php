<!-- NAVBAR -->
<nav class="navbar is-white" role="navigation" aria-label="main navigation" style="position: fixed; width: 100%; top: 0;">
    <div class="navbar-brand">
        <a class="navbar-item" href="/home">
            <img src="/images/logo.png" width="112" height="28">
        </a>

        <a id="burger_button" role="button" onclick="document.querySelector('#navMenu').classList.toggle('is-active');this.classList.toggle('is-active');" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navMenu" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item unselectable" href="/home">
                Главная
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link unselectable" href="/cars">
                    Машины
                </a>

                <div class="navbar-dropdown unselectable">
                    <a class="navbar-item unselectable" href="/cars">
                        Все
                    </a>
                    <a class="navbar-item unselectable" href="/cars/disassembling">
                        Разбираются
                    </a>
                    <a class="navbar-item unselectable" href="/cars/disassembled">
                        Разобранные
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item unselectable" href="/cars/add">
                        Добавить машину
                    </a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link unselectable" href="/parts">
                    Детали
                </a>

                <div class="navbar-dropdown unselectable">
                    <a class="navbar-item unselectable" href="/parts">
                        Все
                    </a>
                    <a class="navbar-item unselectable" href="/parts/storage">
                        На складе
                    </a>
                    <a class="navbar-item unselectable" href="/parts/sold">
                        Проданные
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item unselectable" href="/parts/add">
                        Добавить деталь
                    </a>
                    <a class="navbar-item unselectable" href="/parts/add_type">
                        Добавить тип детали
                    </a>
                </div>
            </div>

            <a class="navbar-item unselectable" href="/search_by_barcode">
                Поиск по штрихкоду
            </a>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-primary is-rounded unselectable">
                        <span class="icon is-small">
                            <i class="fas fa-user"></i>
                        </span>
                    <strong>{{Auth::user()->name}}</strong>
                    </a>
                    <a href="{{ route('logout') }} " class="button is-primary is-outlined is-rounded" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <span class="icon is-small">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <strong>Выйти</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>