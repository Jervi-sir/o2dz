<div class="header">
    <!-- #HEADER -->
    <header class="row justify-between">

        <!-- Logo -->
        <div class="logo">
            <a href="{{ route('annonce.find') }}"><img src="images/logo.svg" alt=" "></a>
        </div>

        <!-- Clock -->
        <div class="clock ">
            <div class="time" id="MyClockDisplay" v-text="time">
            </div>
            <div class="date" id="MyDateDisplay" v-text="date">
            </div>
        </div>

        <!-- Hamburder -->
        @include('elements.hamburger2')
    </header>

    <!-- #NAV MENU -->
    <nav id="navigation">
        <!-- top -->
        <ul class="nav-menu">
            <li class="menu-item">
                <a href="{{ route('annonce.find') }}" class="{{ (request()->is('/')) ? 'active' : '' }}">  Accueil</a>
            </li>
            <li class="menu-item">
                <a href="{{ route('annonce.add') }}" class="{{ (request()->is('add')) ? 'active' : '' }}">  Ajouter une annonce</a>
            </li>
            <li class="menu-item">
                <a href="{{ route('annonce.manage') }}" class="{{ (request()->is('manage')) ? 'active' : '' }}">  Gérer mes annoces</a>
            </li>
            <li class="menu-item">
                <a href="{{ route('about') }}" class="{{ (request()->is('about')) ? 'active' : '' }}">  À propos de la page</a>
            </li>
            <li class="menu-item">
                <a href="{{ route('team') }}" class="{{ (request()->is('team')) ? 'active' : '' }}">  À propos de l'équipe</a>
            </li>
        </ul>

        <!-- buttons -->
        <div class="contact-row justify-between">
            <div class="flex-column justify-between ">
                <div class="left">
                    Si vous souhaitez annoncer votre équipement d'oxygène ici, veuillez vous connecter / enregistrer
                </div>
                <div class="btn_cont">
                    <!-- Logout -->
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="contact-btn logout">
                            <a class="no-decration " :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                        </button>
                    </form>
                    @else
                    <!-- Register -->
                    <a href="{{ route('register') }}" class="no-decration">
                        <button class="header-btn" class=" contact-btn mr-0">
                            Register
                        </button>
                    </a>
                    <!-- Login -->
                    
                        <a href="{{ route('login') }}" class="no-decration">
                            <button class="header-btn" class=" contact-btn mr-0">
                                Log in
                            </button>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        <footer>
            Made with <i>♥</i> by :: 2KingsWebsites
        </footer>
    </nav>
</div>
<script>
    /*
    const icons = document.querySelectorAll('.icon');
        icons.forEach(icon => {
            icon.addEventListener('click', (event) => {
                icon.classList.toggle("open");
            });
        });
*/

</script>
<script>
    function showTime() {
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var date = new Date();
            var M = date.getMonth(); // 0 - 23
            var d = date.getDate(); // 0 - 23
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var session = "AM";

            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;

            var time = h + ":" + m;
            var date = d + " " + months[M];

            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;
            document.getElementById("MyDateDisplay").innerText = date;
            document.getElementById("MyDateDisplay").textContent = date;

            setTimeout(showTime, 10000);
        }
        showTime();
</script>
<style>
    .btn_cont {
        margin-left: auto;
    }

    .header-btn:hover {
        cursor: pointer;
        background: #d2e1fa !important;
        color: lightslategray !important;
        transition: 0.5s;
    }

</style>