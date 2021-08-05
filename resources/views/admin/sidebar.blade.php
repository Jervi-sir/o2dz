<ul >
  <a href="{{ route('admin.home') }}">
    <li class="{{ (request()->is('Jervi')) ? 'active' : '' }}" > 
    Home
    </li>
  </a>
  <a href="{{ route('admin.users') }}">
    <li class="{{ (request()->is('Jervi/users')) ? 'active' : '' }}" >
    Users
    </li>
  </a>
  <a href="{{ route('admin.articles') }}">
    <li class="{{ (request()->is('Jervi/articles')) ? 'active' : '' }}">
    Articles
    </li>
  </a>
  <a href="{{ route('admin.wilaya') }}">
    <li class="{{ (request()->is('Jervi/wilaya')) ? 'active' : '' }}" >
    Wilaya
    </li>
  </a>
  <a href="{{ route('admin.types') }}">
    <li class="{{ (request()->is('Jervi/types')) ? 'active' : '' }}" >
    Type
    </li>
  </a>
  <a href="{{ route('admin.costs') }}">
    <li class="{{ (request()->is('Jervi/costs')) ? 'active' : '' }}" >
    Cost
    </li>
  </a>
  <a href="{{ route('admin.roles') }}">
    <li class="{{ (request()->is('Jervi/roles')) ? 'active' : '' }}" >
    Roles
    </li>
  </a>
  <a href="{{ route('admin.messages') }}">
    <li class="{{ (request()->is('Jervi/messages')) ? 'active' : '' }}" >
    Messages
    </li>
  </a>
</ul>
<style>
  @import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");
  
  ul {
    background: #2F343D;
    padding: 20px 0 10px 10px;
    border-right: 5px solid #3F83EF;
    width: 150px;
    transition: 0.5s;
    overflow: hidden;
  }

  ul li, a {
    list-style: none;
    padding: 15px;
    padding-right: 0;
    color: white;
    font-size: 15px;
    margin-bottom: 10px;
    cursor: pointer;
    position: relative;
    transition: 0.5s;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
  }

  ul li:hover {
    transition: 0s;
    background: #242932;
  }

  ul li.active:before {
    content: '';
    position: absolute;
    top:-20px;
    right: 0px;
    width: 20px;
    height:20px;
    background: transparent;
    border-radius: 50%;
    box-shadow: 10px 10px 0 #3F83EF;
  }

  ul li.active:after {
    content: '';
    position: absolute;
    bottom:-20px;
    right: 0px;
    width: 20px;
    height:20px;
    background: transparent;
    border-radius: 50%;
    box-shadow: 10px -10px 0 #3F83EF;

  }

  ul li.active {
    background: #3F83EF;
  }

  ul:hover {
    width: 200px
  }

  a {
    text-decoration: none;
    width: 100%;
    padding: 0;
    margin: 0;
  }

</style>