<div class="menu-wrapper" onclick="collapse()">
    <div class="hamburger-menu"></div>	  
</div>

<script>
    function collapse()
        {
            $('.hamburger-menu').toggleClass('animate');

            var coll = document.getElementById("navigation");

            if($('#navigation:visible').length == 0) {
                $('#navigation').show();
                //$('#navigation').slideDown();
            } else {
                $('#navigation').hide();
                //$('#navigation').slideUp();
            }
        }
</script>

<style>
    .menu-wrapper {
        width: 38px;
        height: 50px;
        cursor: pointer;
        transition: 0.5s;
    }

    .hamburger-menu,
    .hamburger-menu:after,
    .hamburger-menu:before {
        width: 37px;
        height: 5px;
    }

    .hamburger-menu {
        position: relative;
        border-radius: 20px;
        transform: translateY(17px);
        background: #D3E1FC;
        transition: all 0ms 300ms;
    }
    .hamburger-menu.animate {
        background: rgba(255, 255, 255, 0);
    }

    .hamburger-menu:before {
        content: "";
        border-radius: 20px;
        position: absolute;
        left: 0;
        bottom: 11px;
        background: #D3E1FC;
        transition: bottom 300ms 300ms cubic-bezier(0.23, 1, 0.32, 1), transform 300ms cubic-bezier(0.23, 1, 0.32, 1);
    }

    .hamburger-menu:after {
        content: "";
        border-radius: 20px;
        position: absolute;
        left: 0;
        top: 11px;
        background: #D3E1FC;
        transition: top 300ms 300ms cubic-bezier(0.23, 1, 0.32, 1), transform 300ms cubic-bezier(0.23, 1, 0.32, 1);
    }

    .hamburger-menu.animate:after {
        top: 0;
        transform: rotate(45deg);
        transition: top 300ms cubic-bezier(0.23, 1, 0.32, 1), transform 300ms 300ms cubic-bezier(0.23, 1, 0.32, 1);
    }

    .hamburger-menu.animate:before {
        bottom: 0;
        transform: rotate(-45deg);
        transition: bottom 300ms cubic-bezier(0.23, 1, 0.32, 1), transform 300ms 300ms cubic-bezier(0.23, 1, 0.32, 1);
    }
</style>