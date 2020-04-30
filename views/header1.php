<?php

print <<<EOF

<header id = "header1" >
<nav>
<ul>
<li> Header1 </li>
</ul>
</nav>

<div>
<span>
  
    <form method="POST" action="login.php">
        <input type="email" placeholder="Email.." name="email"/>
        <input type="password" placeholder="Password.." name="pwd"/>
        <button type="submit"> Login </button>
    </form>


    <form method="POST" action="search.php">
    <input type="text" placeholder="search for item.." name="search_box"/>
    <input type="submit"/>
</form>

    </span>
</div>
</header>

EOF;